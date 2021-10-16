<?php
    session_start();
    $CID=@$_POST['creditcard'];
    //echo $CID; 
    $servername = "localhost";
    $username = "root";
    $password = "lin1073329";
    $dbname = "project";

    //Create connection 
    $conn = new mysqli($servername, $username, $password, $dbname);
    //Check connection -->
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $UID = $_SESSION['UID'];
    $addpersonalcreditcard = "INSERT INTO `user_creditcard_relation` (`PK`, `UID`, `CID`) VALUES (NULL, '$UID', '$CID');";
    $addpersonalcreditcard_result = mysqli_query($conn, $addpersonalcreditcard);
    
    if($addpersonalcreditcard_result){
        header("Refresh:0;url=personalcreditcard.php");
    }
    else{
        echo "fell";
    }

?>