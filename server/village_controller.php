<?php 
include("default.php");
if($_REQUEST) {
    if(isset($_REQUEST['fn'])) {
        $function = $_REQUEST['fn'];
        return VillageController::$function($_REQUEST['id']);
    }
}

class VillageController {
     
    public static function deleteVillage($village_id) {
        $db = mysqli_connect("localhost","root","","test");
        Defaults::changeDeleteStatus($db, "village", $village_id);
        header('location:../village.php?msg=Record has been successfully deleted.');
    }
    
}