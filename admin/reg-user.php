<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['oesaid'] != 1)) {
    header('location:login.php');
} else {
    // Code for delete account
    if (isset($_GET['delid'])) {
        $rid = intval($_GET['delid']);
        $sql = "delete from tbluser where ID=:rid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('Account deleted!');</script>";
        echo "<script>window.location.href = 'reg-user.php'</script>";
    }
    if (isset($_GET['viewAid'])) {
        $vaid = intval($_GET['viewAid']);
        $sql = "select from tbladmin where ID=:vaid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':vaid', $vaid, PDO::PARAM_STR);
        $query->execute();
    }
    if (isset($_GET['viewUid'])) {
        $vuid = intval($_GET['viewUid']);
        $sql = "select from tbluser where ID=:vuid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':vuid', $vuid, PDO::PARAM_STR);
        $query->execute();
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Annual University Magazine FPT University of Greenwich - Manage Account</title>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
        <link rel="stylesheet" type="text/css" href="../plugins/table/datatable/datatables.css">
        <link rel="stylesheet" type="text/css" href="../plugins/table/datatable/dt-global_style.css">
        <!-- END PAGE LEVEL CUSTOM STYLES -->
    </head>

    <body class="sidebar-noneoverflow">

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
                <div class="layout-px-spacing">
                    <div class="row layout-top-spacing" id="cancel-row">
                        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                            <div class="widget-content widget-content-area br-6">
                                <button onclick="document.location='signup.php'" class="btn btn-primary submit-fn mt-2" type="submit" name="submit">Create new account</button>
                                <div class="table-responsive mb-4 mt-4">
                                    <table id="alter_pagination" class="table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Mobile Number</th>
                                                <th>Email</th>
                                                <th>Registration Date</th>
                                                <th>Faculty</th>
                                                <th>Role</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * from tbladmin";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $row) {               ?>
                                                    <tr>
                                                        <td><?php echo htmlentities($cnt); ?></td>
                                                        <td><?php echo htmlentities($row->AdminName); ?></td>
                                                        <td><?php echo htmlentities($row->MobileNumber); ?></td>
                                                        <td><?php echo htmlentities($row->Email); ?></td>
                                                        <td><?php echo htmlentities($row->AdminRegdate); ?></td>
                                                        <td><?php echo htmlentities($row->Faculty); ?></td>
                                                        <td><?php echo htmlentities($row->Role); ?></td>
                                                        <td class="text-center">
                                                            <a class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="This account cannot be deleted!">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-octagon table-cancel">
                                                                    <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                                                                    <line x1="15" y1="9" x2="9" y2="15"></line>
                                                                    <line x1="9" y1="9" x2="15" y2="15"></line>
                                                                </svg>
                                                            </a>
                                                            <a href="viewAprofile.php?viewAid=<?php echo ($row->ID); ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="View" ;>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                                    <circle cx="12" cy="12" r="3"></circle>
                                                                </svg>
                                                            </a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                    $cnt = $cnt + 1;
                                                }
                                            }
                                            ?>

                                            <?php
                                            $sql = "SELECT * from tbluser";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);

                                            $cnt1 = $ctn + 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $row) {               ?>
                                                    <tr>
                                                        <td><?php echo htmlentities($cnt); ?></td>
                                                        <td><?php echo htmlentities($row->FullName); ?></td>
                                                        <td><?php echo htmlentities($row->MobileNumber); ?></td>
                                                        <td><?php echo htmlentities($row->Email); ?></td>
                                                        <td><?php echo htmlentities($row->RegDate); ?></td>
                                                        <td><?php echo htmlentities($row->Faculty); ?></td>
                                                        <td><?php echo htmlentities($row->Role); ?></td>
                                                        <td class="text-center">
                                                            <a href="reg-user.php?delid=<?php echo ($row->ID); ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="return confirm('Do you really want to delete this account?');">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-octagon table-cancel">
                                                                    <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                                                                    <line x1="15" y1="9" x2="9" y2="15"></line>
                                                                    <line x1="9" y1="9" x2="15" y2="15"></line>
                                                                </svg>
                                                            </a>
                                                            <a href="viewUprofile.php?viewUid=<?php echo ($row->ID); ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="View" ;>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                                    <circle cx="12" cy="12" r="3"></circle>
                                                                </svg>
                                                            </a>
                                                        </td>
                                                    </tr>
                                            <?php $cnt = $cnt + 1;
                                                }
                                            } ?>
                                        </tbody>

                                    </table>
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
        <script src="../assets/js/custom.js"></script>
        <!-- END GLOBAL MANDATORY SCRIPTS -->

        <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
        <script src="../plugins/table/datatable/datatables.js"></script>
        <script>
            $(document).ready(function() {
                $('#alter_pagination').DataTable({
                    "pagingType": "full_numbers",
                    "oLanguage": {
                        "oPaginate": {
                            "sFirst": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>',
                            "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                            "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
                            "sLast": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>'
                        },
                        "sInfo": "Showing page _PAGE_ of _PAGES_",
                        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                        "sSearchPlaceholder": "Search...",
                        "sLengthMenu": "Results :  _MENU_",
                    },
                    "stripeClasses": [],
                    "lengthMenu": [7, 10, 20, 50],
                    "pageLength": 10
                });
            });
        </script>
        <!-- END PAGE LEVEL CUSTOM SCRIPTS -->
    </body>

    </html><?php }  ?>