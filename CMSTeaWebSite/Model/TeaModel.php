<?php

require ("Entities/TeaEntity.php");

//Contains database related code for the tea page.
class TeaModel {

    //Get all tea types from the database and return them in an array.
    function GetTeaTypes() {
        require 'Credentials.php';

        //Open connection and Select database.   
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);
        $result = mysql_query("SELECT DISTINCT type FROM tea") or die(mysql_error());
        $types = array();

        //Get data from database.
        while ($row = mysql_fetch_array($result)) {
            array_push($types, $row[0]);
        }

        //Close connection and return result.
        mysql_close();
        return $types;
    }

    //Get coffeeEntity objects from the database and return them in an array.
    function GetteaByType($type) {
        require 'Credentials.php';

        //Open connection and Select database.     
        mysql_connect($host, $user, $passwd) or die(mysql_error);
        mysql_select_db($database);

        $query = "SELECT * FROM tea WHERE type LIKE '$type'";
        $result = mysql_query($query) or die(mysql_error());
        $teaArray = array();

        //Get data from database.
        while ($row = mysql_fetch_array($result)) {
            $name = $row[1];
            $type = $row[2];
            $price = $row[3];
            $flavour = $row[4];
            $country = $row[5];
            $image = $row[6];
            $review = $row[7];

            //Create tea objects and store them in an array.
            $tea = new TeaEntity(-1, $name, $type, $price, $flavour, $country, $image, $review);
            array_push($teaArray, $tea);
        }
        //Close connection and return result
        mysql_close();
        return $teaArray;
        
    }
    
    function GetTeaById($id) {
        require ('Credentials.php');
        //Open connection and Select database.     
        mysql_connect($host, $user, $passwd) or die(mysql_error);
        mysql_select_db($database);

        $query = "SELECT * FROM tea WHERE id = $id";
        $result = mysql_query($query) or die(mysql_error());

        //Get data from database.
        while ($row = mysql_fetch_array($result)) {
            $id = $row[0];
            $name = $row[1];
            $type = $row[2];
            $price = $row[3];
            $flavour = $row[4];
            $country = $row[5];
            $image = $row[6];
            $review = $row[7];

            //Create tea
            $tea = new TeaEntity($id, $name, $type, $price, $flavour, $country, $image, $review);
        }
        //Close connection and return result
        mysql_close();
        return $tea;
    }

    function InsertTea(TeaEntity $tea) {
        $query = sprintf("INSERT INTO tea
                          (name, type, price,flavour,country,image,review)
                          VALUES
                          ('%s','%s','%s','%s','%s','%s','%s')",
                mysql_real_escape_string($tea->name),
                mysql_real_escape_string($tea->type),
                mysql_real_escape_string($tea->price),
                mysql_real_escape_string($tea->flavour),
                mysql_real_escape_string($tea->country),
                mysql_real_escape_string("Images/Tea/" . $tea->image),
                mysql_real_escape_string($tea->review));
        $this->PerformQuery($query);
    }

    function UpdateTea($id, TeaModelEntity $tea) {
        $query = sprintf("UPDATE tea
                            SET name = '%s', type = '%s', price = '%s', roast = '%s',
                            country = '%s', image = '%s', review = '%s'
                          WHERE id = $id",
                mysql_real_escape_string($tea->name),
                mysql_real_escape_string($tea->type),
                mysql_real_escape_string($tea->price),
                mysql_real_escape_string($tea->flavour),
                mysql_real_escape_string($tea->country),
                mysql_real_escape_string("Images/tea/" . $tea->image),
                mysql_real_escape_string($tea->review));
                          
        $this->PerformQuery($query);
    }

    function DeleteTea($id) {
        $query = "DELETE FROM tea WHERE id = $id";
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


