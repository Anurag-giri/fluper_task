<?php
  include('sql.php');
  $db = mysqli_connect("localhost","root","","test");
  $country = sql::getCountryDetails($db);
  $state = sql::getState($db);
  $city = sql::getCity($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Assignment</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="index.js"></script>
  <link rel="stylesheet" href="js/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>
<?php include('navbar.php'); ?>
    <div class="container">
    <h2 style="text-align:center; margin-top:20px;"> Add City </h2><br/><br/>
    <form action="sql.php" method="post">
    <strong class="text-danger">
        <h3>
            <?php if(isset($_GET['msg'])) {
                echo $_GET['msg'];
            } ?>
            </h3>
        </strong>
        <div class="form-group">
            <label for="email"> Country <strong class="text-danger"> *</strong></label> &nbsp;
            <select id="country" name="country" class="country" onchange="getState(this)" required>
            <option value=""> Select Country </option>
                <?php foreach($country as $value) { ?>
                    <option value="<?= $value['id'] ?>"> <?= $value['country_name']; ?> </option>
                <?php } ?>
            </select>
            <span class="state">
                <label for="pwd">&nbsp; State <strong class="text-danger"> *</strong>&nbsp;</label>
                <select name="state" id="state" onchange="getCity(this)" required>
                    <option value="0"> Select State </option>
                </select>
            </span>

            <span class="city">
                <label for="pwd">&nbsp; City <strong class="text-danger"> *</strong></label>
                <input type="text" name="city_name" id="city_name" required/>
            </span>

            <input type="hidden" name="fn" id="fn" value="insertCity" />
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    <div class="form-group" align="right">
        <a href="server/roll_back_controller.php?fn=rollBackCountry&table=city & action=city.php"> <button>Roll Back City</button></a>
    </div>
    <hr/>
    </div>

            <!-- Data of category table -->

    <div class="container">
    <table class="table">
        <thead>
        <tr>
            <th> Id </th>
            <th> City  </th>
            <th> State  </th>
            <th> Country  </th>
            <th> Action </th>
        </tr>
        </thead>
        <tbody>
            <?php 
            foreach($city as $key => $value) { ?>
                <tr>
                    <td>  <?= $key+1 ?> </td>
                    <td>  <?= $value['city_name'] ?> </td>
                    <td>  <?= $value['state_name'] ?> </td>
                    <td>  <?= $value['country_name'] ?> </td>
                    <td>  <a href="server/city_controller.php?id=<?php echo $value['id']; ?> &fn=deleteCity"> Delete </a> </td>
                </tr>
            <?php } ?>
        <?php if(!$city) { ?>
            <tr> <td>  Data Not Found </td></tr>
        <?php } ?>
        </tbody>
    </table>
    </div>


</body>
</html>