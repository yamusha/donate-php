<?php 
include('include/conn.php');
if(isset($_SESSION['user'])):
  ?>
      <script type="text/javascript">
          window.location.href = './';
      </script> <?php
endif;

// print_r($_SESSION['user']);
?>
<div class="app-main__inner">
  <div class="row">
    <div class="col-md-9" style="text-align: center;">
      <h2><b>Donate</b> Login</h2>
    </div>
  </div>
  <div class="tab-content">
      <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
          <div class="row">
              <div class="col-md-5 offset-md-2">
                  <div class="main-card mb-3 card">
                      <div class="card-body">
                      <?php 

                        $text = "";

                        if(isset($_POST['username'])):
                          $sql = "SELECT * FROM user_school ";
                          //echo $sql;
                          $stmt = $mysql->prepare($sql);

                        $stmt = $mysql->prepare("SELECT * FROM user_school WHERE username = :user and password = :pass");

                        $stmt->execute(
                        Array(
                              ':user' => $_POST['username'],
                              ':pass' => $_POST['password']
                        )
                        );


                        // echo $stmt->rowCount();
                            
                          if($stmt->rowCount() >= 1):
                            // echo 1;

                          while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        
                            
                        $_SESSION["user"]=$row;
                        ?>
                          <script type="text/javascript">
                              window.location.href = './';
                          </script> 
                        <?php
                          }
                            
                            
                          else:
                            $text = "value = '".$_POST['username']."'";

                            ?>
                            <div class="alert alert-danger">
                              Username หรือ Password ไม่ถูกต้อง.
                            </div>
                            <?php 
                          endif;
                        endif;
                        ?>
                        <center><h5>เข้าสู่ระบบ</h5></center>
                          <form action="?mod=login" method="POST">
                              <div class="position-relative form-group">
                                <label for="exampleEmail" class="">USERNAME</label>
                                <div class="input-group">
                                  <div class="input-group-prepend"><span class="input-group-text" style="width: 50px;"><i class="pe-7s-user" style="font-size: 17pt;"> </i></span></div>
                                  <input placeholder="username" type="text" class="form-control" name="username" required>
                                </div>
                              </div>
                              <div class="position-relative form-group">
                                <label for="examplePassword" class="">PASSWORD</label>
                                <div class="input-group">
                                  <div class="input-group-prepend"><span class="input-group-text" style="width: 50px;padding-left: 18px;"><i class="pe-7s-key" style="font-size: 17pt;"> </i></span></div>
                                  <input placeholder="password" type="password" class="form-control" name="password" required>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-8">
                                  <input type="submit" class="mt-1 btn btn-primary btn-block" value="เข้าสู่ระบบ" />
                                </div>
                                <div class="col-md-4">
                                  <a href="./" class="mt-1 btn-transition btn btn-outline-light btn-block">กลับหน้าหลัก</a> 
                                </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>