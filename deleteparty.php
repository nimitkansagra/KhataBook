<?php
    include 'config.php';
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql = "DELETE FROM party WHERE id='$id'";
            if(mysqli_query($conn, $sql)) {
                echo "<script>alert('Data Deleted !');</script>";
                echo "<script>window.location='viewparty.php';</script>";
            }
            else{
                echo "<script>alert('Error while deleting data !');</script>";
                echo "<script>window.location='viewparty.php';</script>";
            }
        }
    }
 ?>
