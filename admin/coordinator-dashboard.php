<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['oesaid'] <= 2)) {
    header('location:login.php');
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Annual University Magazine FPT University of Greenwich - Dashboard </title>

        <link href="../assets/css/loader.css" rel="stylesheet" type="text/css" />
        <script src="../assets/js/loader.js"></script>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL ../plugins/CUSTOM STYLES -->
        <link href="../plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
        <link href="../assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL ../plugins/CUSTOM STYLES -->

    </head>

    <body class="alt-menu sidebar-noneoverflow">
        <!-- BEGIN LOADER -->
        <div id="load_screen">
            <div class="loader">
                <div class="loader-content">
                    <div class="spinner-grow align-self-center"></div>
                </div>
            </div>
        </div>
        <!--  END LOADER -->

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

            <!--  BEGIN CONTENT PART  -->
            <div id="content" class="main-content">
                <div class="layout-px-spacing">

                    <div class="page-header">
                        <div class="page-title">
                            <h3>Dashboard</h3>
                        </div>

                    </div>

                    <div class="row layout-top-spacing">

                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget-four">
                                <?php
                                $uid = $_SESSION['oesaid'];
                                $sql = "SELECT * from  tbladmin where ID=:aid";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':aid', $uid, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $row) {               ?>
                                        <div class="widget-heading">
                                            <h5 class="" style="color: blue;text-align: center;">Welcome to Annual University Magazine FPT University of Greenwich, <?php echo $row->AdminName; ?>!</h5>
                                        </div>
                                <?php $cnt = $cnt + 1;
                                    }
                                } ?>
                            </div>
                        </div>

                    </div>

                    <?php include_once('includes/footer.php'); ?>

                </div>
            </div>
            <!--  END CONTENT PART  -->

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
        <script src="../assets/js/custom.js"></script>
        <!-- END GLOBAL MANDATORY SCRIPTS -->

        <!-- BEGIN PAGE LEVEL ../plugins/CUSTOM SCRIPTS -->
        <script src="../plugins/apex/apexcharts.min.js"></script>
        <script src="../assets/js/dashboard/dash_2.js"></script>
        <!-- BEGIN PAGE LEVEL ../plugins/CUSTOM SCRIPTS -->
    </body>

    </html><?php }  ?>