<?php 
include("default.php");
if($_REQUEST) {
    if(isset($_REQUEST['fn'])) {
        $function = $_REQUEST['fn'];
        return CityController::$function($_REQUEST['id']);
    }
}

class CityController {
     
    public static function deleteCity($city_id) {
        $db = mysqli_connect("localhost","root","","test");
        $village_lists = Defaults::getDyanamicTableList($db, 'village', $city_id, "city_id");
        if(count($village_lists)){
          foreach($village_lists as $village_value) {
            Defaults::changeDeleteStatus($db, "village", $village_value);     
           }
        }  
        Defaults::changeDeleteStatus($db, "city", $city_id);
       header('location:../city.php?msg=Record has been successfully deleted.');
    }

}