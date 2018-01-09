<?php
session_start();
include 'connect.php';
include 'actionpage.php';
$Name = $_SESSION["Name"];
$cv = mysql_query("CREATE OR REPLACE VIEW test5 AS SELECT pain, empname, id, skill, pro, desire FROM login L INNER JOIN users U ON L.id = U.en WHERE empname = '".$Name."'");
mysql_query($cv);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>Skills Homepage</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="homepage.css">
</head>

<body>

<div class="header">
  <h1>Analysts Skills Profile
  <button type="button" class="logout">Logout</button>
  <button class="signin" onclick="document.getElementById('id01').style.display='block'">Login</button>
  </h1>
  <p> Welcome <?php $Name ?></p>
</div>

<div class="topnav">
  <button class="button" data-modal="add">Add Skills</button>
  <button class="button" data-modal="edit">Edit Skills</button>
  <button class="button" data-modal="conf">Conferences</button>
</div>

<!--SIGN IN-->

<div id="id01" class="simodal">
  <span onclick="document.getElementById('id01').style.display='none'" 
class="siclose" title="Close Modal">&times;</span>
  <form name="signin" class="simodal-content animate" action="actionpage.php" method="post">

    <div class="sicontainer">
      <label><b>Full Name</b></label>
      <input type="text" placeholder="Enter Full Name" name="uname" required>

      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <input type="submit" class="login" name="signin" value="Login In">
    </div>

    <div class="sicontainer" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <button type="button" onclick="document.getElementById('id02').style.display='block'" class="signup">Sign Up</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>


<!--SIGN UP-->

<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="suclose" title="Close Modal">×</span>
  <form class="simodal-content animate" action="actionpage.php" method="post">
    <div class="sicontainer">
      <label><b>Full Name</b></label>
      <input type="text" placeholder="Enter Your Full Name Please" name="name" required>

      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="pass" required>

      <label><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="passrepeat" required>

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Sign Up</button>
      </div>
    </div>
  </form>
</div>

<!--ADD SKILL-->

<div id="add" class="modal">
 <div class="modal-content">
 <div class="modal-header">
 <span class="close">&times;</span>
  <h2>Add Skills</h2>
 </div>
 <div class="modal-body">
<?php
        $sql = "SELECT skill FROM skills ORDER BY skill";
        $rs = mysql_query($sql);

                echo "<form name='skill' id='skill' method='post'>";
                echo "<select name='select[]' multiple='multiple'onchange='myfunction()' size='50'>";
                        while($row = mysql_fetch_array($rs)) {
                echo "<option value='".$row['skill']."'>".$row['skill']."</option>";
                        }
                echo "</select>";

        echo "<input type='submit' value='Add' name='add'>";
                echo "</form>";


$selected = array();
foreach ((array) $_POST['select'] as $skillselect){
$selected[] = "'".mysql_real_escape_string($skillselect)."'";
$selected_joined = join(', ', $selected);
}
?>
 </div>
 <div class="modal-footer">
 </div>
</div>
</div>

<!--EDIT SKILL-->

<div id="edit" class="modal">
 <div class="modal-content">
<div class="modal-header">
 <span class="close">&times;</span>
  <h2>Edit Your Skills</h2>
 </div>
 <div class="modal-body">
<?php
$q = "SELECT empname, pain, skill, pro, desire FROM test5";
$r = mysql_query($q);
?>
<form name="bulk_action_form" method="post" onsubmit="return deleteConfirm();"/>
<table border=1 align=center>
        <tr>
        <th>Skill</th>
        <th>Proficiency</th>
        <th>Desired Level</th>
        <th>Plan</th>
        <th>Delete<input type="checkbox" name="select_all" id="select_all" value=""/></th>
        </tr>
                <tr>
