<?php 
include('include/conn.php');
if(!isset($_SESSION['user'])):
  ?>
      <script type="text/javascript">
          window.location.href = './';
      </script> <?php
endif;

// print_r($_SESSION['user']);
$school_id = $_SESSION['user']['username'];

if(isset($_POST['donate_val'])):
    print_r($_POST);
    print_r($_SESSION['user']);

    

    $donate_val = $_POST['donate_val'];

    $lack = $_POST['lack'];

    $smartphone = $_POST['smartphone'];

    $notebook = $_POST['notebook'];

    $tablet = $_POST['tablet'];

    $pc = $_POST['pc'];

    $smarttv = $_POST['smarttv'];

    $totalsum = $_POST['totalsum'];

    $project_doc = $_POST['project_doc'];

    $bank = $_POST['bank'];

    $bankno = $_POST['bankno'];

    $bankname = $_POST['bankname'];

    $report_name = $_POST['report_name'];

    $report_position = $_POST['report_position'];

    $report_tel = $_POST['report_tel'];

    $co_name = $_POST['co_name'];

    $co_position = $_POST['co_position'];

    $co_tel = $_POST['co_tel'];

    $di_name = $_POST['di_name'];

    $di_position = $_POST['di_position'];

    $di_tel = $_POST['di_tel'];

    $created_at = date("Y-m-d H:i:s");

    $sql = "SELECT * FROM donate_val where school_id = '".$school_id."'";
    $stmt = $mysql->prepare($sql);

    $stmt -> execute();

    $count = $stmt->rowCount();
    if($count > 0) {
        $sql = "DELETE FROM donate_val where school_id = '".$school_id."'";

        $stmt = $mysql->prepare($sql);

        $stmt->execute();
    }
    $sql = "INSERT INTO donate_val (school_id, donate_val, report_name, report_position, report_tel, created_at) VALUES ('$school_id', '$donate_val' ,'$report_name' ,'$report_position' ,'$report_tel' ,'$created_at')";

      $stmt = $mysql->prepare($sql);
      $stmt -> execute();

    $sql = "INSERT INTO donate_val_log (school_id, donate_val, report_name, report_position, report_tel, created_at) VALUES ('$school_id', '$donate_val' ,'$report_name' ,'$report_position' ,'$report_tel' ,'$created_at')";

      $stmt = $mysql->prepare($sql);
      $stmt -> execute();

    if($donate_val == 1) {
        $sql = "SELECT * FROM donate_info where school_id = '".$school_id."'";
        $stmt = $mysql->prepare($sql);

        $stmt -> execute();

        $count = $stmt->rowCount();
        if($count > 0) {
            $sql = "DELETE FROM donate_info where school_id = '".$school_id."'";

            $stmt = $mysql->prepare($sql);

            $stmt->execute();
        }

        $sql = "INSERT INTO donate_info (school_id, studentLack, needSmartPhone, needNotebook, needTablet, needPC, needSmartTV, totalSum, bankno, bankname, bank, linkproject, co_name, co_position, co_tel, di_name, di_position, di_tel, created_at) VALUES ('$school_id', '$lack', '$smartphone', '$notebook', '$tablet', '$pc', '$smarttv', '$totalsum', '$bankno', '$bankname', '$bank', '$project_doc' ,'$co_name' ,'$co_position' ,'$co_tel', '$di_name' ,'$di_position' ,'$di_tel' ,'$created_at')";

        $stmt = $mysql->prepare($sql);

        $stmt->execute();

        $sql = "INSERT INTO donate_info_log (school_id, studentLack, needSmartPhone, needNotebook, needTablet, needPC, needSmartTV, totalSum, bankno, bankname, bank, linkproject, co_name, co_position, co_tel, di_name, di_position, di_tel, created_at) VALUES ('$school_id', '$lack', '$smartphone', '$notebook', '$tablet', '$pc', '$smarttv', '$totalsum', '$bankno', '$bankname', '$bank', '$project_doc' ,'$co_name' ,'$co_position' ,'$co_tel', '$di_name' ,'$di_position' ,'$di_tel' ,'$created_at')";

        $stmt = $mysql->prepare($sql);

        $stmt->execute();

    }

