<nav id="navTop" class="w-full z-30 top-0 text-white bg-nwoods-primary">
    <div class="w-full container max-w-screen-lg mx-auto flex flex-wrap sm:flex-nowrap items-center justify-between mt-0 py-2">
      <div class="md:pl-4">
        <a class="text-white hover:text-white no-underline hover:no-underline
        font-bold text-2xl lg:text-4xl rounded-lg hover:bg-nwoods-secondary " href="index.php">
          <h1 class="mb-0 p-1 ">Family Tree</h1>
        </a>
      </div>
      <button id="topnavButton" class="rounded-lg sm:hidden focus:outline-none focus:ring" aria-label="Navigation">
        <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
          <path id="topnavOpen" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
          <path id="topnavClosed" class="hidden" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
      </button>
      <div id="topnavList" class="hidden sm:block items-center w-auto mt-0 text-white p-0 z-20">
        <ul class="list-reset list-none font-semibold flex justify-end flex-wrap sm:flex-nowrap items-center px-0 pb-0">
            <li class="p-1 sm:p-0">
                <a class="topnav-link" href="index.php">Your Family</a>
                <button type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-caret-down"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <li>
                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal">
                            Edit Member
                        </button>
                    </li>
                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addModal">
                            Add Member
                        </button>
                    </li>
                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            Delete Member
                        </button>
                    </li>
                </ul>
            </li> 
            <li class="p-1 sm:p-0">
                <button type="button" data-bs-toggle="modal" data-bs-target="#findModal">Find family</button>
                <button type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-caret-down"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                    <li><a class="dropdown-item" href="requestmember.php">Request as member</a></li>
                </ul>
            </li> 
            <li>
            <button type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $username?> <i class="fa fa-caret-down"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="message.php">Message</a></li>
              <li><a class="dropdown-item" href="index.php?logout='1'">Logout</a></li>
            </ul>
            </li>
            
        </ul>
      </div>
    </div>
    <hr class="border-b border-gray-600 opacity-50 my-0 py-0" />
  </nav>

   <!-- addmember -->
  	<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Member</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post" action="index.php">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Sex</label>
                <select id="cars" name="sex" class="form-select">
                  <option value="F">Female</option>
                  <option value="M">Male</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mother</label>
                <select id="cars" name="mother" class="form-select">
                  <option selected value="">--</option>
                  <?php
                    $sql = "SELECT * FROM users WHERE family_id = '$myfamily' AND gender = 'F' ";
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                  
                      while($row = $result->fetch_assoc()) {
                        echo "<option value='". $row['id'] ."'>" .$row['username'] ."</option>";
                      }
                    } else {
                      echo "0 results";
                    }
                  ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Father</label>
                <select id="cars" name="father" class="form-select">
                  <option selected value="">--</option>
                  <?php
                    $sql = "SELECT * FROM users WHERE family_id = '$myfamily' AND gender = 'M' ";
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                  
                      while($row = $result->fetch_assoc()) {
                        echo "<option value='". $row['id'] ."'>" .$row['username'] ."</option>";
                      }
                    } else {
                      echo "0 results";
                    }
                  ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Wife</label>
                <select id="cars" name="wife" class="form-select">
                  <option selected value="">--</option>
                  <?php
                    $sql = "SELECT * FROM users WHERE family_id = '$myfamily' AND gender = 'F' AND (husband_id IS NULL || husband_id = '') ";
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                  
                      while($row = $result->fetch_assoc()) {
                        echo "<option value='". $row['id'] ."'>" .$row['username'] ."</option>";
                      }
                    } else {
                      echo "0 results";
                    }
                  ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Husband</label>
                  <select id="cars" name="husband" class="form-select">
                  <option selected value="">--</option>
                  <?php
                    $sql = "SELECT * FROM users WHERE family_id = '$myfamily' AND gender = 'M' AND (wife_id IS NULL || wife_id = '') ";
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                  
                      while($row = $result->fetch_assoc()) {
                        echo "<option value='". $row['id'] ."'>" .$row['username'] ."</option>";
                      }
                    } else {
                      echo "0 results";
                    }
                  ?>
                </select>
              </div>
              <input type="hidden" name="family" value="<?php echo $_SESSION['family_id'];?>" class="form-check-input" id="exampleCheck1">
              <button type="submit" name="add_member" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
	  </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Member</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post" action="index.php">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Person</label>
                <select id="cars" name="person" class="form-select">
                  <option selected value="">--</option>
                  <?php
                    $sql = "SELECT * FROM users WHERE family_id = '$myfamily'";
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                  
                      while($row = $result->fetch_assoc()) {
                        echo "<option value='". $row['id'] ."'>" .$row['username'] ."</option>";
                      }
                    } else {
                      echo "0 results";
                    }
                  ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Sex</label>
                <select id="cars" name="sex" class="form-select">
                  <option selected value="">--</option>
                  <option value="F">Female</option>
                  <option value="M">Male</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mother</label>
                <select id="cars" name="mother" class="form-select">
                  <option selected value="">--</option>
                  <?php
                    $sql = "SELECT * FROM users WHERE family_id = '$myfamily' AND gender = 'F' ";
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                  
                      while($row = $result->fetch_assoc()) {
                        echo "<option value='". $row['id'] ."'>" .$row['username'] ."</option>";
                      }
                    } else {
                      echo "0 results";
                    }
                  ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Father</label>
                <select id="cars" name="father" class="form-select">
                  <option selected value="">--</option>
                  <?php
                    $sql = "SELECT * FROM users WHERE family_id = '$myfamily' AND gender = 'M' ";
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                  
                      while($row = $result->fetch_assoc()) {
                        echo "<option value='". $row['id'] ."'>" .$row['username'] ."</option>";
                      }
                    } else {
                      echo "0 results";
                    }
                  ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Wife</label>
                <select id="cars" name="wife" class="form-select">
                  <option selected value="">--</option>
                  <?php
                    $sql = "SELECT * FROM users WHERE family_id = '$myfamily' AND gender = 'F' AND (husband_id IS NULL || husband_id = '') ";
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                  
                      while($row = $result->fetch_assoc()) {
                        echo "<option value='". $row['id'] ."'>" .$row['username'] ."</option>";
                      }
                    } else {
                      echo "0 results";
                    }
                  ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Husband</label>
                  <select id="cars" name="husband" class="form-select">
                  <option selected value="">--</option>
                  <?php
                    $sql = "SELECT * FROM users WHERE family_id = '$myfamily' AND gender = 'M' AND (wife_id IS NULL || wife_id = '')";
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                  
                      while($row = $result->fetch_assoc()) {
                        echo "<option value='". $row['id'] ."'>" .$row['username'] ."</option>";
                      }
                    } else {
                      echo "0 results";
                    }
                  ?>
                </select>
              </div>
              <input type="hidden" name="family" value="<?php echo $_SESSION['family_id'];?>" class="form-check-input" id="exampleCheck1">
              <button type="submit" name="edit_member" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Member</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post" action="index.php">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Person</label>
                <select id="cars" name="person" class="form-select">
                  <option selected value="">--</option>
                  <?php
                    $sql = "SELECT * FROM users WHERE family_id = '$myfamily'";
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                  
                      while($row = $result->fetch_assoc()) {
                        echo "<option value='". $row['id'] ."'>" .$row['username'] ."</option>";
                      }
                    } else {
                      echo "0 results";
                    }
                  ?>
                </select>
              </div>
              <input type="hidden" name="family" value="<?php echo $_SESSION['family_id'];?>" class="form-check-input" id="exampleCheck1">
              <button type="submit" name="del_member" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="findModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Find Member</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="index.php" method="post">  
            Search: <input type="text" name="username" /><br />  
            <button type="submit" name="find_user" class="btn btn-primary">Submit</button>  
          </form>
          </div>
        </div>
      </div>
    </div>