<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<header>

    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6 header-top-left no-padding">
                    <ul>
                        <li><a href="https://www.facebook.com/GreenwichVietnam"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://greenwich.edu.vn/"><i class="fa fa-dribbble"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6 header-top-right no-padding">
                    <ul>
                        <?php

                        $sql = "SELECT * from  tblpage where PageType='contactus'";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $row) {               ?>
                                <li><a href="tel:+440 012 3654 896"><span class="lnr lnr-phone-handset"></span><span>+ <?php echo $row->MobileNumber; ?></span></a></li>
                                <li><a href="mailto:support@colorlib.com"><span class="lnr lnr-envelope"></span><span><?php echo $row->Email; ?></span></a></li><?php $cnt = $cnt + 1;
                                                                                                                                                            }
                                                                                                                                                        } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="logo-wrap">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-4 col-md-4 col-sm-12 logo-left no-padding">
                    <a href="index.php">
                        <h4 style="color: #44008e">Annual University Magazine FPT University of Greenwich</h4>
                    </a>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 logo-right no-padding ads-banner">
                    <a href="https://greenwich.edu.vn/">
                        <img class="img-fluid" src="img/banner-ad.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container main-menu" id="main-menu">
        <div class="row align-items-center justify-content-between">
            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class="menu-active"><a href="index.php">Home</a></li>
                    <li class="menu-has-children"><a href="">Faculty</a>
                        <ul>
                            <?php
                            $ret = "SELECT * from tblcategory";
                            $query1 = $dbh->prepare($ret);
                            $query1->execute();
                            $resultss = $query1->fetchAll(PDO::FETCH_OBJ);
                            foreach ($resultss as $rows) {               ?>
                                <li><a href="category-details.php?catid=<?php echo htmlentities($rows->ID) ?>"><?php echo htmlentities($rows->CategoryName) ?></a></li>

                            <?php } ?>

                        </ul>
                    </li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="admin/login.php">Staff</a></li>
                    <li><a href="user/login.php">User</a></li>

                </ul>
            </nav><!-- #nav-menu-container -->
        </div>
    </div>
</header>