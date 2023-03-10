<html>
<head>
<meta charset="utf-8"/>
    <title>AddCar</title>
    <link rel="stylesheet" href="style.css"/>
    <script src="script.js"></script>
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
<?php include('auth_admin.php'); ?>
<div class='form'>
<p style='text-align:right'><a href='index.php'>Back to Dashboard</a></p>
    <h3>Add a New Car</h3>
<form name='myForm' action="addcardb.php" method="post" onsubmit='return validateForm()'>
Plate ID: <input type="text" class='login-input' name="plate_id">
Brand: <select name="car-brand" id="car-brand" onChange="changeSecond(this.value)">
    <option style="display:none"></option>
    <?php 
        include('db.php');
        $result_brand = mysqli_query($con, "SELECT * FROM `car_brand`") or die(mysql_error());
        while($row = mysqli_fetch_assoc($result_brand))
        {
            echo "<option value='" . $row['brand_id'] . "'>" . $row['brand_name'] . "</option>";
        }
    ?>
    </select><br><br>
Model: <input type="text"class='login-input' name="model">
Year : <input type="text"class='login-input' name="year">
Active : <input type="checkbox" name="active"><br><br>
Price/Day : <input type="text"class='login-input' name="price_per_day">
City :  <select name="city" id="city">
    <option style="display:none"></option>
    <?php 
        include('db.php');
        $result_city = mysqli_query($con, "SELECT * FROM `city`") or die(mysql_error());
        while($row = mysqli_fetch_assoc($result_city))
        {
            echo "<option value='" . $row['city_id'] . "'>" . $row['city_name'] . "</option>";
        }
    ?>
    </select><br><br>
<input type="submit" class='login-button'>
</form>
</div>
</body>



</html>