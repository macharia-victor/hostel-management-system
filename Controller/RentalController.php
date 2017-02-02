<script>

function showConfirm(id)
{
    var c = confirm("Are you sure you want to delete this item?");
    
    if(c)
        window.location = "RentalOverview.php?delete=" + id;
}

</script>

<?php

require ("Model/RentalModel.php");

//Contains non-database related function for the Houses page
class RentalController {
    
   function CreateOverviewTable()
    {
        $result = ""
                . "<table class='overviewTable'>"
                    . "<tr>"
                        . "<td></td>"
                        . "<td></td>"
                        . "<td><b>Id</b></td>"
                        . "<td><b>Name</b></td>"
                        . "<td><b>Type</b></td>"
                        . "<td><b>Price</b></td>"
                        . "<td><b>Size</b></td>"
                        . "<td><b>Zone</b></td>"
                    . "</tr>";
        
        $housesArray = $this->GetRentByType('%');
        
        foreach ($housesArray as $key => $value) 
        {
            $result = $result .
                    "<tr>
                        <td><a href='apartmentadd.php?update=$value->id'>Update</a></td>
                        <td><a href='#' onclick='showConfirm($value->id)'>Delete</a></td>
                        <td>$value->id</td>
                        <td>$value->name</td>
                        <td>$value->type</td>
                        <td>$value->price</td>
                        <td>$value->size</td>
                        <td>$value->zone</td>
                    </tr>";
        }
        $result = $result . "</table>";
        return $result;
    }
                function CreateRentDropdownList() {
        $rentalModel = new RentalModel();
        $result = "<form action = '' method = 'post' width = '200px'>
                    Please select a type: 
                    <select name = 'types' >
                        <option value = '%' >All</option>
                        " . $this->CreateOptionValues($rentalModel->GetRentTypes()) .
                "</select>
                     <input type = 'submit' value = 'Search' />
                    </form>";

        return $result;
    }

    function CreateOptionValues(array $valueArray) {
        $result = "";

        foreach ($valueArray as $value) {
            $result = $result . "<option value='$value'>$value</option>";
        }

        return $result;
    }
    
    function CreateRentTables($types)
    {
        $rentalModel = new RentalModel();
        $rentArray = $rentalModel->GetRentByType($types);
        $result = "";
        
        //Generate a RentalTable for each RentalEntity in array
        foreach ($rentArray as $key => $houses) 
        {
            $result = $result .
                    "<table class = 'rentTable'>
                        <tr>
                            <th rowspan='6' width = '150px' ><img runat = 'server' src = '$houses->image' /></th>
                            <th width = '75px' >Name: </th>
                            <td>$houses->name</td>
                        </tr>
                        
                        <tr>
                            <th>Type: </th>
                            <td>$houses->type</td>
                        </tr>
                        
                        <tr>
                            <th>Price: </th>
                            <td>$houses->price</td>
                        </tr>
                        
                        <tr>
                            <th>Size: </th>
                            <td>$houses->size</td>
                        </tr>
                        
                        <tr>
                            <th>Zone: </th>
                            <td>$houses->zone</td>
                        </tr>
                        
                        <tr>
                            <td colspan='2' >$houses->review</td>
                        </tr>                      
                     </table>";
        }        
        return $result;
        
    }
    
    //Returns list of files in a folder.
    function GetImages() {
        //Select folder to scan
        $handle = opendir("Images/Houses");

        //Read all files and store names in array
        while ($image = readdir($handle)) {
            $images[] = $image;
        }

        closedir($handle);

        //Exclude all filenames where filename length < 3
        $imageArray = array();
        foreach ($images as $image) {
            if (strlen($image) > 2) {
                array_push($imageArray, $image);
            }
        }

        //Create <select><option> Values and return result
        $result = $this->CreateOptionValues($imageArray);
        return $result;
    }

    
    function InsertHouses() {
        $name = $_POST["txtName"];
        $type = $_POST["ddlType"];
        $price = $_POST["txtPrice"];
        $size = $_POST["txtSize"];
        $zone = $_POST["txtZone"];
        $image = $_POST["ddlImage"];
        $review = $_POST["txtReview"];

        $houses = new RentalEntity(-1, $name, $type, $price, $size, $zone, $image, $review);
        $rentalModel = new RentalModel();
        $rentalModel->InsertHouses($houses);
    }

    function UpdateHouses($id) {
        
        $name = $_POST["txtName"];
        $type = $_POST["ddlType"];
        $price = $_POST["txtPrice"];
        $size = $_POST["txtSize"];
        $zone = $_POST["txtZone"];
        $image = $_POST["ddlImage"];
        $review = $_POST["txtReview"];
        
        $houses = new RentalEntity($id, $name, $type, $price, $size, $zone, $image, $review);
        $rentalModel = new RentalModel();
        $rentalModel->UpdateHouses($id, $houses);
    }

    function DeleteHouses($id) {
        
        $rentalModel = new RentalModel();
        $rentalModel->DeleteHouses($id);
    }
    //</editor-fold>
    
    //<editor-fold desc="Get Methods">
    function GetRentById($id) {
        $rentalModel = new RentalModel();
        return $rentalModel->GetRentById($id);
    }

    function GetRentByType($type) {
        $housesModel = new RentalModel();
        return $housesModel->GetRentByType($type);
    }

    function GetRentTypes() {
        $rentalModel = new RentalModel();
        return $rentalModel->GetRentTypes();
    }
    

}

?>
