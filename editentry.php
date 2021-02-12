<?php
    include 'config.php';
    $entryid;
    $partyid;
    if (isset($_REQUEST['entryid']) && isset($_REQUEST['partyid'])) {
        $entryid = $_REQUEST['entryid'];
        $partyid = $_REQUEST['partyid'];
    }
 ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Starter</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
    page. However, you can choose any other skin. Make sure you
    apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'menu.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content container-fluid">
                <div class="col-sm-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add New Entry</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <?php
                            $sql = "SELECT * FROM party WHERE id='$partyid'";
                            //echo $sql;
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                        ?>
                        <form method="post" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" role="form">
                            <div class="box-body">
                                <input type="text" id="party_id" name="party_id" hidden>
                                <div class="col-md-12 form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo $row['name']; ?>" readonly>
                                </div>
                                <div class="col-md-12" id="partylist"></div>
                                <div class="col-md-6 form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" value="<?php echo $row['email']; ?>" readonly>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="exampleInputEmail1">Phone number</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number" value="<?php echo $row['phone']; ?>" readonly>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="comment">Address</label>
                                    <textarea class="form-control" rows="5" name="address"><?php echo trim($row['address'],"\t"); ?></textarea>
                                </div>
                                <?php
                                    }
                                    $sql1 = "SELECT * FROM entries WHERE id='$entryid'";
                                    //echo $sql1;
                                    $result1 = mysqli_query($conn, $sql1);

                                    if (mysqli_num_rows($result) > 0) {
                                    $row1 = mysqli_fetch_assoc($result1);
                                 ?>
                                <div class="col-md-6 form-group">
                                    <label for="exampleInputEmail1">Amount</label>
                                    <input type="text" class="form-control" name="amount" placeholder="Enter amount" value="<?php echo $row1['amount']; ?>">
                                </div>
                                <input type="hidden" name="entryid" value="<?php echo $row1['id']; ?>" >
                                <div class="col-md-6 form-group">
                                    <label>Select Type</label>
                                    <select class="form-control" name="type">
                                        <option value="Credit" <?php if($row1['type']=="Credit"){ echo 'selected="selected"';}?>>Credit</option>
                                        <option value="Debit" <?php if($row1['type']=="Debit"){ echo 'selected="selected"';}?>>Debit</option>
                                  </select>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="comment">Note</label>
                                    <textarea class="form-control" rows="5" name="note"><?php echo trim($row1['note'],"\t"); ?></textarea>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <?php
                                }
                             ?>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary btn-block" name="submit">Save</button>
                            </div>
                        </form>
                        <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                if (isset($_POST['submit'])) {
                                    $entry_id = $_POST['entryid'];
                                    $amount = $_POST['amount'];
                                    $type = $_POST['type'];
                                    $note = $_POST['note'];

                                    $sql3 = "UPDATE entries SET amount='$amount',type='$type',note='$note' WHERE id='$entry_id'";
                                    echo $sql3;

                                    if (mysqli_query($conn, $sql3)) {
                                        echo "<script>alert('Data Updated');</script>";
                                        //echo "<script>window.location='editparty.php?id={$id}';</script>";
                                        echo "<script>window.location='viewentry.php';</script>";
                                    }
                                    else{
                                        //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                        echo "<script>alert('Error while updating data');</script>";
                                        echo "<script>window.location='viewentry.php';</script>";
                                    }

                                    mysqli_close($conn);
                                }
                            }
                        ?>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
    Both of these plugins are recommended to enhance the
    user experience. -->
    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <script>
        $(document).ready(function(){
              $('#name').keyup(function(){
                   var query = $(this).val();
                   if(query != '')
                   {
                        $.ajax({
                             url:"fetchpartydetails.php",
                             method:"GET",
                             data:{query:query},
                             success:function(data)
                             {
                                  $('#partylist').fadeIn();
                                  //alert(data);
                                  //$('#partylist').html(data);
                                  var myArr = JSON.parse(data);
                                  //alert(myArr.length);
                                  //alert(data);
                                  // Here array.values() function is called.
                                  var str = '';
                                  for (let index = 0; index < myArr.length; index++) {
                                     var tmp = '';
                                     tmp = '<ul class="list-unstyled" style="border:solid black 1px; padding: 5px; background-color:#ddd;" onclick="selectparyinfo($(this))">';
                                     tmp += '<li>'+ myArr[index].id + '</li>' ;
                                     tmp += '<li>'+ myArr[index].name + '</li>' ;
                                     tmp += '<li>'+ myArr[index].email + '</li>' ;
                                     tmp += '<li>'+ myArr[index].phone + '</li>' ;
                                     tmp += '<li>'+ myArr[index].address + '</li>' ;
                                     tmp += '</ul><br>';
                                     str += tmp;
                                 }
                                 //alert(str);
                                 $('#partylist').html(str);
                             }
                        });
                  }
              });
         });
         function selectparyinfo(obj){
                //$("ul:first-child").val();
                //obj.find(">:first-child").html();
                $('#party_id').val(obj.find(">:first-child").html());
                $('#name').val(obj.find(">:nth-child(2)").html());
                $('#email').val(obj.find(">:nth-child(3)").html());
                $('#phone').val(obj.find(">:nth-child(4)").html());
                $('#address').val(obj.find(">:nth-child(5)").html());
                $('#partylist').fadeOut();
         }
     </script>

</body>
</html>
