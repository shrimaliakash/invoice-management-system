<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<html>
    <title>Invoice Management</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">

        function jupload()
        {
            $(".imageholder").append('<img src="./images/loading.gif">');
        }

        function juploadstop(result)
        {
            if (result == 0)
            {
                $(".imageholder").html("");

            }
            // the result will be the path to the image
            else if (result != 0)
            {
                $(".imageholder").html("");
                // imageplace is the class of the div where you want to add the image  
                $(".imageplace").append("<img src='" + result + "'>");
            }
        }
    </script>


</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php
        include('header.php');
        ?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php
        include('asidebar.php');
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->


            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <!-- left column -->

                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-10">
                        <!-- Horizontal Form -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Image Form</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->

                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" target="upload_target"  onsubmit="jupload();"  id="form1">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label for="image" id="fileupload" class="col-sm-3 control-label">Image Name</label>

                                        <div class="col-sm-9">
                                            <input type="file" name="fileupload" id="fileupload" /> 
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-info pull-right" name="submit">Upload</button>
                                </div>
                                <!-- /.box-footer -->
                            </form>

                            <?php
                            $target = "uploads/";
                            $target = $target . basename($_FILES["fileupload"]["name"]);
                            $ok = 1;
                            $imagefiletype = pathinfo($target, PATHINFO_EXTENSION);

                            //Check if image file is actual image or fake image
                            if (isset($_POST["submit"])) {
                                $check = getimagesize($_FILES["fileupload"]["tmp_name"]);
                                if ($check !== false) {
                                    echo "File is an image-" . $check["mime"] . ".";
                                    $ok = 1;
                                } else {
                                    echo "File is not a image.";
                                    $ok = 0;
                                }
                            }

                            //Check if file already exists
                            if (file_exists($target)) {
                                echo "sorry,file alradey exists.";
                                $ok = 0;
                            }

                            if (isset($_FILES["fileupload"])) {
                                //code to get image and move to folder or upload it

                                $file_name = $_FILES["fileupload"]["name"];
                                echo "<img src='uploads/$file_name' .$file_name.  height=200 width=300 />";

                                //code to store image in database
                            }

                            //Allow certain file formats
                            if ($imagefiletype != "jpg" && $$imagefiletype != "png" && $imagefiletype != "jpeg" && $imagefiletype != "gif") {
                                echo "sorry,only JPG,PNG,JPEG & GIF  files are allowed.";
                                $ok = 0;
                            }

                            //Ckech if $ok is set to 0 by an error
                            if ($ok == 0) {
                                echo "sorry,your file was not uploaded.";
                                //if everything is ok,try to upload image
                            } else {
                                if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target)) {
                                    echo "The file " . basename($_FILES["fileupload"]["name"]) . "has been uploaded.";
                                } else {
                                    echo "sorry,there was an error uploading your file.";
                                }
                            }
                            ?>

                        </div>
                        <!-- /.box -->
                        <!-- general form elements disabled -->

                        <!-- /.box -->
                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php
        include('footer.php');
        ?>

        <!-- Control Sidebar -->
        <?php
        include('control_sidebar.php');
        ?>
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
             immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 2.2.3 -->
    <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
</body>
</html>
