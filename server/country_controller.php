<?php 
include("default.php");
if($_REQUEST) {
    if(isset($_REQUEST['fn'])) {
        $function = $_REQUEST['fn'];
        return CountryController::$function($_REQUEST['id']);
    }
}

class CountryController {
     
    public static function deleteCountry($country_id) {
        $db = mysqli_connect("localhost","root","","test");
        $state_lists = Defaults::getDyanamicTableList($db, 'state', $country_id, "country_id");
        if(count($state_lists)){
          foreach($state_lists as $state_value) {
            $city_lists = Defaults::getDyanamicTableList($db, 'city', $state_value, "state_id");
             foreach($city_lists as $city_value) {
                $villege_lists = Defaults::getDyanamicTableList($db, 'village', $city_value, "city_id");
                 foreach($villege_lists as $villege_value){
                    Defaults::changeDeleteStatus($db, "village", $villege_value);
                 }
                 Defaults::changeDeleteStatus($db, "city", $city_value); 
             }
             Defaults::changeDeleteStatus($db, "state", $state_value);     
           }
        }  
        Defaults::changeDeleteStatus($db, "country", $country_id);
       header('location:../index.php?msg=Record has been successfully deleted.');
    }
}