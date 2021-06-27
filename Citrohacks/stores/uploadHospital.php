<?php 
    include "../pages/db.php";
    $json = file_get_contents('php://input');
    $dataObject = json_decode($json);
    $dataArray = json_decode($json, true);

    foreach($dataArray as $hospital){
        $id = $hospital['id'];
        $hospital_name = $hospital['name'];
        $location = $hospital['vicinity'];
        // echo $hospital_name;

        // $myArrayHospital = array();
        // if ($resultHospital = $conn->query("SELECT * FROM hospitals WHERE `hospital_name` = $hospital_name")) {
        //     while ($row = $resultHospital->fetch_array(MYSQLI_ASSOC)) {
        //     $myArrayHospital[] = $row;
        //     }
        // }
        // echo json_encode($myArrayHospital);
        $sql = "INSERT IGNORE INTO hospitals (id, hospital_name, location) VALUES ('$id','$hospital_name','$location')";
        mysqli_query($conn, $sql);

    }
    // echo $json_encode;
?>