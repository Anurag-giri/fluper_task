<?php
  include('sql.php');
  $db = mysqli_connect("localhost","root","","test");
  $state = sql::getState($db);
  $country = sql::getCountryDetails($db);
  $village = sql::getVillage($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title> Assignment </title>
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
    <h2 style="text-align:center; margin-top:20px;"> Add Village's </h2><br/><br/>
    <strong class="text-danger">
        <h3>
            <?php if(isset($_GET['msg'])) { echo $_GET['msg']; } ?>
        </h3>
    </strong>
    <form action="sql.php" method="post">

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
                    <option value="" selected> Select State </option>
                </select>
            </span>

            <span class="city">
                <label for="pwd">&nbsp; City <strong class="text-danger"> *</strong></label>
                <select name="city" id="city" class="city" required>
                    <option value="" selected> Select City </option>
                </select>&nbsp;
            </span>

            <label for="pwd">&nbsp; VIllage <strong class="text-danger"> *</strong></label>
            <input type="text" name="village_name" id="village_name" required/>
        
            <input type="hidden" name="fn" id="fn" value="insertVillage" />
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    <div class="form-group" align="right">
        <a href="server/roll_back_controller.php?fn=rollBackCountry&table=village & action=village.php"> <button>Roll Back Village</button></a>
    </div>
    <hr/>
    </div>

            <!-- Data of category table -->

    <div class="container">
    <table class="table">
        <thead>
        <tr>
            <th> Id </th>
            <th> Village </th>
            <th> City </th>
            <th> State </th>
            <th> Country </th>
            <th> Action </th>
        </tr>
        </thead>
        <tbody>
            <?php 
            foreach($village as $key => $value) { ?>
                <tr>
                    <td>  <?= $key+1 ?> </td>
                    <td>  <?= $value['village_name']; ?> </td>
                    <td>  <?= $value['city_name'] ?> </td>
                    <td>  <?= $value['state_name'] ?> </td>
                    <td>  <?= $value['country_name'] ?> </td>
                    <td>  <a href="server/village_controller.php?id=<?php echo $value['id']; ?> &fn=deleteVillage"> Delete </a> </td>
                </tr>
            <?php } ?>
        <?php if(!$village) { ?>
            <tr> <td>  Data Not Found </td></tr>
        <?php } ?>
        </tbody>
    </table>
    </div>


</body>
</html>