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

<!-- <script src="release/go-debug.js"></script> -->
<!-- Copyright 1998-2021 by Northwoods Software Corporation. -->
<title>Family Tree</title>
</head>

<body>
  <?php include("./layout/nav.php");?>
  <div class="container pt-5">
    <h4>Request as member of your family tree</h4>

    <table class="table">
    <thead>
        <tr>
        <th scope="col">Username</th>
        <th scope="col">Status</th>
        <th scope="col">For Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
    // Using database connection file here

    $family_id = $_SESSION['family_id'];
    $sql = "SELECT * FROM users WHERE family_req = '$family_id' AND role = 'pending' ";
    $result = $db->query($sql);

    while($row = $result->fetch_assoc())
    {
        $user = $row['username'];
    ?>
    <tr>
        <td><?php echo $row['username']; ?></td>
        <td><?php echo $row['role']; ?></td>
        <td> 		
            <form action="" method="post">
                <input type="hidden" name="sender" value="<?php echo $user;?>">
                <input type='submit' name="approve" value='Approved' id='priority'>
                <input type='submit' name="reject" value='Reject' id='priority'>
            </form>
        </td>
    </tr>	
    <?php
    }
    ?>
    </table>
</div>
<?php mysqli_close($db); // Close connection ?>
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