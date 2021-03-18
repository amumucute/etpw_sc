<?php
$today = date("Y-m-d H:i:s", strtotime(' + 6 hours'));
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ocmuid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {

        $uid = $_SESSION['ocmuid'];
        $title = $_POST['title'];
        $category = $_POST['category'];
        $publisher = $_POST['publisher'];
        $language = $_POST['language'];
        $academicyear = $_POST['academicyear'];
        $magdesc = $_POST['magdesc'];
        $coverimage = $_FILES["coverimage"]["name"];
        $extension = substr($coverimage, strlen($coverimage) - 4, strlen($coverimage));
        $uploadmag = $_FILES["uploadmag"]["name"];

        $extension1 = substr($uploadmag, strlen($uploadmag) - 4, strlen($uploadmag));
        $extension1 = end(explode(".", $uploadmag));
        $allowed_extensions = array(".JPG", ".jpg", ".JPEG", ".jpeg", ".PNG", ".png", ".GIF", ".gif");
        $allowed_extensions1 = array("docs", "docx", "doc");
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Cover image has Invalid format. Only .JPG/.jpeg/.png/.gif format allowed!');</script>";
        }
        if (!in_array($extension1, $allowed_extensions1)) {
            echo "<script>alert('File has Invalid format. Only .docs/.docx/.doc format allowed!');</script>";
        } else {
            $coverimage = md5($coverimage) . time() . $extension;
            $uploadmag = md5($uploadmag) . time() . '.' . $extension1;
            move_uploaded_file($_FILES["coverimage"]["tmp_name"], "images/" . $coverimage);
            move_uploaded_file($_FILES["uploadmag"]["tmp_name"], "files/" . $uploadmag);
            $sql = "insert into tblmagazine(Title,UserID,CategoryID,Publisher,Language,AcademicYear,MagazineDescription,CoverImage,UploadMagazine)values(:title,:uid,:category,:publisher,:language,:academicyear,:magdesc,:coverimage,:uploadmag)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':title', $title, PDO::PARAM_STR);
            $query->bindParam(':uid', $uid, PDO::PARAM_STR);
            $query->bindParam(':category', $category, PDO::PARAM_STR);
            $query->bindParam(':publisher', $publisher, PDO::PARAM_STR);
            $query->bindParam(':language', $language, PDO::PARAM_STR);
            $query->bindParam(':academicyear', $academicyear, PDO::PARAM_STR);
            $query->bindParam(':magdesc', $magdesc, PDO::PARAM_STR);
            $query->bindParam(':coverimage', $coverimage, PDO::PARAM_STR);
            $query->bindParam(':uploadmag', $uploadmag, PDO::PARAM_STR);
            $query->execute();

            $LastInsertId = $dbh->lastInsertId();
            if ($LastInsertId > 0) {
                echo '<script>alert("Magazine details has been added!")</script>';
                echo "<script>window.location.href ='manage-magazine.php'</script>";
            } else {
                echo '<script>alert("Something Went Wrong. Please try again!")</script>';
            }
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Annual University Magazine of FPT Greenwich University - Add Post Details</title>

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
                                                <h4 style="color:red">ADD MAGAZINE DETAILS</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-content widget-content-area">
                                        <form class="simple-example" action="" method="post" enctype="multipart/form-data">

                                            <div class="form-row">
                                                <div class="col-md-12 mb-4">
                                                    <label><b>Title:</b></label>
                                                    <input type="text" class="form-control" id="title" placeholder="Enter Magazine Title" name="title" value="" required="true">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-4">
                                                    <label><b>Faculty:</b></label>
                                                    <select type="text" class="form-control" id="category" name="category" value="" required="true">
                                                        <option value="">Select Faculty</option>
                                                        <?php
                                                        $sql = "SELECT * from tblcategory";
                                                        $query = $dbh->prepare($sql);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                                                        $cnt = 1;
                                                        if ($query->rowCount() > 0) {
                                                            foreach ($results as $row) {               ?>
                                                                <option value="<?php echo htmlentities($row->ID); ?>"><?php echo htmlentities($row->CategoryName); ?></option><?php $cnt = $cnt + 1;
                                                                                                                                                                            }
                                                                                                                                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-4">
                                                    <label for="title"><b>Author:</b></label>
                                                    <input type="text" class="form-control" id="publisher" placeholder="Enter Publisher Name" name="publisher" value="" required="true">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-4">
                                                    <label><b>Language:</b></label>
                                                    <input type="text" class="form-control" id="language" placeholder="Enter Language (English, Vietnamese, etc)" name="language" value="" required="true">
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
                                                    <input type="text" class="form-control" id="magdesc" placeholder="Enter Magazine Details" name="magdesc" value="" required="true">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-4">
                                                    <label><b>Cover Image:</b></label>
                                                    <input type="file" class="form-control" id="coverimage" placeholder="Enter Magazine Details" name="coverimage" value="" required="true">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-4">
                                                    <label><b>Upload Magazine:</b></label>
                                                    <input type="file" class="form-control" id="uploadmag" name="uploadmag" value="" required="true">
                                                </div>
                                            </div>
                                            <div>
                                                <p id="text" style="display:none"><b>TERMS AND CONDITIONS:</b><br><br>
                                                    1. By uploading an image or video you guarantee that you have read these Terms and Conditions for uploading images, photos and contents to the Annual University Magazine FPT University of Greenwich (AUMFGW) and that you agree to abide by all clauses within these Terms and Conditions.
                                                    You also understand and agree that nothing in this agreement obligates we to display or use your images and contents.<br><br>
                                                    2. By uploading an Image/Content to the AUMFGW you guarantee that you are the legal owner of the copyright of that Image/Content, or have been awarded full and unrestricted rights from the copyright owner to upload and utilise the Image/content for the purposes of the FPT Guides or any other distribution channels including, but not limited to the FPT websites system, selected 3rd party websites and FPT apps (Guides.)
                                                    Images/Contents that are considered to infringe the copyright or trademarks of other individuals, organisations or companies will be deleted.<br><br>
                                                    3. By uploading an Image/Content you guarantee that such use of the Image/Content in the AUMFGW does not violate the rights of any other party, does not result in a breach of contract between you and another party and that you accept responsibility for any royalties or fees due to any other party from the use of the uploaded Image/Content.<br><br>
                                                    4. By uploading an Image/Content you guarantee that any people which are clearly identifiable have consented to have their likeness printed or displayed, or that you have full rights to use the Image/Content in this manner and accept full responsibility for such use.<br><br>
                                                    5. When uploading an Image/Content you are solely responsible for its content and for any offence, claims or damages that arise from the content of that Image.
                                                    The approval and publication of Images/Contents in the Guides by website system's staffs in no way alters or diminishes your responsibility.
                                                    Nor does it transfer any responsibility for the content of the Image to AUMFGW or the staff who approves the Image/Content for publication.
                                                </p>
                                                <hr>
                                                <input for="myCheck" type="checkbox" id="myCheck" name="checkterm" required onclick="myFunction()">
                                                <strong style="color:black"> AGREE TO TERMS AND CONDITIONS</strong>
                                                <script>
                                                    function myFunction() {
                                                        var checkBox = document.getElementById("myCheck");
                                                        var text = document.getElementById("text");
                                                        if (checkBox.checked == true) {
                                                            text.style.display = "block";
                                                        } else {
                                                            text.style.display = "none";
                                                        }
                                                    }
                                                </script>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-4">
                                                    <p left="center" style="padding-top: 20px">
                                                        <button class="btn btn-primary submit-fn mt-2" type="submit" name="submit">Submit</button>
                                                    </p>
                                                </div>
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

    </html>
<?php }  ?>