<?php
    session_start();
    if (isset($_SESSION['UID'])){
        $UID = $_SESSION['UID'];
        $CID=@$_POST['creditcard'];
        
        include("./DBconnection.php");
        $addpersonalcreditcard = "INSERT INTO `user_creditcard_relation` ( `UID`, `CID`) VALUES ( '$UID', '$CID');";
        $addpersonalcreditcard_result = mysqli_query($conn, $addpersonalcreditcard);
        if($addpersonalcreditcard_result){
            header("Refresh:0;url=./personalCreditCard.php");
        }else{
            echo "fell";
        }
    }else{
        header("Refresh:0;url=./home.php");
    }
?>