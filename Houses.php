<?php

require 'Controller/RentalController.php';
$rentalController = new RentalController();

if(isset($_POST['types']))
{
    //Fill page with houses of the selected type
    $rentTables = $rentalController->CreateRentTables($_POST['types']);
}
else 
{
    //Page is loaded for the first time, no type selected -> Fetch all types
    $rentTables = $rentalController->CreateRentTables('%');
}

//Output page data
$title = 'Houses overview';
$content = $rentalController->CreateRentDropdownList(). $rentTables;

include 'Template.php';
?>
