<?php 
include("default.php");
if($_REQUEST) {
    if(isset($_REQUEST['fn'])) {
        $function = $_REQUEST['fn'];
        return StateController::$function($_REQUEST['id']);
    }
}

class StateController {
     
    public static function deleteState($state_id) {
        $db = mysqli_connect("localhost","root","","test");
        $city_lists = Defaults::getDyanamicTableList($db, 'city', $state_id, "state_id");
        if(count($city_lists)){
          foreach($city_lists as $city_value) {
            $village_lists = Defaults::getDyanamicTableList($db, 'village', $city_value, "city_id");
             foreach($village_lists as $village_value) {
                Defaults::changeDeleteStatus($db, "village", $village_value); 
             }
             Defaults::changeDeleteStatus($db, "city", $city_value);     
           }
        }  
        Defaults::changeDeleteStatus($db, "state", $state_id);
       header('location:../state.php?msg=Record has been successfully deleted.');
    }
   
}