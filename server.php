<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'familytree');

// REGISTER USER
if (isset($_POST['reg_user'])) {


  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }
  $query= "SELECT MAX( family_id ) AS max FROM users ";
  //$query= "SELECT MAX(family_id) FROM users";
  $results = mysqli_query($db, $query);
  while($row = $results->fetch_assoc()) {
    $highestValue = $row['max'];
  }
  $ffamily = $highestValue + 1 ;

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password, family_id, role) 
  			  VALUES('$username', '$email', '$password' , '$ffamily' , 'member')";
  	mysqli_query($db, $query);
    $_SESSION['username'] = $username;
    
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
      while($row = $results->fetch_assoc()) {
        $_SESSION['user_id'] = $row["id"];
        $_SESSION['family_id'] = $row["family_id"];
      }
      }
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

// ADD MEMBER
if (isset($_POST['add_member'])) {

  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $sex = mysqli_real_escape_string($db, $_POST['sex']);
  $father = mysqli_real_escape_string($db, $_POST['father']) == "" ? null : (int)mysqli_real_escape_string($db, $_POST['father']);
  $mother = mysqli_real_escape_string($db, $_POST['mother']) == "" ? null : (int)mysqli_real_escape_string($db, $_POST['mother']);
  $husband = mysqli_real_escape_string($db, $_POST['husband']) == "" ? null : (int)mysqli_real_escape_string($db, $_POST['husband']);
  $wife = mysqli_real_escape_string($db, $_POST['wife']) == "" ? NULL : (int)mysqli_real_escape_string($db, $_POST['wife']);
  $family = mysqli_real_escape_string($db, $_POST['family']) == "" ? null : (int)mysqli_real_escape_string($db, $_POST['family']);

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	// $password = md5($password_1);//encrypt the password before saving in the database
    
  	$query = "INSERT INTO users (username, gender, father_id, mother_id, husband_id, wife_id, family_id) 
  			  VALUES('$username', '$sex', '$father', '$mother', '$husband', '$wife', '$family')";
    mysqli_query($db, $query);
  	header('location: index.php');
  }
}

//EDIT MEMBER
if (isset($_POST['edit_member'])) {

  // receive all input values from the form
  $person = mysqli_real_escape_string($db, $_POST['person']);
  $sex = mysqli_real_escape_string($db, $_POST['sex']);
  $father = mysqli_real_escape_string($db, $_POST['father']) == "" ? null : (int)mysqli_real_escape_string($db, $_POST['father']);
  $mother = mysqli_real_escape_string($db, $_POST['mother']) == "" ? null : (int)mysqli_real_escape_string($db, $_POST['mother']);
  $husband = mysqli_real_escape_string($db, $_POST['husband']) == "" ? null : (int)mysqli_real_escape_string($db, $_POST['husband']);
  $wife = mysqli_real_escape_string($db, $_POST['wife']) == "" ? null : (int)mysqli_real_escape_string($db, $_POST['wife']);

  $username = $_SESSION['username'];
  $query = "SELECT * FROM users WHERE username='$username'";
  $results = mysqli_query ($db, $query);
  while ($row = $results->fetch_assoc()){
    $role = $row["role"];
  }

  if (count($errors) == 0 && $role == 'member') {
  	// $password = md5($password_1);//encrypt the password before saving in the database
    
  	$query = "UPDATE users SET gender='$sex', father_id='$father', mother_id='$mother', husband_id='$husband', wife_id='$wife' WHERE id=$person";
  	mysqli_query($db, $query);
  	header('location: index.php');
  }
  else {
    array_push($errors, "Please request as member first");
    header('location: requestmember.php');
  }
}

if (isset($_POST['del_member'])) {

  // receive all input values from the form
  $person = mysqli_real_escape_string($db, $_POST['person']);

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	// $password = md5($password_1);//encrypt the password before saving in the database
    $query = "DELETE FROM users WHERE id=$person";
  	mysqli_query($db, $query);
  	header('location: index.php');
  }
}



// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
      while($row = $results->fetch_assoc()) {
        $_SESSION['user_id'] = $row["id"];
        $_SESSION['family_id'] = $row["family_id"];
      }
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

if (isset($_POST['find_user'])) {
  if (!empty($_REQUEST['username'])) {

    $username = mysqli_real_escape_string($db, $_REQUEST['username']);     
    
    $query = "SELECT * FROM users WHERE username ='$username'"; 
    $results = mysqli_query($db, $query); 

    while ($row = $results->fetch_assoc()){  
      $_SESSION['family_find'] = $row["family_id"];
      }
      header('location: index2.php');  
    }

}

if (isset($_POST['request'])) {
  $person = mysqli_real_escape_string($db, $_POST['memberid']);
  $username = $_SESSION['username'];
  $family_req = $_SESSION['family_find'];
  $query = "UPDATE users SET role ='pending', family_req = '$family_req' WHERE username = '$username'";
  mysqli_query($db, $query);
  header('location: index.php');
}

if (isset($_POST['approve'])) {
  $family_req = $_SESSION['family_id'];
  $sender = mysqli_real_escape_string($db, $_POST['sender']);
  $query = "UPDATE users SET role ='member', family_id = '$family_req', family_req = NULL WHERE username = '$sender'";
  mysqli_query($db, $query);
  header('location: message.php');
}

if (isset($_POST['reject'])) {
  $sender = mysqli_real_escape_string($db, $_POST['sender']);
  $query = "UPDATE users SET role ='member' , family_req = NULL WHERE username = '$sender'";
  mysqli_query($db, $query);
  header('location: message.php');
}
?>