package com.example.mapapplication;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class GoogleMaps extends AppCompatActivity implements OnMapReadyCallback {

    private GoogleMap gMap;
    private RequestQueue requestQueue;
    private String insertUrl = "https://192.168.11.102/Map/ws/loadPosition.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_google_maps);

        requestQueue = Volley.newRequestQueue(this);

        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager().findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);
    }

    @Override
    public void onMapReady(@NonNull GoogleMap googleMap) {
        this.gMap = googleMap;

        JSONObject jsonRequest = new JSONObject();
        JsonObjectRequest jsonObjectRequest = new JsonObjectRequest(Request.Method.GET, insertUrl, jsonRequest,
                response -> {
                    try {
                        JSONArray positions = response.getJSONArray("positions");
                        Log.d("Response", positions.toString());
                        for (int i = 0; i < positions.length(); i++) {
                            JSONObject position = positions.getJSONObject(i);

                            double latitude = position.getDouble("latitude");
                            double longitude = position.getDouble("longitude");
                            LatLng positionLatLng = new LatLng(latitude, longitude);
                            this.gMap.addMarker(new MarkerOptions().position(positionLatLng).title("Marker"));
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                },
                error -> {
                    Log.d("ErrorMap", error.toString() + error.getMessage());
                }
        );
        requestQueue.add(jsonObjectRequest);
}
}