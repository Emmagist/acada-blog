<?php
    require_once("../includes/session.php");
    include_once '../model/App.php';
    $execute=new App($db);
    // include "Controller.php";

    $sql = ( "SELECT * FROM bloglist  WHERE  title LIKE '%H%' LIMIT 0, 6"); //var_dump($sql);exit;
    $result = mysqli_query($db, $sql); //echo "<pre>";var_dump($result);exit; 
    $fetch = $result->fetch_assoc; echo "<pre>";var_dump($fetch);exit;

    function searchData($table, $field = "*", $conditions = "", $val = '', $limit = ''){
        global $db;
        $rows = [];
            $fields = trim($field);
            $where = !empty($conditions) ? "WHERE" : "";
        $result = $db->query( "SELECT " . $fields . " FROM " . $table . "  $where " . $conditions . " LIKE '%".$val."%' LIMIT " . $limit); //var_dump($result);exit;
        $cout = $result->num_rows; 
        if($cout > 0){
            if (!empty($result)) {
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
                return $rows;
            }
        }
        else{
            return 0;
        }
    }

    if (isset($_POST['search'])){
        
        $value = $db->escape($_POST['v']);

        //$result = searchData("", "*", "title", "$value", "6"); //var_dump($result);exit;
        $sql = ( "SELECT * FROM bloglist  WHERE  title LIKE '%h%' LIMIT 0, 6");
        $result = mysqli_query($db, $sql); var_dump($result);exit;
        $fetch = mysqli_fetch_assoc($result);
       
        // $count = count($result);
        if ($result ==0) {
            echo $respond = " No Record Found";
        }else {
             do {
                echo $val = "<ul >
                    <li style='list-style:none'><a href='course-details.php?clid=".$fetch['entity_guid']."'>" . $fetch['title']. "</a></li>
                </ul>";
             } while ($fetch = mysqli_fetch_assoc($result));
        }
       
        
    }

?>