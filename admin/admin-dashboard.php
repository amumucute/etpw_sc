<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['oesaid'] != 1)) {
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
        <?php include_once('includes/header.php'); ?>
        <!--  END NAVBAR  -->

        <!--  BEGIN MAIN CONTAINER  -->
        <div class="main-container" id="container">

            <div class="overlay"></div>
            <div class="search-overlay"></div>

            <!--  BEGIN TOPBAR  -->
            <?php include_once('includes/admin-menubar.php'); ?>
            <!--  END TOPBAR  -->

            <!--  BEGIN CONTENT PART  -->
            <div id="content" class="main-content">
                <div class="layout-px-spacing">
                    <div class="row layout-top-spacing">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                            <div class="row widget-statistic">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="widget widget-one_hybrid widget-followers">
                                        <div class="widget-heading">
                                            <div class="w-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="9" cy="7" r="4"></circle>
                                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                                </svg>
                                            </div>
                                            <?php
                                            $sql = "SELECT ID from tbladmin";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $totuser = $query->rowCount();
                                            ?>
                                            <p class="w-value"><?php echo htmlentities($totuser); ?></p>
                                            <a href="reg-user.php">
                                                <h5 class="">Total Reg Staff Accounts</h5>
                                                <?php
                                                $sqlad = "SELECT ID from tbladmin where Role='Administrator'";
                                                $queryad = $dbh->prepare($sqlad);
                                                $queryad->execute();
                                                $resultsad = $queryad->fetchAll(PDO::FETCH_OBJ);
                                                $totuserad = $queryad->rowCount();
                                                ?>
                                                <h5 class=""><br> • Administration Accounts: <?php echo htmlentities($totuserad); ?></h5>
                                                <?php
                                                $sqlmana = "SELECT ID from tbladmin where Role='Manager'";
                                                $querymana = $dbh->prepare($sqlmana);
                                                $querymana->execute();
                                                $resultsmana = $querymana->fetchAll(PDO::FETCH_OBJ);
                                                $totusermana = $querymana->rowCount();
                                                ?>
                                                <h5 class=""><br> • Marketing Manager Accounts: <?php echo htmlentities($totusermana); ?></h5>
                                                <?php
                                                $sqlcoor = "SELECT ID from tbladmin where Role='Coordinator'";
                                                $querycoor = $dbh->prepare($sqlcoor);
                                                $querycoor->execute();
                                                $resultscoor = $querycoor->fetchAll(PDO::FETCH_OBJ);
                                                $totusercoor = $querycoor->rowCount();
                                                ?>
                                                <h5 class=""><br> • Marketing Coordinator Accounts: <?php echo htmlentities($totusercoor); ?></h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="widget widget-one_hybrid widget-followers">
                                        <div class="widget-heading">
                                            <div class="w-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check">
                                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="8.5" cy="7" r="4"></circle>
                                                    <polyline points="17 11 19 13 23 9"></polyline>
                                                </svg>
                                            </div>
                                            <?php
                                            $sql2 = "SELECT ID from tbluser where Role='Student'";
                                            $query2 = $dbh->prepare($sql2);
                                            $query2->execute();
                                            $results = $query2->fetchAll(PDO::FETCH_OBJ);
                                            $totpublmag = $query2->rowCount();
                                            ?>
                                            <p class="w-value"><?php echo htmlentities($totpublmag); ?></p>
                                            <a href="reg-user.php">
                                                <h5 class="">Total Student Accounts</h5>
                                                <?php
                                                $sql2IT = "SELECT ID from tbluser where Role='Student' and Faculty='Information Technology'";
                                                $query2IT = $dbh->prepare($sql2IT);
                                                $query2IT->execute();
                                                $resultsIT = $query2IT->fetchAll(PDO::FETCH_OBJ);
                                                $totpublmagIT = $query2IT->rowCount();
                                                ?>
                                                <h5 class=""><br> • Student Accounts of the IT Faculty: <?php echo htmlentities($totpublmagIT); ?></h5>
                                                <?php
                                                $sql2BS = "SELECT ID from tbluser where Role='Student' and Faculty='Business'";
                                                $query2BS = $dbh->prepare($sql2BS);
                                                $query2BS->execute();
                                                $resultsBS = $query2BS->fetchAll(PDO::FETCH_OBJ);
                                                $totpublmagBS = $query2BS->rowCount();
                                                ?>
                                                <h5 class=""><br> • Student Accounts of the Business Faculty: <?php echo htmlentities($totpublmagBS); ?></h5>
                                                <?php
                                                $sql2GD = "SELECT ID from tbluser where Role='Student' and Faculty='Graphic Design'";
                                                $query2GD = $dbh->prepare($sql2GD);
                                                $query2GD->execute();
                                                $resultsGD = $query2GD->fetchAll(PDO::FETCH_OBJ);
                                                $totpublmagGD = $query2GD->rowCount();
                                                ?>
                                                <h5 class=""><br> • Student Accounts of the Graphic Design Faculty: <?php echo htmlentities($totpublmagGD); ?></h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="widget widget-one_hybrid widget-followers">
                                        <div class="widget-heading">
                                            <div class="w-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                            </div>
                                            <?php
                                            $sql3 = "SELECT ID from tbluser where Role='Guest'";
                                            $query3 = $dbh->prepare($sql3);
                                            $query3->execute();
                                            $results = $query3->fetchAll(PDO::FETCH_OBJ);
                                            $totnotpublmag = $query3->rowCount();
                                            ?>
                                            <p class="w-value"><?php echo htmlentities($totnotpublmag); ?></p>
                                            <a href="reg-user.php">
                                                <h5 class="">Total Guest Accounts</h5>
                                                <?php
                                                $sql3GIT = "SELECT ID from tbluser where Role='Guest' and Faculty='Information Technology'";
                                                $query3GIT = $dbh->prepare($sql3GIT);
                                                $query3GIT->execute();
                                                $resultsGIT = $query3GIT->fetchAll(PDO::FETCH_OBJ);
                                                $totnotpublmagGIT = $query3GIT->rowCount();
                                                ?>
                                                <h5 class=""><br> • Guest Accounts of the IT Faculty: <?php echo htmlentities($totnotpublmagGIT); ?></h5>
                                                <?php
                                                $sql3GBS = "SELECT ID from tbluser where Role='Guest' and Faculty='Business'";
                                                $query3GBS = $dbh->prepare($sql3GBS);
                                                $query3GBS->execute();
                                                $resultsGBS = $query3GBS->fetchAll(PDO::FETCH_OBJ);
                                                $totnotpublmagGBS = $query3GBS->rowCount();
                                                ?>
                                                <h5 class=""><br> • Guest Accounts of the Business Faculty: <?php echo htmlentities($totnotpublmagGBS); ?></h5>
                                                </h5>
                                                <?php
                                                $sql3GGD = "SELECT ID from tbluser where Role='Guest' and Faculty='Graphic Design'";
                                                $query3GGD = $dbh->prepare($sql3GGD);
                                                $query3GGD->execute();
                                                $resultsGGD = $query3GGD->fetchAll(PDO::FETCH_OBJ);
                                                $totnotpublmagGGD = $query3GGD->rowCount();
                                                ?>
                                                <h5 class=""><br> • Guest Accounts of the Graphic Design Faculty: <?php echo htmlentities($totnotpublmagGGD); ?></h5>
                                                </h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                            <div class="row widget-statistic">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="widget widget-one_hybrid widget-referral">
                                        <div class="widget-heading">
                                            <div class="w-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open">
                                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                                </svg>
                                            </div>
                                            <?php
                                            $sql1 = "SELECT ID from tblmagazine where Status is null";
                                            $query1 = $dbh->prepare($sql1);
                                            $query1->execute();
                                            $results = $query1->fetchAll(PDO::FETCH_OBJ);
                                            $totnewmag = $query1->rowCount();
                                            ?>
                                            <p class="w-value"><?php echo htmlentities($totnewmag); ?></p>
                                            <a href="new-magazine.php">
                                                <h5 class="">Total Pending Magazines </h5>
                                                <?php
                                                $sql1PIT = "SELECT ID from tblmagazine where Status is null and CategoryID=1";
                                                $query1PIT = $dbh->prepare($sql1PIT);
                                                $query1PIT->execute();
                                                $resultsPIT = $query1PIT->fetchAll(PDO::FETCH_OBJ);
                                                $totnewmagPIT = $query1PIT->rowCount();
                                                ?>
                                                <h5 class=""><br> • Pending Magazines of the IT Faculty: <?php echo htmlentities($totnewmagPIT); ?></h5>
                                                <?php
                                                $sql1PBS = "SELECT ID from tblmagazine where Status is null and CategoryID=2";
                                                $query1PBS = $dbh->prepare($sql1PBS);
                                                $query1PBS->execute();
                                                $resultsPBS = $query1PBS->fetchAll(PDO::FETCH_OBJ);
                                                $totnewmagPBS = $query1PBS->rowCount();
                                                ?>
                                                <h5 class=""><br> • Pending Magazines of the Business Faculty: <?php echo htmlentities($totnewmagPBS); ?></h5>
                                                <?php
                                                $sql1PGD = "SELECT ID from tblmagazine where Status is null and CategoryID=3";
                                                $query1PGD = $dbh->prepare($sql1PGD);
                                                $query1PGD->execute();
                                                $resultsPGD = $query1PGD->fetchAll(PDO::FETCH_OBJ);
                                                $totnewmagPGD = $query1PGD->rowCount();
                                                ?>
                                                <h5 class=""><br> • Pending Magazines of the Graphic Design Faculty: <?php echo htmlentities($totnewmagPGD); ?></h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="widget widget-one_hybrid widget-referral">
                                        <div class="widget-heading">
                                            <div class="w-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open">
                                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                                </svg>
                                            </div>
                                            <?php
                                            $sql2 = "SELECT ID from tblmagazine where Status='Published'";
                                            $query2 = $dbh->prepare($sql2);
                                            $query2->execute();
                                            $results = $query2->fetchAll(PDO::FETCH_OBJ);
                                            $totpublmag = $query2->rowCount();
                                            ?>
                                            <p class="w-value"><?php echo htmlentities($totpublmag); ?></p>
                                            <a href="published.php">
                                                <h5 class="">Total Published Magazines</h5>
                                                <?php
                                                $sql2PUIT = "SELECT ID from tblmagazine where Status='Published' and CategoryID=1";
                                                $query2PUIT = $dbh->prepare($sql2PUIT);
                                                $query2PUIT->execute();
                                                $resultsPUIT = $query2PUIT->fetchAll(PDO::FETCH_OBJ);
                                                $totpublmagPUIT = $query2PUIT->rowCount();
                                                ?>
                                                <h5 class=""><br> • Published Magazines of IT Faculty: <?php echo htmlentities($totpublmagPUIT); ?></h5>
                                                <?php
                                                $sql2PUBS = "SELECT ID from tblmagazine where Status='Published' and CategoryID=2";
                                                $query2PUBS = $dbh->prepare($sql2PUBS);
                                                $query2PUBS->execute();
                                                $resultsPUBS = $query2PUBS->fetchAll(PDO::FETCH_OBJ);
                                                $totpublmagPUBS = $query2PUBS->rowCount();
                                                ?>
                                                <h5 class=""><br> • Published Magazines of Business Faculty: <?php echo htmlentities($totpublmagPUBS); ?></h5>
                                                <?php
                                                $sql2PUGD = "SELECT ID from tblmagazine where Status='Published' and CategoryID=3";
                                                $query2PUGD = $dbh->prepare($sql2PUGD);
                                                $query2PUGD->execute();
                                                $resultsPUGD = $query2PUGD->fetchAll(PDO::FETCH_OBJ);
                                                $totpublmagPUGD = $query2PUGD->rowCount();
                                                ?>
                                                <h5 class=""><br> • Published Magazines of Graphic Design Faculty: <?php echo htmlentities($totpublmagPUGD); ?></h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="widget widget-one_hybrid widget-referral">
                                        <div class="widget-heading">
                                            <div class="w-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open">
                                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                                </svg>
                                            </div>
                                            <?php
                                            $sql3 = "SELECT ID from tblmagazine where Status='Not Published'";
                                            $query3 = $dbh->prepare($sql3);
                                            $query3->execute();
                                            $results = $query3->fetchAll(PDO::FETCH_OBJ);
                                            $totnotpublmag = $query3->rowCount();
                                            ?>
                                            <p class="w-value"><?php echo htmlentities($totnotpublmag); ?></p>
                                            <a href="notpublished.php">
                                                <h5 class="">Total Unpublished Magazines</h5>
                                                <?php
                                                $sql3UIT = "SELECT ID from tblmagazine where Status='Not Published' and CategoryID=1";
                                                $query3UIT = $dbh->prepare($sql3UIT);
                                                $query3UIT->execute();
                                                $resultsUIT = $query3UIT->fetchAll(PDO::FETCH_OBJ);
                                                $totnotpublmagUIT = $query3UIT->rowCount();
                                                ?>
                                                <h5 class=""><br> • Unpublished Magazines of IT Faculty: <?php echo htmlentities($totnotpublmagUIT); ?></h5>
                                                <?php
                                                $sql3UBS = "SELECT ID from tblmagazine where Status='Not Published' and CategoryID=2";
                                                $query3UBS = $dbh->prepare($sql3UBS);
                                                $query3UBS->execute();
                                                $resultsUBS = $query3UBS->fetchAll(PDO::FETCH_OBJ);
                                                $totnotpublmagUBS = $query3UBS->rowCount();
                                                ?>
                                                <h5 class=""><br> • Unpublished Magazines of Business Faculty: <?php echo htmlentities($totnotpublmagUBS); ?></h5>
                                                <?php
                                                $sql3UBS = "SELECT ID from tblmagazine where Status='Not Published'and CategoryID=3";
                                                $query3UBS = $dbh->prepare($sql3UBS);
                                                $query3UBS->execute();
                                                $resultsUBS = $query3UBS->fetchAll(PDO::FETCH_OBJ);
                                                $totnotpublmagUBS = $query3UBS->rowCount();
                                                ?>
                                                <h5 class=""><br> • Unpublished Magazines of Graphic Design Faculty: <?php echo htmlentities($totnotpublmagUBS); ?></h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                            <div class="row widget-statistic">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="widget widget-one_hybrid widget-engagement">
                                        <div class="widget-heading">
                                            <div class="w-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor">
                                                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                                                    <line x1="8" y1="21" x2="16" y2="21"></line>
                                                    <line x1="12" y1="17" x2="12" y2="21"></line>
                                                </svg>
                                            </div>
                                            <?php
                                            $sql1 = "SELECT ID from tblmagazine where CategoryID=1";
                                            $query1 = $dbh->prepare($sql1);
                                            $query1->execute();
                                            $results = $query1->fetchAll(PDO::FETCH_OBJ);
                                            $totpublmag = $query1->rowCount();
                                            ?>
                                            <p class="w-value"><?php echo htmlentities($totpublmag); ?></p>
                                            <h5 class="">Total Magazines of IT Faculty </h5>
                                            <?php
                                            $sqla1 = "SELECT ID from tblmagazine where CategoryID=1 and AcademicYear=2019";
                                            $querya1 = $dbh->prepare($sqla1);
                                            $querya1->execute();
                                            $resultsa1 = $querya1->fetchAll(PDO::FETCH_OBJ);
                                            $totpublmaga1 = $querya1->rowCount();
                                            $totpublmag = $query1->rowCount();
                                            ?>
                                            <h5 class=""><br> • For 2019:</h5>
                                            <h5 class=""><br>   . Percentage of contributions: <?php
                                                                                                if ($totpublmag >= 1) {
                                                                                                    echo htmlentities(round($totpublmaga1 * 100 / $totpublmag, 2));
                                                                                                } else {
                                                                                                    echo htmlentities($totpublmaga1);
                                                                                                } ?>%</h5>
                                            <h5 class=""><br>   . Number of contributions: <?php echo htmlentities($totpublmaga1); ?></h5>
                                            <?php
                                            $sqla2 = "SELECT ID from tblmagazine where CategoryID=1 and AcademicYear=2020";
                                            $querya2 = $dbh->prepare($sqla2);
                                            $querya2->execute();
                                            $resultsa2 = $querya2->fetchAll(PDO::FETCH_OBJ);
                                            $totpublmaga2 = $querya2->rowCount();
                                            $totpublmag = $query1->rowCount();
                                            ?>
                                            <h5 class=""><br> • For 2020:</h5>
                                            <h5 class=""><br>   . Percentage of contributions: <?php
                                                                                                if ($totpublmag >= 1) {
                                                                                                    echo htmlentities(round($totpublmaga2 * 100 / $totpublmag, 2));
                                                                                                } else {
                                                                                                    echo htmlentities($totpublmaga2);
                                                                                                } ?>%</h5>
                                            <h5 class=""><br>   . Number of contributions: <?php echo htmlentities($totpublmaga2); ?></h5>
                                            <?php
                                            $sqla3 = "SELECT ID from tblmagazine where CategoryID=1 and AcademicYear=2021";
                                            $querya3 = $dbh->prepare($sqla3);
                                            $querya3->execute();
                                            $resultsa3 = $querya3->fetchAll(PDO::FETCH_OBJ);
                                            $totpublmaga3 = $querya3->rowCount();
                                            $totpublmag = $query1->rowCount();
                                            ?>
                                            <h5 class=""><br> • For 2021:</h5>
                                            <h5 class=""><br>   . Percentage of contributions: <?php
                                                                                                if ($totpublmag >= 1) {
                                                                                                    echo htmlentities(round($totpublmaga3 * 100 / $totpublmag, 2));
                                                                                                } else {
                                                                                                    echo htmlentities($totpublmaga3);
                                                                                                } ?>%</h5>
                                            <h5 class=""><br>   . Number of contributions: <?php echo htmlentities($totpublmaga3); ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="widget widget-one_hybrid widget-engagement">
                                        <div class="widget-heading">
                                            <div class="w-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                                </svg>
                                            </div>
                                            <?php
                                            $sql2 = "SELECT ID from tblmagazine where CategoryID=2";
                                            $query2 = $dbh->prepare($sql2);
                                            $query2->execute();
                                            $results = $query2->fetchAll(PDO::FETCH_OBJ);
                                            $totpublmag = $query2->rowCount();
                                            ?>
                                            <p class="w-value"><?php echo htmlentities($totpublmag); ?></p>
                                            <h5 class="">Total Magazines of Business Faculty </h5>
                                            <?php
                                            $sql21 = "SELECT ID from tblmagazine where CategoryID=2 and AcademicYear=2019";
                                            $query21 = $dbh->prepare($sql21);
                                            $query21->execute();
                                            $results1 = $query21->fetchAll(PDO::FETCH_OBJ);
                                            $totpublmag1 = $query21->rowCount();
                                            $totpublmag = $query2->rowCount();
                                            ?>
                                            <h5 class=""><br> • For 2019:</h5>
                                            <h5 class=""><br>   . Percentage of contributions: <?php
                                                                                                if ($totpublmag >= 1) {
                                                                                                    echo htmlentities(round($totpublmag1 * 100 / $totpublmag, 2));
                                                                                                } else {
                                                                                                    echo htmlentities($totpublmag1);
                                                                                                } ?>%</h5>
                                            <h5 class=""><br>   . Number of contributions: <?php echo htmlentities($totpublmag1); ?></h5>

                                            <?php
                                            $sql22 = "SELECT ID from tblmagazine where CategoryID=2 and AcademicYear=2020";
                                            $query22 = $dbh->prepare($sql22);
                                            $query22->execute();
                                            $results2 = $query22->fetchAll(PDO::FETCH_OBJ);
                                            $totpublmag2 = $query22->rowCount();
                                            $totpublmag = $query2->rowCount();
                                            ?>
                                            <h5 class=""><br> • For 2020:</h5>
                                            <h5 class=""><br>   . Percentage of contributions: <?php
                                                                                                if ($totpublmag >= 1) {
                                                                                                    echo htmlentities(round($totpublmag2 * 100 / $totpublmag, 2));
                                                                                                } else {
                                                                                                    echo htmlentities($totpublmag2);
                                                                                                } ?>%</h5>
                                            <h5 class=""><br>   . Number of contributions: <?php echo htmlentities($totpublmag2); ?></h5>

                                            <?php
                                            $sql23 = "SELECT ID from tblmagazine where CategoryID=2 and AcademicYear=2021";
                                            $query23 = $dbh->prepare($sql23);
                                            $query23->execute();
                                            $results3 = $query23->fetchAll(PDO::FETCH_OBJ);
                                            $totpublmag3 = $query23->rowCount();
                                            $totpublmag = $query2->rowCount();
                                            ?>
                                            <h5 class=""><br> • For 2021:</h5>
                                            <h5 class=""><br>   . Percentage of contributions: <?php
                                                                                                if ($totpublmag >= 1) {
                                                                                                    echo htmlentities(round($totpublmag3 * 100 / $totpublmag, 2));
                                                                                                } else {
                                                                                                    echo htmlentities($totpublmag3);
                                                                                                } ?>%</h5>
                                            <h5 class=""><br>   . Number of contributions: <?php echo htmlentities($totpublmag3); ?></h5>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="widget widget-one_hybrid widget-engagement">
                                        <div class="widget-heading">
                                            <div class="w-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                </svg>
                                            </div>
                                            <?php
                                            $sql3 = "SELECT ID from tblmagazine where CategoryID=3";
                                            $query3 = $dbh->prepare($sql3);
                                            $query3->execute();
                                            $results = $query3->fetchAll(PDO::FETCH_OBJ);
                                            $totpublmag = $query3->rowCount();
                                            ?>
                                            <p class="w-value"><?php echo htmlentities($totpublmag); ?></p>
                                            <h5 class="">Total Magazines of Graphic Design Faculty</h5>
                                            <?php
                                            $sqla4 = "SELECT ID from tblmagazine where CategoryID=3 and AcademicYear=2019";
                                            $querya4 = $dbh->prepare($sqla4);
                                            $querya4->execute();
                                            $resultsa4 = $querya4->fetchAll(PDO::FETCH_OBJ);
                                            $totpublmaga4 = $querya4->rowCount();
                                            $totpublmag = $query3->rowCount();
                                            ?>
                                            <h5 class=""><br> • For 2019:</h5>
                                            <h5 class=""><br>   . Percentage of contributions for 2019: <?php
                                                                                                        if ($totpublmag >= 1) {
                                                                                                            echo htmlentities(round($totpublmaga4 * 100 / $totpublmag, 2));
                                                                                                        } else {
                                                                                                            echo htmlentities($totpublmaga4);
                                                                                                        } ?>%</h5>
                                            <h5 class=""><br>   . Number of contributions: <?php echo htmlentities($totpublmaga4); ?></h5>

                                            <?php
                                            $sqla5 = "SELECT ID from tblmagazine where CategoryID=3 and AcademicYear=2020";
                                            $querya5 = $dbh->prepare($sqla5);
                                            $querya5->execute();
                                            $resultsa5 = $querya5->fetchAll(PDO::FETCH_OBJ);
                                            $totpublmaga5 = $querya5->rowCount();
                                            $totpublmag = $query3->rowCount();
                                            ?>
                                            <h5 class=""><br> • For 2020:</h5>
                                            <h5 class=""><br>   . Percentage of contributions for 2020: <?php
                                                                                                        if ($totpublmag >= 1) {
                                                                                                            echo htmlentities(round($totpublmaga5 * 100 / $totpublmag, 2));
                                                                                                        } else {
                                                                                                            echo htmlentities(round($totpublmaga5, 2));
                                                                                                        } ?>%</h5>
                                            <h5 class=""><br>   . Number of contributions: <?php echo htmlentities($totpublmaga5); ?></h5>

                                            <?php
                                            $sqla6 = "SELECT ID from tblmagazine where CategoryID=3 and AcademicYear=2021";
                                            $querya6 = $dbh->prepare($sqla6);
                                            $querya6->execute();
                                            $resultsa6 = $querya6->fetchAll(PDO::FETCH_OBJ);
                                            $totpublmaga6 = $querya6->rowCount();
                                            $totpublmag = $query3->rowCount();
                                            ?>
                                            <h5 class=""><br> • For 2021:</h5>
                                            <h5 class=""><br>   . Percentage of contributions for 2021: <?php
                                                                                                        if ($totpublmag >= 1) {
                                                                                                            echo htmlentities(round($totpublmaga6 * 100 / $totpublmag, 2));
                                                                                                        } else {
                                                                                                            echo htmlentities(round($totpublmaga6, 2));
                                                                                                        } ?>%</h5>
                                            <h5 class=""><br>   . Number of contributions: <?php echo htmlentities($totpublmaga6); ?></h5>

                                        </div>
                                    </div>
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