<?php
                if(mysql_num_rows($r) > 0){
                while($rws1 = mysql_fetch_array($r)) {
                echo "</td>";
                echo "<td><input type=text name=skill value=".$rws1[skill]." readonly></td>";
                echo "<td><input type=number name=pro value=".$rws1[pro]." min=0 max=5></td>";
                echo "<td><input type=number name=desire value=".$rws1[desire]." min=0 max=5></td>";
                echo "<td><input type=text name=plan></td>";
                echo "<td align='center'><input type='checkbox' name='checked_id[]' class='checkbox' value='".$rws1['pain']."'/>";
                echo "<input type=text name=sid value=".$rws1['pain'].">";
                echo "</tr>";
                }
                } else {
                        echo "<tr><td colspan='5'>No records found.</td></tr>";
}
                echo "</table>";
                echo "<input type='submit' class='btn btn-danger' name='bulk_delete_submit' value='Update'/>";
                echo "</form>";
                        if(isset($_POST['bulk_delete_submit'])){
                                mysql_query("UPDATE users SET skill='$skill1',pro='$pro1',desire='$desire1' WHERE pain = '$id1'");
                               }elseif(isset($_POST['checked_id'])) {
                                 $idArr = $_POST['checked_id'];
                                foreach($idArr as $idnum){
                                    mysql_query("DELETE FROM users WHERE pain = $idnum;");
                                }
                                $_SESSION['success_msg'] = 'Users have been deleted successfully.';
                                echo("<meta http-equiv='refresh' content='0'>");
                                    }

?>
 </div>
 <div class="modal-footer">
 </div>
</div>
</div>

<!--SKILL TABLE-->

</br>
<?php
$msql = "SELECT empname, id, skill, pro, desire FROM test5";
$record = mysql_query($msql);


echo "<table border=1 align=center>";
        echo "<tr>";
        echo "<th>Skill</th>";
        echo "<th>Proficiency</th>";
        echo "<th>Desired Level</th>";
        echo "<th>Plan</th>";
        echo "</tr>";
                echo "<tr>";
                if(mysql_num_rows($record) > 0){
                while($rws = mysql_fetch_array($record)) {
                echo "<td><input type=text name=skill value=".$rws[skill]." readonly></td>";
                echo "<td><input type=text name=pro value=".$rws[pro]." min=0 max=5 readonly></td>";
                echo "<td><input type=text name=desire value=".$rws[desire]." min=0 max=5 readonly></td>";
                echo "<td><input type=text name=plan></td>";
                echo "<input type=hidden name=id value=".$rws['id'].">";
                echo "</tr>";
                $_SESSION['id'] = $rws['id'];
                }
                } else {
                echo "<tr><td colspan='4'>No records found.  Please login or add your skills.</td></tr>";

}
        if(isset($_POST['select'])) {

        echo "<table border=1 align=center>";
        echo "<tr>";
        echo "<th>Skill</th>";
        echo "<th>Proficiency</th>";
        echo "<th>Desired Level</th>";
        echo "</tr>";
                $cv2 = mysql_query("CREATE OR REPLACE VIEW test4 AS SELECT skill FROM skills WHERE skill in ($selected_joined)");
                mysql_query($cv2);
                $msql2 = "SELECT skill FROM test4";
                $record2 = mysql_query($msql2);
                        while($rwinput = mysql_fetch_array($record2)) {
                        echo "<tr><form name='update' method='post'>";
                        echo "<td><input type=text name=skill[] value=".$rwinput[skill]."></td>";
                        echo "<td><input type=number name=pro[] min=0 max=5></td>";
                        echo "<td><input type=number name=desire[] min=0 max=5></td>";
                        echo "</tr>";
                        }

        echo "</table>";

        echo "<input type=submit value=Update name=update>";
                        echo "</form>";

        }elseif(isset($_POST['update'])) {

                $id = $_SESSION['id'];;
                $skill = $_POST['skill'];
                $pro = $_POST['pro'];
                $desire = $_POST['desire'];
                $length = count($skill);
                for($key=0;$key<$length;$key++){
                $addsql= "INSERT INTO users (en,skill,pro,desire) VALUES ('$id','$skill[$key]','$pro[$key]','$desire[$key]')";
                mysql_query($addsql);
                        }
echo("<meta http-equiv='refresh' content='0'>");
}
?>

<script>

var modalBtns = [...document.querySelectorAll(".button")];
modalBtns.forEach(function(btn){
  btn.onclick = function() {
    var modal = btn.getAttribute('data-modal');
    document.getElementById(modal).style.display = "block";
  }
});

var closeBtns = [...document.querySelectorAll(".close")];
closeBtns.forEach(function(btn){
  btn.onclick = function() {
    var modal = btn.closest('.modal');
    modal.style.display = "none";
  }
});

window.onclick = function(event) {
  if (event.target.className === "modal") {
    event.target.style.display = "none";
  }
}
</script>

<script src="jquery.min.js"></script>
<script type="text/javascript">
function deleteConfirm(){
    var result = confirm("Are you sure you want to update your skill set?");
    if(result){
        return true;
    }else{
        return false;
    }
}

$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });

    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});


var modal = document.getElementById('id01');

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

var modal = document.getElementById('id02');

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>


</html>
