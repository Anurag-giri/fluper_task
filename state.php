<?php
  include('sql.php');
  $db = mysqli_connect("localhost","root","","test");
  $data = array();
  $state = sql::getState($db);
  $country = sql::getCountryDetails($db);
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
    <h2 style="text-align:center; margin-top:20px;"> Add State </h2> <br/><br/>
    
        <strong class="text-danger">
        <h3>
            <?php if(isset($_GET['msg'])) {
                echo $_GET['msg'];
            } ?>
            </h3>
        </strong>
        <div class="form-group">
        <form action="sql.php" method="post">
            <label for="email"> Country <strong class="text-danger"> *</strong></label> &nbsp;
            <select id="country" name="country" class="country" onchange="getState(this)" required>
            <option value=""> Select Country </option>
                <?php foreach($country as $value) { ?>
                    <option value="<?= $value['id'] ?>"> <?= $value['country_name']; ?> </option>
                <?php } ?>
            </select>

            <label for="email"> Add State <strong class="text-danger"> *</strong></label> &nbsp;
            <input type="text" name="state_name" id="state_name" placeholder="Enter state name" required/>

            <input type="hidden" name="fn" id="fn" value="insertState" />
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    <div class="form-group" align="right">
        <a href="server/roll_back_controller.php?fn=rollBackCountry&table=state & action=state.php"> <button>Roll Back State</button></a>
    </div>
    <hr/>
    </div>

            <!-- Data of category table -->

    <div class="container">
    <table class="table">
        <thead>
        <tr>
            <th> Id </th>
            <th> Country </th>
            <th> State </th>
            <th> Action </th>
        </tr>
        </thead>
        <tbody>
            <?php 
            foreach($state as $key => $value) { ?>
                <tr>
                    <td>  <?= $key+1 ?> </td>
                    <td> <?= $value['country_name'] ?> </td>
                    <td>  <?= $value['state_name'] ?> </td>
                    <td>  <a href="server/state_controller.php?id=<?php echo $value['id']; ?> &fn=deleteState"> Delete </a> </td>
                </tr>
            <?php } ?>
        <?php if(!$state) { ?>
            <tr> <td>  Data Not Found </td></tr>
        <?php } ?>
        </tbody>
    </table>
    </div>


</body>
</html>
