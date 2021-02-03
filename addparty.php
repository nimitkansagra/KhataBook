<?php
    include 'config.php';
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
                            <h3 class="box-title">Add New Party</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form method="post" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" role="form">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter email address">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone number</label>
                                    <input type="text" class="form-control" name="phone" placeholder="Enter phone number">
                                </div>
                                <div class="form-group">
                                    <label for="comment">Address</label>
                                    <textarea class="form-control" rows="5" name="address"></textarea>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary btn-block" name="submit">Save</button>
                            </div>
                        </form>
                        <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                if (isset($_POST['submit'])) {
                                    $name = $_POST['name'];
                                    $email = $_POST['email'];
                                    $phone = $_POST['phone'];
                                    $address = $_POST['address'];

                                    $sql = "INSERT INTO party (name,email,phone,address) VALUES ('$name','$email','$phone','$address')";
                                    echo $sql;
                                    //echo $sql;

                                    if (mysqli_query($conn, $sql)) {
                                        echo '<script>alert("Inserted !");</script>';
                                    }
                                    else {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
    Both of these plugins are recommended to enhance the
    user experience. -->
</body>
</html>
