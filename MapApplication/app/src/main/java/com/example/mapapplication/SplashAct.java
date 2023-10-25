package com.example.mapapplication;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.animation.Animation;
import android.view.animation.ScaleAnimation;
import android.view.animation.Animation.AnimationListener;
import android.widget.ImageView;

public class SplashAct extends AppCompatActivity {

    private ImageView image1;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);

        image1 = findViewById(R.id.iconRotation);
        image1.setImageResource(R.drawable.destination1);

        // Créez une animation de saut plus rapide avec un saut plus haut
        Animation jumpAnimation = new ScaleAnimation(1.0f, 1.2f, 1.0f, 1.5f, Animation.RELATIVE_TO_SELF, 0.5f, Animation.RELATIVE_TO_SELF, 2f);
        jumpAnimation.setDuration(3000);
        jumpAnimation.setRepeatMode(Animation.REVERSE);
        jumpAnimation.setRepeatCount(1);

        jumpAnimation.setAnimationListener(new AnimationListener() {
            @Override
            public void onAnimationStart(Animation animation) {
                // Animation commencée
            }

            @Override
            public void onAnimationEnd(Animation animation) {
                // Animation terminée, démarrer l'activité principale
                Intent intent = new Intent(SplashAct.this, MainActivity.class);
                startActivity(intent);
                SplashAct.this.finish();
            }

            @Override
            public void onAnimationRepeat(Animation animation) {
                // Animation répétée
            }
        });

        // Lancez l'animation
        image1.startAnimation(jumpAnimation);
    }
}
