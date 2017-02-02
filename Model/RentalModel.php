<?php

require ("Entities/RentalEntity.php");

//Contains database related code for the houses page.
class RentalModel {

    //Get all house types from the database and return them in an array.
    function GetRentTypes() {
        require 'Credentials.php';

        //Open connection and Select database.   
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);
        $result = mysql_query("SELECT DISTINCT type FROM houses") or die(mysql_error());
        $types = array();

        //Get data from database.
        while ($row = mysql_fetch_array($result)) {
            array_push($types, $row[0]);
        }

        //Close connection and return result.
        mysql_close();
        return $types;
    }

    //Get RentalEntity objects from the database and return them in an array.
    function GetRentByType($type) {
        require 'Credentials.php';

        //Open connection and Select database.     
        mysql_connect($host, $user, $passwd) or die(mysql_error);
        mysql_select_db($database);

        $query = "SELECT * FROM houses WHERE type LIKE '$type'";
        $result = mysql_query($query) or die(mysql_error());
        $rentArray = array();

        //Get data from database.
        while ($row = mysql_fetch_array($result)) {
            $id = $row[0];
            $name = $row[1];
            $type = $row[2];
            $price = $row[3];
            $size = $row[4];
            $zone = $row[5];
            $image = $row[6];
            $review = $row[7];

            //Create house objects and store them in an array.
            $houses = new RentalEntity($id, $name, $type, $price, $size, $zone, $image, $review);
            array_push($rentArray, $houses);
        }
        //Close connection and return result
        mysql_close();
        return $rentArray;
    }
    
    
    function GetRentById($id) {
        require ('Credentials.php');
        //Open connection and Select database.     
        mysql_connect($host, $user, $passwd) or die(mysql_error);
        mysql_select_db($database);

        $query = "SELECT * FROM houses WHERE id = $id";
        $result = mysql_query($query) or die(mysql_error());

        //Get data from database.
        while ($row = mysql_fetch_array($result)) {
            
            $name = $row[1];
            $type = $row[2];
            $price = $row[3];
            $size = $row[4];
            $zone = $row[5];
            $image = $row[6];
            $review = $row[7];

            //Create houses
            $houses = new RentalEntity($id, $name, $type, $price, $size, $zone, $image, $review);
        }
        //Close connection and return result
        mysql_close();
        return $houses;
    }

    function InsertHouses(RentalEntity $houses) {
        $query = sprintf("INSERT INTO houses
                          (name, type, price,size,zone,image,review)
                          VALUES
                          ('%s','%s','%s','%s','%s','%s','%s')",
                mysql_real_escape_string($houses->name),
                mysql_real_escape_string($houses->type),
                mysql_real_escape_string($houses->price),
                mysql_real_escape_string($houses->size),
                mysql_real_escape_string($houses->zone),
                mysql_real_escape_string("Images/Houses/" . $houses->image),
                mysql_real_escape_string($houses->review));
        $this->PerformQuery($query);
    }

    function UpdateHouses($id, RentalEntity $houses) {
        $query = sprintf("UPDATE houses
                            SET name = '%s', type = '%s', price = '%s', size = '%s',
                            zone = '%s', image = '%s', review = '%s'
                          WHERE id = $id",
                mysql_real_escape_string($houses->name),
                mysql_real_escape_string($houses->type),
                mysql_real_escape_string($houses->price),
                mysql_real_escape_string($houses->size),
                mysql_real_escape_string($houses->zone),
                mysql_real_escape_string("Images/Houses/" . $houses->image),
                mysql_real_escape_string($houses->review));
                          
        $this->PerformQuery($query);
    }

    function DeleteHouses($id) {
        $query = "DELETE FROM houses WHERE id = $id";
        $this->PerformQuery($query);
    }

    function PerformQuery($query) {
        require ('Credentials.php');
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);

        //Execute query and close connection
        mysql_query($query) or die(mysql_error());
        mysql_close();
    }

}

?>
