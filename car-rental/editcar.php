<html>
<head>
<meta charset="utf-8"/>
    <link rel="stylesheet" href="style.css"/>
    <script src="script.js"></script>
    <title>EditCar</title>
    <?php
  include('auth_admin.php');
?>
    <script>
            function validateForm(){
                var plate_id = document.forms['myForm']['plate_id'].value;
                var brand = document.forms['myForm']['brand'].value;
                var model = document.forms['myForm']['model'].value;
                var year = document.forms['myForm']['year'].value;
                var active = document.forms['myForm']['active'].value;
                var price_per_day = document.forms['myForm']['price_per_day'].value;
                var area_id = document.forms['myForm']['area_id'].value;
                
                if(model == ''){
                    alert('Enter model');
                    return false;
                }
                if(plate_id == ''){
                    alert('Enter plate_id');
                    return false;
                }
                if(brand == ''){
                    alert('Enter brand');
                    return false;
                }
                if(year == ''){
                    alert('Please Enter year');
                    return false;
                }
                if(active == ''){
                    alert('Please enter active');
                    return false;
                }if(price_per_day == ''){
                    alert('Please enter price/day');
                    return false;
                }if(area_id == ''){
                    alert('Please enter area id');
                    return false;
                }
                
                
               
                 
            }

        </script>
</head>
<body>
    <?php
    include('db.php');
    $query = "SELECT * FROM `car` NATURAL JOIN `city` NATURAL JOIN `car_brand` WHERE plate_id='" . $_GET['id'] . "'";
    $result = mysqli_query($con, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if($rows == 1)
    {
        $array = mysqli_fetch_array($result);
    echo "
<div class='form'>
<p style='text-align:right'><a href='index.php'>Back to Dashboard</a></p>
    <h3>Edit Car</h3>
<form name='myForm' action='editcardb.php' method='post' onsubmit='return validateForm()'>
Plate ID: <input type='text' class='login-input' name='plate_id' value='". $array['plate_id'] ."' readonly >
Brand: <select name='car-brand' id='car-brand'>
    <option style='display:none'></option>";
        $result_brand = mysqli_query($con, "SELECT * FROM `car_brand`") or die(mysql_error());
        while($row = mysqli_fetch_assoc($result_brand))
        {
            echo "<option value='" . $row['brand_id'] . "'";
            if ($row['brand_id'] == $array['brand_id'])
              echo " selected";
            echo">" . $row['brand_name'] . "</option>";
        }
    
    echo "</select><br><br>
Model: <input type='text' class='login-input' name='model' value='". $array['model'] ."'>
Year : <input type='text'class='login-input' name='year'value='". $array['year'] ."'>
Active : <input type='checkbox' name='active'";
        if ($array['active']=='1')
            echo " checked='checked' ";
echo "><br><br>
Price/Day : <input type='text'class='login-input' name='price_per_day' value='". $array['price_per_day'] ."'>
City :  <select name='city' id='city'>
    <option style='display:none'></option>";

        $result_city = mysqli_query($con, "SELECT * FROM `city`") or die(mysql_error());
        while($row = mysqli_fetch_assoc($result_city))
        {
            echo "<option value='" . $row['city_id'] . "'";
            if ($row['city_id'] == $array['city_id'])
              echo "     selected";
                echo ">" . $row['city_name'] . "</option>";
        }

    echo "</select><br><br>
<input type='submit' class='login-button' value='Update' >
</form>
</div>";
    }
?>
</body>


</html>