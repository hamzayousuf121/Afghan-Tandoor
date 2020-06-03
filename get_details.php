<?php

    include('assets/include/settings.php');
    require('assets/include/functions.php');
    extract($_POST);
    $condition = "";
    $params = array($partnerId, $partnerstoreId);

    //Name of table on which user has clicked.
    $name = $_GET['name'];


    //Update SQL Conditions and Parameter Values as per stuff needed.
    switch($name)
    {
        case 'city': 
            $condition = " and cityId = ?"; 
            array_push($params, $city);
        case 'state':
            $condition .= " and stateId = ?"; 
            array_push($params, $state);
        case 'country': 
            $condition .= " and countryId = ?"; 
            array_push($params, $country); 
            break;
        default: $condition .= "";
    }

    //Set the table names, states etc.
    switch($name)
    {
        case 'country': 
            $table = "states"; $label = "Province"; $name="state"; $onchange = "getCities()";
        break;
        case 'state':
            $table = "cities"; $label = "City"; $name="city"; $onchange = "getArea()"; 
            break;
        case 'city': 
            $table = "area"; $label = "Area"; $name="area"; $onchange = ""; 
            break;
        default: $table = false;
    }

    //Show the select.
    if($table)
    {
        $stmt = $dbhconnection->prepare("Select * from ".$table." where partnerId = ? and storeId = ?".$condition);
        $stmt->execute($params);
        if($table == "area")
        {  
            if($stmt->rowCount() > 1)
            {
                showSelect($stmt->fetchAll(), $name, $label, "area");
            }
            return ;
        }
        showSelect($stmt->fetchAll(), $name, $label);           
    }
    
    
?>