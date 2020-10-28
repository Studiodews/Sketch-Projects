<?php
//include_once('./common.functions.php');


/**
*login if username and password match
* @param string user email
* @param string password
* */

function signin($email, $password) {
  //$email=mysqli_real_escape_string($email);
  // $password=mysqli_real_escape_string($password);
// was planning to ise prepared statement
/*
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();


	$stmt->close();
}
*/
  //calculate md5 hash for password
  global $mysqli;
  $sql = "SELECT * FROM users WHERE userEmail ='$email'";

  $result = $mysqli->query($sql) or die("query failed due to ".mysqli_error());
  
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    if (password_verify($password, $row['userPassword'])==FALSE) 
    {
      logError("Invalid Password.");
    } 
    else if ($row['userState'] == 0) {
        logError("This account hasn't been activated yet.");
      } else {
        $_SESSION['athorized'] = true;
        $_SESSION['userID'] = $row['userID'];
        $_SESSION['devID'] = $row['relatedID'];
        $_SESSION['userLevel'] = $row['userLevel'];
        $_SESSION['firstName'] = $row['userFirstName'];
        $_SESSION['lastName'] = $row['userLastName'];
        header("location:./");
        exit();
      } 
  } 
  else
    {
      logError("Wrong Email.");
    }
}

  /**
  * log out
  * */
  function logout() {
    if (isset($_SESSION['athorized'])) {
      session_destroy();
      //unset($_SESSION['athorized']);
    }
  }

  /**
  * check if user signed in or not
  * @return boolean true if signed or false
  * */

  function isSignedIn() {
    if (isset($_SESSION['athorized'])) {
      return true;
    } else
    {
      return false;
    }
  }
  ?>