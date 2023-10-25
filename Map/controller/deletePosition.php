<?php

include_once '../racine.php';
include_once RACINE .  '/service/PositionService.php';
extract($_GET);
$ps = new PositionService();

$ps->delete($ps->getById($id));
header("location:../index.php");
