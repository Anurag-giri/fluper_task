<?php
if($_REQUEST) {
    if(isset($_REQUEST['fn'])) {
        $function = $_REQUEST['fn'];
        return sql::$function($_REQUEST);
    }
}
class sql {

    public $db;
    public function __construct() {
        $db = new DB();
    }

    public static function getCountryDetails($db) {
        $sql = "select * from `country` where delete_status = 0";
        $res = $db->query($sql);
        return $res->fetch_all(MYSQLI_ASSOC);
    }
    
    public static function getState($db) {
        $sql = " SELECT state.id,state.state_name,country.country_name  FROM state INNER JOIN country 
                 ON country.id = state.country_id WHERE country.delete_status = '0'
                 AND state.delete_status = '0'";
        $res = $db->query($sql);
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public static function getCity($db) {
        $sql = "SELECT ct.id, ct.city_name, st.state_name, co.country_name from city as ct 
                INNER JOIN state as st ON st.id = ct.state_id INNER JOIN country as co on 
                co.id = st.country_id WHERE co.delete_status='0' and st.delete_status='0' and ct.delete_status='0'";
        $res = $db->query($sql);
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public static function getVillage($db) {
        $sql = "SELECT ct.city_name, st.state_name, co.country_name,vn.id,vn.village_name,vn.id from village as vn INNER JOIN city as ct ON ct.id = vn.city_id 
                INNER JOIN state as st ON st.id = ct.state_id INNER JOIN country as co on 
                co.id = st.country_id WHERE co.delete_status='0' and st.delete_status='0' and ct.delete_status='0' and vn.delete_status='0'";
        $res = $db->query($sql);
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public static function insertCategories($params) {
        unset($params['fn']);
        $db = mysqli_connect("localhost","root","","test");
        $last_id = 0;
        foreach($params as $key => $value) {
            if($key == 'category') { 
                $last_id = 0; 
            }
            $sql = "insert into `fluper`(`id`,`category`,`parent_id`,`delete_status`) VALUES(Null, '$value', '$last_id', '0')";
            $result = $db->query($sql);
            if($result) {
                $last_id = mysqli_insert_id($db);
            }
        }
        header("Location: index.php");
    }

    public static function insertCountry($params) {
        $db = mysqli_connect("localhost","root","","test");
        $check_exists_country = "select * from country where country_name='$params[country_name]'"; 
        $check_res = $db->query($check_exists_country);
        if(mysqli_num_rows($check_res) > 0) {
            header("Location: index.php?msg=This Country is Already Exists");
            die;
        }
        $sql = "insert into country(`id`,`country_name`) values(Null,'$params[country_name]')";
        $result = $db->query($sql);
        header("Location: index.php");
    }

    public static function insertState($params) {
        $db = mysqli_connect("localhost","root","","test");
        $check_exists_state = "select * from state where state_name='$params[state_name]' and country_id='$params[country]'"; 
        $check_res = $db->query($check_exists_state);
        if(mysqli_num_rows($check_res) > 0) {
            header("Location: state.php?msg=This State is Already Exists In This Country");
            die;
        }
        $sql = "insert into `state`(`id`,`state_name`,`country_id`) values(Null, '$params[state_name]', '$params[country]')";
        $result = $db->query($sql);
        header("Location: state.php");
    }
    
    public static function insertCity($params) {
        $db = mysqli_connect("localhost","root","","test");
        $check_exists_city = "select * from city where city_name='$params[city_name]' and state_id='$params[state]'"; 
        $check_res = $db->query($check_exists_city);
        if(mysqli_num_rows($check_res) > 0) {
            header("Location: city.php?msg=This City is Already Exists In This State");
            die;
        }
        $sql = "insert into `city`(`id`,`city_name`,`state_id`) values(Null, '$params[city_name]', '$params[state]')";
        $result = $db->query($sql);
        header("Location: city.php");
    }

    public static function insertVillage($params) {
        $db = mysqli_connect("localhost","root","","test");
        $check_exists_village = "select * from village where village_name='$params[village_name]' and city_id='$params[city]'"; 
        $check_res = $db->query($check_exists_village);
        if(mysqli_num_rows($check_res) > 0) {
            header("Location: village.php?msg=This Village is Already Exists In This City");
            die;
        }
        $sql = "insert into `village`(`id`,`village_name`,`city_id`) values(Null, '$params[village_name]', '$params[city]')";
        $result = $db->query($sql);
        header("Location: village.php");
    }
}

?>