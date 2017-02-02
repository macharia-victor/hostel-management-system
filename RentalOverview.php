<?php

require './Controller/RentalController.php';
$rentalController = new RentalController();

$title = "Manage Apartments";

if(isset($_GET["delete"]))
{
    $rentalController->DeleteHouses($_GET["delete"]);
}

$content = $rentalController->CreateOverviewTable();

include './Template.php';
?>