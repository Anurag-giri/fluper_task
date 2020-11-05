<?php
include('default.php');
if($_REQUEST) {
    if(isset($_REQUEST['fn'])) {
        $function = $_REQUEST['fn'];
        return RollbackController::$function($_REQUEST);
    }
}

class RollbackController {

    public static function rollBackcountry($params) {
        $db = mysqli_connect("localhost","root","","test");
        $lists_id = Defaults::getDyanamicTableList($db, $params['table'], $id=" ", 'delete_status', 1);
        foreach($lists_id as $id) {
            RollbackController::changeUpdateStatus($db, $params['table'], $id, 0);
        }
        header("Location: ../$params[action]");
    }

    public static function changeUpdateStatus($db, $table, $id, $status=" "){
        $sql = "update $table set delete_status = '$status' where id = '$id'";
        $res = $db->query($sql);
    }
}

?>