<?php
include('server.php');

//check kalau dah login
if (!isset($_SESSION['username'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}
//check kalau dh logout
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header("location: login.php");
}
$username = $_SESSION['username'];
$familyasal = $_SESSION['family_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover"/>
<meta name="description" content="A genogram is a family tree diagram for visualizing hereditary patterns."/> 
<link rel="stylesheet" href="style.css"/> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gojs/2.1.52/go.js" integrity="sha512-ddF1BmsTkVfwXavBXKZgj3fTIfDUMfx4+mcEIU2AjsQXL3ZPbTqfli9X8h/oe7NtPW9xuliG8z77e/BAAsqGyg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://kit.fontawesome.com/49ca8bb133.js" crossorigin="anonymous"></script>
<style>
    .login-form {
        width: 340px;
        margin: 50px auto;
        font-size: 15px;
    }
    .login-form form {
        margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
<title>Family Tree</title>
</head>
<body>
  <?php include("./layout/nav.php");?>
  <div class="container pt-5">
  <div class="login-form">
      <h2>Request as member</h2>
            <p>You are not a member of family tree yet. Please request as member first. You may make changes after the member approve you</p>
            <form method="post" action="index.php">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Send request to</label>
                <select id="cars" name="memberid" class="form-select">
                  <option selected value="">--</option>
                  <?php
                    $family_id = $_SESSION['family_find'];
                    $sql = "SELECT * FROM users WHERE family_id = '$family_id' AND role = 'member'" ;
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                  
                      while($row = $result->fetch_assoc()) {
                        echo "<option value='". $row['id'] ."'>" .$row['username'] ."</option>";
                      }
                    } 
                    header('location: index2.php');
                  ?>
                </select>
              </div>

              <!-- <input type="hidden" name="role" value="pending" class="form-check-input" id="exampleCheck2"> -->

              <button type="submit" name="request" class="btn btn-primary">Request as member</button>
            </form>
        </div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
        /* When the user clicks on the button, 
        toggle between hiding and showing the dropdown content */
        function myFunction() {
          document.getElementById("myDropdown").classList.toggle("show");
        }
        
        // Close the dropdown if the user clicks outside of it
        window.onclick = function(e) {
          if (!e.target.matches('.dropbtn')) {
          var myDropdown = document.getElementById("myDropdown");
            if (myDropdown.classList.contains('show')) {
              myDropdown.classList.remove('show');
            }
          }
        }
//utk disable button
        // if($("#family").val() == '' )
        // {
        //   $("#buttonid").attr('disabled',true);
        // }
        // else
        // {
        //   $("#buttonid").attr('disabled',false);
        // }
        </script>
</body>
</html>