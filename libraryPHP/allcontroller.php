<?php

include('dbcon.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $action = $_POST['action'];

    if ($action == 'add_form') {
        addForm($_POST);
    }
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $action = $_GET['action'];

    if ($action == 'get_table') {
        getTable($_GET);
    }
}

function addForm($data){

    global $mysqli;

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $delete_flag = 0;

    $result = $mysqli->query("INSERT INTO `test`(`name`, `mobile`, `delete_flag`) VALUES ('$name','$mobile','$delete_flag')");
    
    if ($mysqli -> affected_rows > 0) {

        echo json_encode(['success'=>'true','message'=>'data inserted successfully']);
    }else{
        echo json_encode(['success'=>'true','message'=>'data inserted unsuccessfull']);
    }
}

function getTable() {
    global $mysqli;

    $result = $mysqli->query("SELECT * from `test` WHERE `delete_flag` = 0");
    
    if ($mysqli -> affected_rows > 0) {
        
        $data = [];
        while ($fetch=mysqli_fetch_assoc($result)){
            $data[] = $fetch;
        }
        echo json_encode(['success'=>'true','message'=>'data fetched successfully','data'=>$data]);
    }else{
        echo json_encode(['success'=>'true','message'=>'data fetch unsuccessfull']);
    }
}
?>