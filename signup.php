<?php
include_once('./includes/common.functions.php');
if(isset($_POST['signup']))
{
    $email=mysqli_real_escape_string($mysqli,$_POST['userEmail']);
    $password1=$_POST['password1'];
    $password2=$_POST['password2'];
    $firstName=mysqli_real_escape_string($mysqli,$_POST['fName']);
    $lastName=mysqli_real_escape_string($mysqli,$_POST['lName']);
    
    if($password1 != $password2)
    {
        logError("passwords aren't matched.");
    }
    else
    {
    $password1=password_hash($password1, PASSWORD_DEFAULT);
    
    $sql="SELECT * FROM users WHERE userEmail='$email'";
    $result=$mysqli->query($sql)or die("query failed due to ".mysqli_error());
    if($result->num_rows==1)
    {
        logError("Email Already Exists.");
    }
    else
    {
        $key=md5(uniqid(rand(),true));
        
        $sql ="INSERT INTO users (userEmail,userPassword,userFirstName,userLastName,userLevel,joinDate,userKey,userState) VALUES
                ('$email','$password1','$firstName','$lastName',2,NOW(),'$key',0)";
        $result=$mysqli->query($sql)or die("query failed due to ".mysqli_error());
        logSuccess("account created succeffuly");
        $id=$mysqli->insert_id;
        header("location:./mailSender.php?action=activate&id=$id");
        exit();
    }
    
    }
    
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>sign up</title>
    <link rel="stylesheet" href="./styles/main/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="./styles/main/bootstrap_custom.css" type="text/css"/>
    <link rel="stylesheet" href="./styles/mainStyle.css" type="text/css"/>
   <link rel="stylesheet" href="./styles/extra/templatemo-art-factory.css" type="text/css"/>
    <meta http-equiv="refresh" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width" initial-scale="1.0"/>
</head>

<body>


<div id="upperPanel">
<?php
include_once('./layout/upperBar.php');
//include_once('./layout/searchPanel.php');
?>
</div>
<div class=" container">
<?php
include_once('./layout/searchPanel.php');
?>    
<div class="row">
<div class="col col-md-4 col-md-offset-4">
   <div class="panel panel-success">
    <div class="panel-heading">
        Register
    </div>
    <div class="panel-body">
<form id="loginForm" method="post" action="">
<div class="form-group alert-warning">
<?php
printError();
printSuccess();
?>
</div>
<div class="form-group">
    <label class="control-label">First Name :</label>
    <input type="text" name="fName" required  class="form-control" />
</div>
<div class="form-group">
    <label class="control-label">Last Name :</label>
    <input type="text" name="lName" required  class="form-control"/>
</div>

<div class="form-group">
    <label class="control-label">Email :</label>
    <input type="email" name="userEmail" required class="form-control" />
</div>
<div class="form-group">
    <label class="control-label">Password :</label>
    <input type="password" name="password1" required class="form-control"/>
</div>

<div class="form-group">
    <label class="control-label">Password again :</label>
    <input type="password" name="password2" required class="form-control"/>
</div>
<div class="form-group">
    <input type="submit" name="signup" value="sign up" class="btn btn-success btn-block" />
</div>
</form>
</div>
</div></div></div></div>
<?php
include_once('./layout/footerBar.php');
?>
<script type="text/javascript" src="./js/main/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="./js/main/bootstrap.js"></script> 
</body>
</html>