<?php

require './Controller/RentalController.php';
$rentalController = new RentalController();

$title = "Add a new Apartment";

if (isset($_GET["update"]))
{
    if(isset($_POST["txtName"]))
    {
        $rentalController->UpdateHouses($_GET["update"]);
    }
}
else
{
    if (isset($_POST["txtName"]))
    {
        $rentalController->InsertHouses();
    }
}

if (isset($_GET["update"]))
{
    $houses = $rentalController->GetRentById($_GET["update"]);
    
    $content = '<form action="" method="post">
    <fieldset>
        <legend>Add a new Apartment</legend>
        
        <label for="name">Name: </label>
        <input type="text" class="inputField" name="txtName" value="' . $houses->name . '" />
        <br/>
        
        <label for="type">Type: </label>
        <select class="inputField" name="ddlType" >
            <option value="%">All</option>'
        . $rentalController->CreateOptionValues($rentalController->GetRentTypes(), $houses->type) .
        '</select>
        <br/>
        
        <label for="price">Price: </label>
        <input type="text" class="inputField" name="txtPrice" value="' . $houses->price . '" />
        <br/>
        
        <label for="size">Size: </label>
        <input type="text" class="inputField" name="txtSize" value="' . $houses->size . '" />
        <br/>
        
        <label for="zone">Zone: </label>
        <input type="text" class="inputField" name="txtZone" value="' . $houses->zone . '" />
        <br/>
        
        <label for="image">Image: </label>
        <select class="inputField" name="ddlImage">'
        . $rentalController->GetImages($houses->image) .
        '</select>
        <br/>
        
        <label for="review">Review: </label>
        <textarea cols="70" rows="12" name="txtReview"> ' . $houses->review . '</textarea>
        <br/>
        
        <input type="submit" value="Submit" />
        
    </fieldset>
    </form>';
}
else
{
    $content = '<form action="" method="post">
    <fieldset>
        <legend>Add a new Apartment</legend>
        
        <label for="name">Name: </label>
        <input type="text" class="inputField" name="txtName" />
        <br/>
        
        <label for="type">Type: </label>
        <select class="inputField" name="ddlType" >
            <option value="%">All</option>'
        . $rentalController->CreateOptionValues($rentalController->GetRentTypes(), "") .
        '</select>
        <br/>
        
        <label for="price">Price: </label>
        <input type="text" class="inputField" name="txtPrice" />
        <br/>
        
        <label for="size">Size: </label>
        <input type="text" class="inputField" name="txtSize" />
        <br/>
        
        <label for="zone">Zone: </label>
        <input type="text" class="inputField" name="txtZone" />
        <br/>
        
        <label for="image">Image: </label>
        <select class="inputField" name="ddlImage">'
        . $rentalController->GetImages("") .
        '</select>
        <br/>
        
        <label for="review">Review: </label>
        <textarea cols="70" rows="12" name="txtReview"></textarea>
        <br/>
        
        <input type="submit" value="Submit" />
        
    </fieldset>
    </form>';
}

include './Template.php';
?>


