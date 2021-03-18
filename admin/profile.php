<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['oesaid'] != 1)) {
    header('location:login.php');
} else {
    if (isset($_POST['submit'])) {
        $adminid = $_SESSION['oesaid'];
        $AName = $_POST['adminname'];
        $mobno = $_POST['mobilenumber'];
        $email = $_POST['email'];
        $sql = "update tbladmin set AdminName=:adminname,MobileNumber=:mobilenumber,Email=:email where ID=:aid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':adminname', $AName, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mobilenumber', $mobno, PDO::PARAM_STR);
        $query->bindParam(':aid', $adminid, PDO::PARAM_STR);
        $query->execute();

        echo '<script>alert("Profile has been updated!")</script>';
        echo "<script>window.location.href ='profile.php'</script>";
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Annual University Magazine FPT University of Greenwich - Profile</title>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
        <link href="../assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
        <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    </head>

    <body class="sidebar-noneoverflow" data-spy="scroll" data-target="#navSection" data-offset="100">

        <!--  BEGIN NAVBAR  -->
        <?php include_once('includes/header.php'); ?>
        <!--  END NAVBAR  -->

        <!--  BEGIN MAIN CONTAINER  -->
        <div class="main-container" id="container">

            <div class="overlay"></div>
            <div class="search-overlay"></div>

            <!--  BEGIN TOPBAR  -->
            <?php include_once('includes/admin-menubar.php'); ?>
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
                                                <h4 style="color:red">PROFILE</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="widget-content widget-content-area">
                                        <form class="simple-example" action="" method="post">
                                            <?php
                                            $uid = $_SESSION['ocmuid'];
                                            $sql = "SELECT * from  tbladmin where ID=:aid";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':aid', $aid, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $row) {               ?>
                                                    <div class="form-row">
                                                        <div class="col-md-12 mb-4">
                                                            <label><b>Avatar:</b></label>
                                                            <p>
                                                                <img src="images/<?php echo $row->Avatar; ?>" width='230' height='305'>
                                                                <a href="change-avatar.php"> &nbsp;
                                                                    <div>
                                                                        <strong style="color: blue">            
                                                                            Upload Avatar</strong>
                                                                </a>
                                                        </div>
                                                        </p>
                                                    </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-4">
                                            <label for="fullName"><b>Full Name:</b></label>
                                            <input type="text" class="form-control" name="adminname" value="<?php echo $row->AdminName; ?>" required='true'>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-4">
                                            <label for="fullName"><b>Username:</b></label>
                                            <input type="text" class="form-control" name="username" value="<?php echo $row->UserName; ?>" readonly="true">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-4">
                                            <label for="fullName"><b>Role:</b></label>
                                            <input type="text" class="form-control" name="role" value="<?php echo $row->Role; ?>" readonly="true">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-4">
                                            <label for="fullName"><b>Faculty:</b></label>
                                            <input type="text" class="form-control" name="faculty" value="<?php echo $row->Faculty; ?>" readonly="true">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-4">
                                            <label for="fullName"><b>Email:</b></label>
                                            <input type="email" class="form-control" name="email" value="<?php echo $row->Email; ?>" required='true'>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-4">
                                            <label for="fullName"><b>Contact Number:</b></label>
                                            <input type="text" class="form-control" name="mobilenumber" value="<?php echo $row->MobileNumber; ?>" required='true' maxlength='10'>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-4">
                                            <label for="fullName"><b>Registration Date:</b></label>
                                            <input type="text" class="form-control" id="email2" name="" value="<?php echo $row->AdminRegdate; ?>" readonly="true">
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

    </html><?php } ?>