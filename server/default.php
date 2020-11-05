<?php

class Defaults {

    public static function getDyanamicTableList($db, $table, $id=" ", $column_name, $status=""){
        $ids_array = array();
        if($id!=" ") {
            $sql = "select id from $table where $column_name = '$id'";
        } else {
            $sql = "select id from $table where $column_name = '$status'";
        }
        $res = $db->query($sql);
        $states = $res->fetch_all(MYSQLI_ASSOC);
        if(count($states)){
           foreach($states as $k=> $state_value){
               foreach($state_value as $id){
                   array_push($ids_array, $id);
               }
           }
        }
        return $ids_array;
   }

   public static function changeDeleteStatus($db, $table, $id){
       $sql = "update $table set delete_status = 1 where id = '$id'";
       $res = $db->query($sql);
   }

   public static function getSqlDataInArrayFormed($db, $sql) {
        $res = $db->query($sql);
        return $res->fetch_all(MYSQLI_ASSOC);
        // foreach($return as $key => $value) {
            
        // }
   }

}

?>