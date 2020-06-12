<?php   

require 'dbh.inc.php';

$id = 0;
$update = false;
$name = '';
$location = '';

if (isset($_POST['save'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);

    if(empty($name) || empty($location)) {
        header("Location: ../secure.php?error=emptyfields");
        exit();
    }
    else {
        $conn->query("INSERT INTO data (name, location) VALUES('$name', '$location')") or 
            die($conn->error);
    
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "succes"; 
    
        header("location: ../secure.php?save=succes");
        exit();
    }

}

if (isset($_GET['delete'])) {

    $id = $_GET['delete'];
    $conn->query("DELETE FROM data WHERE id=$id") or die($conn->error);

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger"; 

    header("location: ../secure.php");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $conn->query("SELECT * FROM data WHERE id=$id") or die($conn->error);
    $arrayValues = array( $result );
    if (count($arrayValues) == 1) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
    }   
}

if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);

    if(empty($name) || empty($location)) {
        header("Location: ../secure.php?error=emptyfields");
        exit();
    }
    else {
        $conn->query("UPDATE data SET name='$name', location='$location' WHERE id=$id") or
            die($conn->error);
    
        $_SESSION['message'] = "Record has been updated!";
        $_SESSION['msg_type'] = "warning";
    
        header("location: ../secure.php?update=succes");
        exit();
    }

}