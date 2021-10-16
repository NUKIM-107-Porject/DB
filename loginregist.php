<?php 
    session_start();
    echo $_SESSION['UID'];
?>
 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Initial</title>
    <style type="text/css">
        input[type="submit"]{
            cursor: pointer;
        }
    </style>
</head>

<body>
    <center>
        <h2>Login Here</h2>
        <form action="loginVerify.php " method="POST">
            <table>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="text" id="Uemail" name="Uemail">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" id="Upassword" name="Upassword">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit" value="Login">
                    </td>
                </tr>
                <tr>
                    <td>
                        Not Yet A Member?
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="signup.html">Regist</a>
                    </td>
                </tr>
                <!-- <tr>
                    <td>
                        <a href="visiter.html">Visit</a>
                    </td>
                </tr> -->

            </table>
    </center>
</body>

</html>