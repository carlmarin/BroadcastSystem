<?php
  require("database.php");
  $user_check=$_SESSION['login_user'];
  $user_id=$_SESSION['user_id'];

  if(isset ($_POST['edit'])){
    $uname = $_POST['username'];
    $pass = $_POST['password'];

   
      $query = "update account_info set username = '".$uname."', password = '".$pass."' 
                where user_id = ".$user_id."";
      $result = odbc_exec($conn,$query); 
    


  }
?>

<div id="Editprofile" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Account Access</h4>
                </div>
                  <div class="modal-body" style="text-transform: none">
                    <form role="form" action="" method="post">
                      <div class="row"><br>
                        <div class="col-sm-6">
                            <label for="uname" style='font-size: 130%'>Username:</label>
                            <input type="text" style='font-size: 130%' class="form-control" id="uname" name="username">
                        </div>
                        <div class="col-sm-6">
                            <label for="pass" style='font-size: 130%'>New Password:</label>
                            <input type="password" style='font-size: 130%' class="form-control" id="pass" name="password">
                        </div>
                    </div>
                  </div>                                 
                  <div class="modal-footer">
                        <button type="submit" class="btn btn-default" name="edit">Submit</button>
                        <button type="reset" class="btn btn-default">Clear</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal" >Cancel</button>
                  </div>
              </form>
            </div>
        </div>
    </div>
</div>