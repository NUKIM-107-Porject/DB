<?php
    session_start();
    if (isset($_SESSION['UID'])) {
    $UID = $_SESSION['UID'];
    $CID=@$_POST['creditcard'];
    
    include("./DBconnection.php");
    $addpersonalcreditcard = "INSERT INTO `user_creditcard_relation` (`PK`, `UID`, `CID`) VALUES (NULL, '$UID', '$CID');";
    $addpersonalcreditcard_result = mysqli_query($conn, $addpersonalcreditcard);
    
    if($addpersonalcreditcard_result){
        header("Refresh:0;url=./personalcreditcard.php");
    }
    else{
        echo "fell";
    }
}
else {
    header("Refresh:0;url=./initial.php");
}
?>