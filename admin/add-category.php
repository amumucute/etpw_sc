<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['oesaid'] != 1)) {
    header('location:login.php');
} else {
    if (isset($_POST['submit'])) {
        $catname = $_POST['catname'];
        $closuredate = $_POST['closuredate'];
        $finalclosuredate = $_POST['finalclosuredate'];
        $sql = "insert into tblcategory(CategoryName,ClosureDate,FinalClosureDate)values(:catname,:closuredate,:finalclosuredate)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':catname', $catname, PDO::PARAM_STR);
        $query->bindParam(':closuredate', $closuredate, PDO::PARAM_STR);
        $query->bindParam(':finalclosuredate', $finalclosuredate, PDO::PARAM_STR);
        $query->execute();

        $LastInsertId = $dbh->lastInsertId();
        if ($LastInsertId > 0 && $closuredate < $finalclosuredate) {
            echo '<script>alert("Faculty has been added!")</script>';
            echo "<script>window.location.href ='manage-category.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again!")</script>';
        }
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Annual University Magazine FPT University of Greenwich - Add Category</title>

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
                                                <h4 style="color:red">ADD NEW FACULTY</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-content widget-content-area">
                                        <form class="simple-example" action="" method="post">

                                            <div class="form-row">
                                                <div class="col-md-12 mb-4">
                                                    <label for="fullName"><b>Faculy:</b></label>
                                                    <input type="text" class="form-control" id="catname" placeholder="New Faculty Name" name="catname" value="" required="true">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-4">
                                                    <label for="fullName"><b>Closure Date:</b></label>
                                                    <input type="date" min="2021-01-01" max="2021-12-30" class="form-control" id="closuredate" placeholder="Set Closure Date" name="closuredate" value="" required="true">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-4">
                                                    <label for="fullName"><b>Final Closure Date:</b></label>
                                                    <input type="date" min="2021-01-01" max="2021-12-31" class="form-control" id="finalclosuredate" placeholder="Set Final Closure Date" name="finalclosuredate" value="" required="true">
                                                </div>
                                            </div>
                                            <button class="btn btn-primary submit-fn mt-2" type="submit" name="submit">Add</button>
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