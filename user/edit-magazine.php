<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ocmuid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {

        $uid = $_SESSION['ocmuid'];
        $eid = $_GET['editid'];
        $title = $_POST['title'];
        $category = $_POST['category'];
        $publisher = $_POST['publisher'];
        $language = $_POST['language'];
        $academicyear = $_POST['academicyear'];
        $magdesc = $_POST['magdesc'];

        $sql = "update tblmagazine set Title=:title,CategoryID=:category,Publisher=:publisher,Language=:language,AcademicYear=:academicyear,MagazineDescription=:magdesc where ID=:eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':publisher', $publisher, PDO::PARAM_STR);
        $query->bindParam(':language', $language, PDO::PARAM_STR);
        $query->bindParam(':academicyear', $academicyear, PDO::PARAM_STR);
        $query->bindParam(':magdesc', $magdesc, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();
        echo '<script>alert("Magazine detail has been updated!")</script>';
        echo "<script>window.location.href ='manage-magazine.php'</script>";
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Annual University Magazine FPT University of Greenwich - Add Post Details</title>

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
                <div class="">
                    <div class="container">

                        <div class="row layout-top-spacing">

                            <div id="basic" class="col-lg-12 layout-spacing">
                                <div class="statbox widget box box-shadow">
                                    <div class="widget-header">
                                        <div class="row">
                                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                <h4 style="color:red">EDIT MAGAZINE DETAILS</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-content widget-content-area">
                                        <form class="simple-example" action="" method="post" enctype="multipart/form-data">

                                            <?php
                                            $eid = $_GET['editid'];
                                            $sql = "SELECT tblmagazine.Title,tblmagazine.Publisher,tblmagazine.Language,tblmagazine.AcademicYear,tblmagazine.ID as mid,tblmagazine.MagazineDescription,tblmagazine.CoverImage,tblmagazine.UploadMagazine,tblmagazine.PostDate,tblmagazine.CategoryID,tblcategory.CategoryName from tblmagazine join tblcategory on tblcategory.ID=tblmagazine.CategoryID where tblmagazine.ID=:eid";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $row) {               ?> <div class="form-row">
                                                        <div class="col-md-12 mb-4">
                                                            <label><b>Title:</b></label>
                                                            <input type="text" class="form-control" id="title" name="title" value="<?php echo $row->Title; ?>" required="true">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-12 mb-4">
                                                            <label><b>Faculty:</b></label>
                                                            <select type="text" class="form-control" id="category" name="category">
                                                                <option value="<?php echo $row->CategoryID; ?>"><?php echo $row->CategoryName; ?></option>
                                                                <?php
                                                                $sql1 = "SELECT * from tblcategory where CategoryName!='$row->CategoryName'";
                                                                $query1 = $dbh->prepare($sql1);
                                                                $query1->execute();
                                                                $results1 = $query1->fetchAll(PDO::FETCH_OBJ);

                                                                $cnt = 1;
                                                                if ($query1->rowCount() > 0) {
                                                                    foreach ($results1 as $row1) {               ?>
                                                                        <option value="<?php echo htmlentities($row1->ID); ?>"><?php echo htmlentities($row1->CategoryName); ?></option><?php $cnt = $cnt + 1;
                                                                                                                                                                                    }
                                                                                                                                                                                } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-12 mb-4">
                                                            <label for="title"><b>Author:</b></label>
                                                            <input type="text" class="form-control" id="publisher" name="publisher" value="<?php echo $row->Publisher; ?>" required="true">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-12 mb-4">
                                                            <label><b>Language:</b></label>
                                                            <input type="text" class="form-control" id="language" name="language" value="<?php echo $row->Language; ?>" required="true">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-12 mb-4">
                                                            <label><b>Academic Year:</b></label>
                                                            <input type="text" class="form-control" id="academicyear" name="academicyear" value="2021" readonly="true" required="true">
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-md-12 mb-4">
                                                            <label><b>Magazine Description:</b></label>
                                                            <textarea type="text" class="form-control" id="magdesc" placeholder="Enter Magazine Details" name="magdesc" value="" required="true"><?php echo $row->MagazineDescription; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-12 mb-4">
                                                            <label><b>Cover Image:</b></label>
                                                            <p>
                                                                <img src="images/<?php echo $row->CoverImage; ?>" width='724' height='468'><a href="changeimage.php?editid=<?php echo $row->mid; ?>"> &nbsp; <br><br><strong style="color: red">(Upload new Image)</strong></a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-12 mb-4">
                                                            <label><b>Upload Magazine:</b></label>
                                                            <a href="files/<?php echo $row->UploadMagazine; ?>" width="100" height="100" target="_blank"> <strong style="color: blue"><i>Download Uploaded Magazine</i></strong></a> </a>
                                                            <a href="changefile.php?editid=<?php echo $row->mid; ?>"> &nbsp;<strong style="color: red">(Upload new file)</strong></a>
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