endif;

?>

<div class="app-main__inner">
    <?php 

    $text1 = " checked";
    $text2 = " ";

    $sql = "SELECT * FROM donate_val where school_id = '".$school_id."'";
    $stmt = $mysql->prepare($sql);

    $stmt -> execute();

    

    $count = $stmt->rowCount();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($count > 0)
    {
        if($row['donate_val'] == 1) {
            $text1 = " checked";
            $text2 = " ";
            ?>
            <script>
                $(document).ready(function(){
                    $("#myDIV").show();
                });
            </script>
            <?php
        } else {
            $text1 = " ";
            $text2 = " checked";
            ?>
            <script>
                $(document).ready(function(){
                    $("#myDIV").hide();
                });
            </script>
            <?php
        }
        
    } 
    // echo $count;
    ?>

        
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <center><h4>ข้อมูลการระดมทรัพยากร</h4></center>
                    <form class="" id="formSubmit" action="?mod=initialize" method="POST" >
                    
                        <div class="row">
                            <div class="col-md-12"><h5 class="card-title">ความประสงค์รับบริจาค</h5>
                                <div class="position-relative form-group">
                                    <div class="row">
                                        <div class="col-6" style="text-align: right;">
                                        <div class="custom-radio custom-control"><input type="radio" id="donateval1" value="1" name="donate_val" class="custom-control-input" <?php echo $text1; ?>><label class="custom-control-label" for="donateval1">รับบริจาค</label></div>
                                    </div>
                                    <div class="col-6">
                                        <div class="custom-radio custom-control"><input type="radio" id="donateval2" value="0" name="donate_val" class="custom-control-input" <?php echo $text2; ?>><label class="custom-control-label" for="donateval2">ไม่รับบริจาค</label></div>
                                    </div>
                                    <div>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="exampleEmail" class="">ชื่อ(ผู้รายงาน)</label><input name="report_name" id="report_name" placeholder="นายรายงาน รายงาน" type="text" class="form-control" required></div>
                                        
                                        <div class="col-md-4">
                                            <label for="exampleEmail" class="">ตำแหน่ง(ผู้รายงาน)</label><input name="report_position" id="report_position" placeholder="ผู้อำนวยการโรงเรียน" type="text" class="form-control" required></div>
                                        
                                        <div class="col-md-4">
                                        <label for="exampleEmail" class="">เบอร์โทร(ผู้รายงาน)</label><input name="report_tel" id="report_tel" placeholder="09-9999-9999" type="text" class="form-control" required></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="myDIV">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="card-title">ข้อมูลความขาดแคลน</h5>
                                    <div class="position-relative form-group">
                                    <div class="row">
                                    <div class="col-md-2">
                                            <label for="exampleEmail" class="">จำนวนนักเรียนที่มีความขาดแคลน</label><input name="lack" id="lack" placeholder="0" type="number" value="0" class="form-control"></div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <h6 class="card-title" style="font-style: italic;">ข้อมูลความจำเป็นขอรับบริจาค</h6>
                                        </div>
                                    
                                    </div>
                                    <div class="row">
                                    <div class="col-md-2">
                                            <label for="exampleEmail" class="">จำนวน Smart Phone</label><input name="smartphone" id="smartphone" placeholder="0" type="number" value="0" class="form-control"></div>

                                    <div class="col-md-2">
                                            <label for="exampleEmail" class="">จำนวน Notebook</label><input name="notebook" id="notebook" placeholder="0" type="number" value="0" class="form-control"></div>

                                    <div class="col-md-2">
                                            <label for="exampleEmail" class="">จำนวน Tablet</label><input name="tablet" id="tablet" placeholder="0" type="number" value="0" class="form-control"></div>

                                    <div class="col-md-2">
                                            <label for="exampleEmail" class="">จำนวน PC</label><input name="pc" id="pc" placeholder="0" type="number" value="0" class="form-control"></div>

                                    <div class="col-md-2">
                                            <label for="exampleEmail" class="">จำนวน Smart TV</label><input name="smarttv" id="smarttv" placeholder="0" type="number" value="0" class="form-control"></div>

                                    <div class="col-md-2">
                                            <label for="exampleEmail" class="">งบประมาณทั้งหมด</label><input name="totalsum" id="totalsum" placeholder="0" type="number" value="0" class="form-control"></div>

                                    </div>
                                    <div class="row mt-1">
                                    <div class="col-md-12">
                                            <label for="exampleEmail" class="">โครงการ(การระดมทรัพยากร)</label><input name="project_doc" id="exampleEmail" placeholder="Link URL Google Drive ที่ทำการเปิดแชร์เป็นสาธารณะ" type="text" class="form-control"></div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <h6 class="card-title" style="font-style: italic;">ข้อมูลการรับบริจาค</h6>
                                        </div>
                                    
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="exampleEmail" class="">ธนาคาร</label><input name="bank" id="bank" placeholder="กรุงไทย" type="text" class="form-control"></div>
                                        
                                        <div class="col-md-4">
                                            <label for="exampleEmail" class="">ชื่อบัญชี</label><input name="bankname" id="bankname" placeholder="โรงเรียนรับบริจาค" type="text" class="form-control"></div>
                                        
                                        <div class="col-md-4">
                                        <label for="exampleEmail" class="">เลขที่บัญชี</label><input name="bankno" id="bankno" placeholder="XXXXXXXXXX" type="text" class="form-control"></div>
                                        
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <h6 class="card-title" style="font-style: italic;">ข้อมูลผู้ประสานงาน
                                            <div class="custom-checkbox custom-control mt-2"><input type="checkbox" id="copy1" class="custom-control-input"><label class="custom-control-label" for="copy1" style="font-weight: 400; font-style: normal;">ใช้ข้อมูลเดียวกับผู้รายงาน</label></div></h6>
                                        </div>
                                    
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="exampleEmail" class="">ชื่อ(ผู้ประสานงาน)</label><input name="co_name" id="co_name" placeholder="นายรายงาน รายงาน" type="text" class="form-control"></div>
                                        
                                        <div class="col-md-4">
                                            <label for="exampleEmail" class="">ตำแหน่ง(ผู้ประสานงาน)</label><input name="co_position" id="co_position" placeholder="ผู้อำนวยการโรงเรียน" type="text" class="form-control"></div>
                                        
                                        <div class="col-md-4">
                                        <label for="exampleEmail" class="">เบอร์โทร(ผู้ประสานงาน)</label><input name="co_tel" id="co_tel" placeholder="09-9999-9999" type="text" class="form-control"></div>
                                        
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <h6 class="card-title" style="font-style: italic;">ข้อมูลผู้บริหาร <div class="custom-checkbox custom-control mt-2"><input type="checkbox" id="copy2" class="custom-control-input">
                                            <label class="custom-control-label" for="copy2" style="font-weight: 400; font-style: normal;">ใช้ข้อมูลเดียวกับผู้ประสานงาน</label></div></h6> 
                                        </div>
                                    
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="exampleEmail" class="">ชื่อ(ผู้บริหาร)</label><input name="di_name" id="di_name" placeholder="นายรายงาน รายงาน" type="text" class="form-control"></div>
                                        
                                        <div class="col-md-4">
                                            <label for="exampleEmail" class="">ตำแหน่ง(ผู้บริหาร)</label><input name="di_position" id="di_position" placeholder="ผู้อำนวยการโรงเรียน" type="text" class="form-control"></div>
                                        
                                        <div class="col-md-4">
                                        <label for="exampleEmail" class="">เบอร์โทร(ผู้บริหาร)</label><input name="di_tel" id="di_tel" placeholder="09-9999-9999" type="text" class="form-control"></div>
                                        
                                    </div>
                                </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="position-relative row form-check">
                            <div class="col-sm-2 offset-sm-5">
                                <button class="mb-2 mr-2 btn btn-success btn-lg btn-block" type="submit">บันทึกข้อมูล</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    
