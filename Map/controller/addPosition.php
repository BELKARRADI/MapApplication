<?php

include_once '../racine.php';
include_once RACINE . '/service/PositionService.php';
extract($_GET);
$ps = new PositionService();
$ps->create(new Position(1, $latitude, $longitude, $date, $imei)  );
header("location:../index.php");
