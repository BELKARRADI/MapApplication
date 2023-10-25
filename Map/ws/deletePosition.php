<?php
include_once '../racine.php';
include_once RACINE . '/service/PositionService.php';

if (isset($_GET['id'])) {
    $positionId = $_GET['id'];

    $positionService = new PositionService();

    $position = $positionService->getById($positionId);
    $positionService->delete($position);

    echo "Position with ID $positionId has been deleted successfully.";
} else {
    echo "Position ID is missing in the request.";
}