</div>

<script>
    function myFunction1() {
        alert('A')
            document.getElementById("myDIV").display = "block";
        }
    function myFunction2() {
        alert('B')
            document.getElementById("myDIV").display = "none";
        }
    $(document).ready(function(){
        $("#donateval2").click(function(){
            $("#myDIV").hide();
            // alert(document.getElementById("donateval1").checked)
        });
        $("#donateval1").click(function(){
            $("#myDIV").show();
            // alert(document.getElementById("donateval1").checked)
        });
        $("#copy1").click(function(){
            if(document.getElementById("copy1").checked){
            //    alert(document.getElementById("report_name").value)
            // document.getElementById("co_name").value = document.getElementById("report_name").value
            var val1 = $("#report_name").val()
            var val2 = $("#report_position").val()
            var val3 = $("#report_tel").val()
            // alert(val1);
            $("#co_name").val(val1) 
            $("#co_position").val(val2) 
            $("#co_tel").val(val3) 
            //    alert($("#report_name").val())
            }
            
        });
        $("#copy2").click(function(){
            if(document.getElementById("copy2").checked){
            //    alert(document.getElementById("report_name").value)
            // document.getElementById("co_name").value = document.getElementById("report_name").value
            var val1 = $("#co_name").val()
            var val2 = $("#co_position").val()
            var val3 = $("#co_tel").val()
            // alert(val1);
            $("#di_name").val(val1) 
            $("#di_position").val(val2) 
            $("#di_tel").val(val3) 
            //    alert($("#report_name").val())
            }
            
        });
        
        $( "#formSubmit" ).submit(function( event ) {
            if(document.getElementById("donateval1").checked) {
                var checkSubmit = 1
                // alert( "Handler for .submit() called." );
                // event.preventDefault();
                if($("#lack").val() < 1) {
                    checkSubmit = 0
                    alert( "ข้อมูลจำนวนนักเรียนที่มีความขาดแคลนไม่ถูกต้อง" );
                    $( "#lack" ).focus()
                    return false;
                }

                if($("#totalsum").val() < 1) {
                    checkSubmit = 0
                    alert( "ข้อมูลจำนวนนักเรียนที่มีความขาดแคลนไม่ถูกต้อง" );
                    $( "#totalsum" ).focus()
                    return false;
                }

                if($("#bank").val() == "") {
                    checkSubmit = 0
                    alert( "ข้อมูลธนาคารไม่ถูกต้อง" );
                    $( "#bank" ).focus()
                    return false;
                }
                if($("#bankname").val() == "") {
                    checkSubmit = 0
                    alert( "ข้อมูลชื่อบัญชีไม่ถูกต้อง" );
                    $( "#bankname" ).focus()
                    return false;
                }
                if($("#bankno").val() == "") {
                    checkSubmit = 0
                    alert( "ข้อมูลเลขที่บัญชีไม่ถูกต้อง" );
                    $( "#bankno" ).focus()
                    return false;
                }
                if($("#co_name").val() == "") {
                    checkSubmit = 0
                    alert( "ข้อมูลชื่อ(ผู้ประสานงาน)ไม่ถูกต้อง" );
                    $( "#co_name" ).focus()
                    return false;
                }
                if($("#co_position").val() == "") {
                    checkSubmit = 0
                    alert( "ข้อมูลตำแหน่ง(ผู้ประสานงาน)ไม่ถูกต้อง" );
                    $( "#co_position" ).focus()
                    return false;
                }
                if($("#co_tel").val() == "") {
                    checkSubmit = 0
                    alert( "ข้อมูลเบอร์โทร(ผู้ประสานงาน)ไม่ถูกต้อง" );
                    $( "#co_tel" ).focus()
                    return false;
                }
                if($("#di_name").val() == "") {
                    checkSubmit = 0
                    alert( "ข้อมูลชื่อ(ผู้บริหาร)ไม่ถูกต้อง" );
                    $( "#di_name" ).focus()
                    return false;
                }
                if($("#di_position").val() == "") {
                    checkSubmit = 0
                    alert( "ข้อมูลตำแหน่ง(ผู้บริหาร)ไม่ถูกต้อง" );
                    $( "#di_position" ).focus()
                    return false;
                }
                if($("#di_tel").val() == "") {
                    checkSubmit = 0
                    alert( "ข้อมูลเบอร์โทร(ผู้บริหาร)ไม่ถูกต้อง" );
                    $( "#di_tel" ).focus()
                    return false;
                }

                if(checkSubmit == 0){
                    event.preventDefault();
                }
            }
            

        });

    });
</script>