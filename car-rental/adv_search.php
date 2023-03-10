<script>
    var selectedValue;
    function getSelectValue(){
         selectedValue = document.forms['myForm']['list'].value;
       console.log(selectedValue);
    }

</script>

<?php
  include('auth_admin.php');
?>

<html>
<head>
<title>Search</title>
<meta charset="utf-8"/>
    <link rel="stylesheet" href="style.css"/>
    <script src="script.js"></script>
</head>
<body>
  <div class='form'>
<p style='text-align:right'><a href='index.php'>Back to Dashboard</a></p>
    <h3>Advanced Search</h3>
<form name='myForm' action="searchdb.php" method="post">
    <input type="text" name="search" placeholder="Search.."/>
    <input type="submit" value=">>"/>
    <div>
    <label for="list">search with:</label>
    <select name="list" id="list" onchange="getSelectValue();">
    <option value="nothing">choose</option>
  <option value="car">car info</option>
  <option value="customer">customer info</option>
  <option value="reservation">reservation</option>
  
</select>

</form>
  </div>





</body>
</html>