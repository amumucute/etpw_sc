<?php
$today = date("Y-m-d H:i:s", strtotime(' + 6 hours'));
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ocmuid'] == 0)) {
    header('location:logout.php');
} else {
    // Code for deleting product from cart
    if (isset($_GET['delid'])) {
        $rid = intval($_GET['delid']);
        $uid = $_SESSION['ocmuid'];
        $sql = "delete from tblmagazine where ID=:rid && UserID=:uid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_STR);
        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('Magazine deleted!');</script>";
        echo "<script>window.location.href = 'manage-magazine.php'</script>";
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Annual University Magazine FPT University of Greenwich - Manage Magazine</title>

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
            <?php include_once('includes/menubar.php'); ?>
            <!--  END TOPBAR  -->

            <!--  BEGIN CONTENT AREA  -->
            <div id="content" class="main-content">
                <div class="layout-px-spacing">

                    <div class="row layout-top-spacing" id="cancel-row">
                        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                            <div class="widget-content widget-content-area br-6">
                                <div class="table-responsive mb-4 mt-4">
                                    <table id="alter_pagination" class="table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Title</th>
                                                <th>Faculty</th>
                                                <th>Author</th>
                                                <th>Academic Year</th>
                                                <th>Language</th>
                                                <th>Status</th>
                                                <th>Posting Date</th>
                                                <th>Final Closure Date</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $uid = $_SESSION['ocmuid'];
                                            $sql = "SELECT tblmagazine.Title,tblmagazine.ID as mid,tblmagazine.Publisher,tblmagazine.AcademicYear,tblmagazine.Language,tblmagazine.Status,tblmagazine.PostDate,tblmagazine.CategoryID,tblcategory.CategoryName, tblcategory.FinalClosureDate from tblmagazine join tblcategory on tblcategory.ID=tblmagazine.CategoryID where tblmagazine.UserID=:uid";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);

                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $row) {               ?>
                                                    <tr>
                                                        <td><?php echo htmlentities($cnt); ?></td>
                                                        <td><?php echo htmlentities($row->Title); ?></td>
                                                        <td><?php echo htmlentities($row->CategoryName); ?></td>
                                                        <td><?php echo htmlentities($row->Publisher); ?></td>
                                                        <td><?php echo htmlentities($row->AcademicYear); ?></td>
                                                        <td><?php echo htmlentities($row->Language); ?></td>
                                                        <td><?php $status = $row->Status;
                                                            if ($status == '') {
                                                                echo "Pending";
                                                            } else {
                                                                echo $status;
                                                            }

                                                            ?> </td>
                                                        <td><?php echo htmlentities($row->PostDate); ?></td>
                                                        <td><?php echo htmlentities($row->FinalClosureDate); ?></td>
                                                        <td class="text-center">
                                                            <?php if ($row->Status == 'Published') : ?>
                                                                <a href="view-magazine.php?viewid=<?php echo ($row->mid); ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="View" ;>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1b55e2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                                        <circle cx="12" cy="12" r="3"></circle>
                                                                    </svg>
                                                                </a>
                                                                <a class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Published magazine cannot be deleted!"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="gray" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-octagon table-cancel">
                                                                        <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                                                                        <line x1="15" y1="9" x2="9" y2="15"></line>
                                                                        <line x1="9" y1="9" x2="15" y2="15"></line>
                                                                    </svg></a><a class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Published magazine cannot be edited!"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="gray" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success">
                                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                                    </svg>
                                                                </a>
                                                            <?php endif ?>
                                                            <?php if ($row->Status == '' || $row->Status == 'Not Published') : ?>
                                                                <a href="view-magazine.php?viewid=<?php echo ($row->mid); ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="View" ;>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1b55e2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                                        <circle cx="12" cy="12" r="3"></circle>
                                                                    </svg>
                                                                </a>
                                                                <a href="manage-magazine.php?delid=<?php echo ($row->mid); ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="return confirm('Do you really want to delete?');"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-octagon table-cancel">
                                                                        <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                                                                        <line x1="15" y1="9" x2="9" y2="15"></line>
                                                                        <line x1="9" y1="9" x2="15" y2="15"></line>
                                                                        <?php if ($row->Status == 'Not Published') : ?>
                                                                    </svg></a><a class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Not Published magazine cannot be edited!"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success">
                                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                                    </svg>
                                                                <?php endif ?>
                                                                <?php if ($row->Status == '' && $today <= $row->FinalClosureDate) : ?>
                                                                    </svg></a><a href="edit-magazine.php?editid=<?php echo ($row->mid); ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success">
                                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                                    </svg>
                                                                </a>
                                                            <?php endif ?>
                                                            <?php if ($row->Status == '' && $today > $row->FinalClosureDate) : ?>
                                                                </svg></a><a class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="The Final Closure Date has expired! This magazine cannot be edited."><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="gray" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success">
                                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                                    </svg>
                                                                </a>
                                                            <?php endif ?>
                                                        </td>
                                                    <?php endif ?>
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
                    "pageLength": 7
                });
            });
        </script>
        <!-- END PAGE LEVEL CUSTOM SCRIPTS -->
    </body>

    </html><?php }  ?>