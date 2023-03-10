<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Search</title>
    <link rel="stylesheet" href="style.css"/>
    <script>
        function changeSecond(first){
        var xmlhttp;
        if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
          }
        xmlhttp.onreadystatechange=function()
        {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
            var res=xmlhttp.responseText;
            document.getElementById("car-model").innerHTML=res;
            }
          }
        xmlhttp.open("GET","search.php?brand-id="+first,true);
        xmlhttp.send();
        }
        </script>
</head>
<body>
<?php
    require('db.php');
    require('auth_session.php');
    //session_start(); 
    


    if (isset($_GET['search-text'])) {
    $search_text = stripslashes($_REQUEST['search-text']);
    $search_text = mysqli_real_escape_string($con, $search_text);
    $query = "SELECT * FROM `car` NATURAL JOIN `car_brand` NATURAL JOIN city WHERE CONCAT(`brand_name`, ' ', `model`) like '%$search_text%'";
    if($_GET['car-brand']!='')
    {
        $car_brand = stripslashes($_REQUEST['car-brand']);
        $car_brand = mysqli_real_escape_string($con, $car_brand);
        $query .= " AND brand_id = '$car_brand'";
    }
    if($_GET['car-model']!='')
    {
        $car_model = stripslashes($_REQUEST['car-model']);
        $car_model = mysqli_real_escape_string($con, $car_model);
        $query .= " AND model like '$car_model'";
    }
    if($_GET['car-year']!='')
    {
        $car_year = stripslashes($_REQUEST['car-year']);
        $car_year = mysqli_real_escape_string($con, $car_year);
        $query .= " AND `year` like '$car_year'";
    }
    if(isset($_GET['active']))
    {
        $car_active = stripslashes($_REQUEST['active']);
        $car_active = mysqli_real_escape_string($con, $car_active);
        $query .= " AND active = $car_active";
    }
    if($_GET['city']!='')
    {
        $city = stripslashes($_REQUEST['city']);
        $city = mysqli_real_escape_string($con, $city);
        $query .= " AND `city_id` like '$city'";
    }
    //echo $query;
    $result = mysqli_query($con, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if($rows)
    {
        echo "<div class='form'>";
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<p id='car_" . $row['plate_id']."'>
                        Brand: " . $row['brand_name'] . "<br /> 
                        Model: " . $row['model'] . "<br /> 
                        Year: " . $row['year'] . "<br /> 
                        Location: " . $row['city_name'] . "<br /> 
                        Active: " . $row['active'] . "<br />
                        Price per day: " . $row["price_per_day"] . "<br /><a href='reserve.php?id=" . $row["plate_id"] . "'>Reserve</a>" . "</p>";
            }
        echo "</div>";
    }
        
    }
?>

<form class="form" method="GET" name="search">
<p style='text-align:right'><a href='index.php'>Back to Dashboard</a></p>
    <h1>Search</h1>
    <input type="text" class="login-input" name="search-text" placeholder="Search" autofocus="true"/>
    <input type="submit" value="Search" class="login-button"/>
    <hr>
    <h4>Advanced Search</h4>    
    Brand
    <select name="car-brand" id="car-brand" onChange="changeSecond(this.value)">
    <option style="display:none"></option>
    <?php 
        include('db.php');
        $result_brand = mysqli_query($con, "SELECT * FROM `car_brand`") or die(mysql_error());
        while($row_brand = mysqli_fetch_assoc($result_brand))
        {
            echo "<option value='" . $row_brand['brand_id'] . "'>" . $row_brand['brand_name'] . "</option>";
        }
    ?>
    </select>

    <br/><br/>

    Model
    <select name="car-model" id="car-model">
    <option style="display:none"></option>
    <?php
        include('db.php');
        if ($_GET['brand-id']!='')
        {
        $query_model = "SELECT model FROM `car` WHERE brand_id ='" . $_GET['brand-id'] . "'";
        echo $query_model;
        $result_model = mysqli_query($con, $query_model) or die(mysql_error());
        while($row_model = mysqli_fetch_assoc($result_model))
        {
            echo "<option value='" . $row_model['model'] . "'>" . $row_model['model'] . "</option>";
        }
    }
    ?>    
    </select>

    <br/><br/>
    Year
    <select name="car-year" id="car-year">
    <option style="display:none"></option>
    <?php
        for ($i = 2022; $i> 1990; $i--)
        {
            echo "<option value='$i'>$i</option>";
        } 
    ?>
    </select>
    <br/><br/>

    Location
    <select name="city" id="city">
    <option style="display:none"></option>
    <?php 
        include('db.php');
        $result_city = mysqli_query($con, "SELECT * FROM `city`") or die(mysql_error());
        while($row_city = mysqli_fetch_assoc($result_city))
        {
            echo "<option value='" . $row_city['city_id'] . "'>" . $row_city['city_name'] . "</option>";
        }
    ?>
    </select>
    <br/><br/>
    Active only <input type="checkbox" id="active" name="active" value="active">
        <br><br>
</body>
</html>