<?php
session_start();
?>
<!DOCTYPE html>
<html>
<style>
form {
    border: 3px solid #f1f1f1;
    width: auto;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 18px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: auto;
    float: left;
}

.signupbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #4CAF50;
}

.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
    float: right;
}

.signupbtn {
    float: left;
    padding: 10px 18px;
    width: auto;
    margin-left: 30%;
}

.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

.container {
    padding: 4px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 50%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 390px;
    top: 370px;
    color: #000;
    font-size: 40px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}
</style>
<body>

<h2 align=center>Login</h2>

<form name="login" action="" method="post">
  <div class="container">
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
  </div>
  <div class="container" style="background-color:#f1f1f1">
    <input type="submit" value="submit" name="submit">
    <button onclick="document.getElementById('id01').style.display='block'" class="signupbtn">Sign Up</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>

<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form class="modal-content animate" action=""  method="post">
    <div class="container">
      <label><b>Name</b></label>
      <input type="text" placeholder="Enter Full Name" name="name" required>

      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <label><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
	<input type="submit" value="Sign Up" name="signup">
      </div>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<?php
$error='';
mysql_connect("127.0.0.1", "root", "d1226605");
mysql_select_db('skills');
        if(isset($_POST['submit'])) {
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
			window.location.href = 'test8.php';
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
</body>
</html>

