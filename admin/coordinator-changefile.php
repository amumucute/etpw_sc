<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['oesaid'] <= 2)) {
    header('location:login.php');
} else {
    if (isset($_POST['submit'])) {
        $eid = $_GET['editid'];
        $uploadmag = $_FILES["uploadmag"]["name"];
        $extension = substr($uploadmag, strlen($uploadmag) - 4, strlen($uploadmag));
        $allowed_extensions = array("docs", ".doc", ".pdf");
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('File has Invalid format. Only docs / doc/ pdf format allowed');</script>";
        } else {

            $uploadmag = md5($uploadmag) . time() . $extension;
            move_uploaded_file($_FILES["uploadmag"]["tmp_name"], "../user/files/" . $uploadmag);
            $sql = "update tblmagazine set UploadMagazine=:uploadmag where ID=:eid";
            $query = $dbh->prepare($sql);
            $query->bindParam(':uploadmag', $uploadmag, PDO::PARAM_STR);
            $query->bindParam(':eid', $eid, PDO::PARAM_STR);
            $query->execute();
            echo '<script>alert("Magazine file has been updated!")</script>';
            echo "<script>window.location.href ='coordinator-new-magazine.php'</script>";
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Annual University Magazine FPT University of Greenwich - Update Magazine Files</title>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
        <link href="../assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
        <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
        <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
        <script type="text/javascript">
            bkLib.onDomLoaded(nicEditors.allTextAreas);
        </script>
    </head>

    <body class="sidebar-noneoverflow" data-spy="scroll" data-target="#navSection" data-offset="100">

        <!--  BEGIN NAVBAR  -->
        <?php include_once('includes/coordinator-header.php'); ?>
        <!--  END NAVBAR  -->

        <!--  BEGIN MAIN CONTAINER  -->
        <div class="main-container" id="container">

            <div class="overlay"></div>
            <div class="search-overlay"></div>

            <!--  BEGIN TOPBAR  -->
            <?php include_once('includes/coordinator-menubar.php'); ?>
            <!--  END TOPBAR  -->

            <!--  BEGIN CONTENT AREA  -->
            <div id="content" class="main-content">
                <div class="container">
                    <div class="container">

                        <div class="row layout-top-spacing">

                            <div id="basic" class="col-lg-12 layout-spacing">
                                <div class="statbox widget box box-shadow">
                                    <div class="widget-header">
                                        <div class="row">
                                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                <h4>Upload Magazine Detail</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-content widget-content-area">
                                        <form class="simple-example" action="" method="post" enctype="multipart/form-data">

                                            <?php
                                            $eid = $_GET['editid'];
                                            $sql = "SELECT tblmagazine.Title,tblmagazine.ID,tblmagazine.UploadMagazine from tblmagazine where tblmagazine.ID=:eid";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $row) {               ?> <div class="form-row">
                                                        <div class="col-md-12 mb-4">
                                                            <label><b>Title:</b></label>
                                                            <input type="text" class="form-control" id="title" name="title" value="<?php echo $row->Title; ?>" readonly="true">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-12 mb-4">
                                                            <label><b>Uploaded Magazine File:</b></label>
                                                            <a href="files/<?php echo $row->UploadMagazine; ?>" width="100" height="100" target="_blank">
                                                                <strong style="color: red">(View Uploaded Magazine)</strong></a>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-12 mb-4">
                                                            <label><b>Upload New Magazine File:</b></label>
                                                            <input type="file" class="form-control" id="title" name="uploadmag" required="true">
                                                        </div>
                                                    </div>
                                            <?php $cnt = $cnt + 1;
                                                }
                                            } ?>
                                            <button class="btn btn-primary submit-fn mt-2" type="submit" name="submit">Update</button>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include_once('includes/footer.php'); ?>
            </div>
            <!--  END CONTENT AREA  -->

        </div>
        <!-- END MAIN CONTAINER -->

        <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
        <script src="../assets/js/libs/jquery-3.1.1.min.js"></script>
        <script src="../bootstrap/js/popper.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="../assets/js/app.js"></script>

        <script>
            $(document).ready(function() {
                App.init();
            });
        </script>
        <script src="../plugins/highlight/highlight.pack.js"></script>
        <script src="../assets/js/custom.js"></script>
        <!-- END GLOBAL MANDATORY SCRIPTS -->

        <!--  BEGIN CUSTOM SCRIPTS FILE  -->
        <script src="../assets/js/scrollspyNav.js"></script>
        <script src="../assets/js/forms/bootstrap_validation/bs_validation_script.js"></script>
        <!--  END CUSTOM SCRIPTS FILE  -->

    </body>

    </html><?php }  ?>