<?php 
require_once '../app/Config/config.php'; 
require_once '../App/Controller/uploadFileController.php';
require_once '../app/Services/generateDateFormatService.php';

use services\generateDateFormatService;

$date = new generateDateFormatService;

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $login = (new UploadFile())->store();
  die;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Header -->
    <?php require_once 'components/_header.php' ?>
</head>

<body>
    <?php require_once 'components/_navbar.php' ?>
    <div class="container">
        <div class="row it">
            <div class="col-sm-4" id="one">
                <br>
                <div class="row">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="needs-validation" name="save"
                        novalidate="" autocomplete="off" enctype="multipart/form-data">
                    <div class="col-sm-offset-12 form-group">
                        <h3 class="text-start pb-4">Set your class file</h3>
                    </div>
                </div>
                    <div id="uploader">
                        <div class="row uploadDoc">
                          <div class="col-sm-11">
                          <label for="class_name" class="form-label">Class Name</label>
                            <input type="text" class="form-control" name="class_name">
                            <?php
                              if (isset($_SESSION['message'])) {
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                              }
                            ?>
                        </div>
                          <div class="col-sm-11 mt-4">
                          <label for="file" class="form-label">File (.csv)</label>
                              <div class="fileUpload btn btn-orange">
                                  <img src="https://www.kindpng.com/picc/m/261-2619141_cage-clipart-victorian-cloud-upload-icon-svg-hd.png"
                                      class="icon">
                                  <span class="upl" id="file-upload-filename">No file selected</span>
                                  <input type="file" name="file" class="upload up" id="file-upload" accept=".csv"/>
                              </div>
                                  <?php
                                    if (isset($_SESSION['files'])) {
                                        echo $_SESSION['files'];
                                        unset($_SESSION['files']);
                                    }
                                ?>
                          </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="save" class="btn btn-primary m-2">Submit</button>
                    </div>
            </div>
        </form>

        <div class="col-12 col-sm-7" id="two">
        <br>
            <div class="row">
                <div class="col-sm-offset-12 form-group">
                    <h3 class="text-start pb-4">Class Files Data Lists</h3>
                </div>
            </div>    
            <?php
                        $file_to_read = fopen("../database/General/all_class.csv", "r");
                                    $element = '';
                                    $element .=  '<div class="m-custom-2">';
                                    $element .= '<table class="table table-striped">';
                                    $element .= '<thead class="bg-custom-1 text-custom-1">';
                                    $element .= '<tr>';
                                    $element .= '<th scope="col" class="size-custom-1">#</th>';
                                    $element .= '<th scope="col" class="size-custom-1">Class Name</th>';
                                    $element .= '<th scope="col" class="size-custom-1">File</th>';
                                    $element .= '<th scope="col" class="size-custom-1">Created At</th>';
                                    $element .= '</tr>';
                                    $element .= '</thead>';
                                    $element .= '<tbody>';

                                    $filename = "../database/General/all_class.csv";
                                    if (!file_exists($filename)) {
                                        $element .= '<tr>';
                                        $element .= '<td colspan="8" class="text-center">Data Not Found</td>';
                                        $element .= '</tr>';
                                    } else {
                                        $class_file_read = fopen($filename, "r");
                                        if ($class_file_read !== FALSE) {
                                            while (($class = fgetcsv($class_file_read)) !== FALSE) {
                                                $element .= '<tr>';
                                                for ($j = 0; $j < count($class); $j++) {
                                                    if ($j == 3) {
                                                        $element .= '<td>' . $date->format($class[$j]) . '</td>';
                                                    } 
                                                    elseif ($j == 2) {
                                                        $element .= '<td> <a href="../database/Uploaded/'.$class[$j].'" name="save" class="btn btn-sm btn-primary">download</a> </td>';
                                                        
                                                    }
                                                    else {
                                                        $element .= '<td>' . $class[$j] . '</td>';
                                                    }
                                                }
                                                $element .= '</tr>';
                                            }
                                            fclose($class_file_read);
                                        }
                                    }
                                    $element .= '</tbody>';
                                    $element .= '</table>';
                                    $element .= '</div>';
                                    echo $element;

                            fclose($file_to_read);
                        ?>

        </div>
    </div>
    <?php require_once 'components/_script.php' ?>
</body>

</html>