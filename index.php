<?php 
	include('server.php');

  //check if php session is started
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

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


  function checkVal($val, $root) {
    if($val == $root){
      $val = (int)0;
    }elseif($val == null){
      $val = null;
    }else{
      $val = (int)$val;
    }
    return $val;
  }
  $username = $_SESSION['username'];
  $family_id = $_SESSION['family_id'];
  $myfamily = $_SESSION['family_id'];
  $user_id = $_SESSION['user_id']; //dalam string
  $int_id = (int) $user_id;

	$sql = "SELECT * FROM users WHERE family_id = '$family_id'";
	$result = $db->query($sql);
  // { key: 0, n: "Aaron", s: "M", m:-10, f:-11, ux: 1, a: ["C", "F", "K"] },
  //kalau family id tu wujud dalam array
	if ($result->num_rows > 0) {
    $no = 0;
    $root = 0;
    $wife = 0;
    $husb = 0;
    $father = 0;
    $mother = 0;
    
		while($row = $result->fetch_assoc()) {
      if($no == 0){
        $root = (int)$row['id']; //return int intead str root= bilangan ahli dalam family
      }
      $wife = checkVal($row['wife_id'], $root);
      $husb = checkVal($row['husband_id'], $root);
      $father = checkVal($row['father_id'], $root);
      $mother = checkVal($row['mother_id'], $root);

      // $datauser = retArray($no, $row['id'], $row['username'], $wife, $husb, $father, $mother, $row['gender']);
      $datauser[] = new stdClass;
      $datauser[$no]->key = $no == 0 ? 0 : (int)$row['id'];
      $datauser[$no]->n = $row['username'];
      if(!is_null($wife)){
        $datauser[$no]->ux = $wife;
      }
      if(!is_null($husb)){
        $datauser[$no]->vir = $husb;
      }
      if(!is_null($father)){
        $datauser[$no]->f = $father;
      }
      if(!is_null($mother)){
        $datauser[$no]->m = $mother;
      }
      $datauser[$no]->s = $row['gender'] ;
      $no++;
		}
	} else {
		echo "0 results";
  }

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
  
  <div class="md:flex flex-col md:flex-row md:min-h-screen w-full max-w-screen-xl mx-auto">
    <div id="navSide" class="flex flex-col w-full md:w-48 text-gray-700 bg-white flex-shrink-0"></div>
    <!-- GOJS -->
    <script src="release/go.js"></script>
    <div class="p-4 w-full">
      <?php include("./layout/tree.php");?>

      <div id="sample">
        <div id="myDiagramDiv" style="background-color: #F8F8F8; border: solid 1px black; width:100%; height:600px;"></div>
      </div>

      <div id="sample2" style="display:none">
        <label for="pwd">Id</label>
        <input type="text" id= "123" name="ABC" value="Some Value">
      </div>
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
