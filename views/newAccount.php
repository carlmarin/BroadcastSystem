<?php
  require("database.php");
  $user_check=$_SESSION['login_user'];

  if(isset ($_POST['Signup'])){
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $accessRole = $_POST['accessRole'];

    if (empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['uname']) ||  empty($_POST['pass'])||  empty($_POST['accessRole']))
        echo "<script>alert(All Fields are required !!!);</script>";
    else{
      $query = "insert into account_info (firstname, middlename, lastname, username, password, access_role)
                values('".$fname."', '".$mname."', '".$lname."', '".$uname."', '".$pass."', '".$accessRole."')";
      $result = odbc_exec($conn,$query); 
      echo "<script>alert(New Account was successfully added);</script>";     
    }


  }
?>

<div id="Signup" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Account</h4>
                </div>
                  <div class="modal-body">
                    <form role="form" action="" method="post">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="fname" style='font-size: 130%'>First Name:</label>
                            <input type="text" style='font-size: 130%' class="form-control" id="fname" name="fname">
                        </div>
                        <div class="col-sm-4">
                            <label for="mname" style='font-size: 130%'>Middle Name:</label>
                            <input type="text" style='font-size: 130%' class="form-control" id="mname" name="mname">
                        </div>
                        <div class="col-sm-4">
                            <label for="lname" style='font-size: 130%'>Last Name:</label>
                            <input type="text" style='font-size: 130%' class="form-control" id="lname" name="lname">
                        </div>
                    </div>
                    <div class="row"><br>
                        <div class="col-sm-6">
                            <label for="uname" style='font-size: 130%'>Username:</label>
                            <input type="text" style='font-size: 130%' class="form-control" id="uname" name="uname">
                        </div>
                        <div class="col-sm-6">
                            <label for="pass" style='font-size: 130%'>Password:</label>
                            <input type="password" style='font-size: 130%' class="form-control" id="pass" name="pass">
                        </div>
                    </div>
                    <div class="row"><br>
                        <div class="col-sm-12">
                            <label for="access_role" style='font-size: 130%'>Access Role:</label>
                            <select class="form-control" name="accessRole">
                                <option value="Regular">Regular</option>
                                <option value="Admin">Admin</option>
                                <option value="Head">Head</option>
                            </select>
                        </div>
                    </div>
                  </div>                                 
                  <div class="modal-footer">
                        <button type="submit" class="btn btn-default" name="Signup">Submit</button>
                        <button type="reset" class="btn btn-default">Clear</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal" >Cancel</button>
                  </div>
              </form>
            </div>
        </div>
    </div>
</div>