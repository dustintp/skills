<?php
session_start();
include 'connect.php';
$error='';
        if(isset($_POST['signin'])) {
        if(empty($_POST['uname']) || empty($_POST['psw'])){
                $error = "Username or Password is Invalid";
        }
        else
        {
                $Name=$_POST['uname'];
                $Password=$_POST['psw'];

                $query= mysql_query("SELECT * FROM login WHERE password='$Password' AND empname='$Name'");
                $rows= mysql_num_rows($query);
                if($rows == 1){
                ?>
                        <script type="text/javascript">
                        window.location.href = 'homepage2.php';
                        </script>
                <?php
                 }
                else
                {
                        $error = "Name or Passowrd is Invalid";
                }
        }
}
$_SESSION["Name"]= $Name;
        if(isset($_POST['signup'])) {
        mysql_query("INSERT INTO login (empname,password) VALUES ('$_POST[name]','$_POST[psw]')");
}



?>

