<?php
require_once '../app/Config/config.php';
require_once '../app/Services/generateDateFormatService.php';
require_once '../app/Controller/registerMemberController.php';
session_start();
?>

<?php

use app\Controller\registerMemberController;
use services\generateDateFormatService;

$date = new generateDateFormatService;
$memberController = new registerMemberController;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $store_data = $memberController->storeMember();
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
    <div class="container m-custom-1">
        <div class="row">
            <div class="col-12 col-md-5">
                <?php
                if (isset($_SESSION['notification']) && $_SESSION['notification'] !== "") {
                    $element = '';
                    $element .= '<div class="alert alert-danger" role="alert">';
                    $element .= $_SESSION['notification'];
                    $element .= "</div>";
                    echo $element;
                    unset($_SESSION['notification']);
                }
                ?>


                <div class="card">
                    <div class="card-header">
                        Form Add Data
                    </div>
                    <div class="card-body">
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control transform-custom-1" id="first_name">
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control transform-custom-1" id="last_name">
                            </div>
                            <div class="mb-3">
                                <label for="student_id" class="form-label">Student Id</label>
                                <input type="text" name="student_id" class="form-control" id="student_id">
                            </div>
                            <div class="mb-3">
                                <label for="class" class="form-label">Your Class</label>
                                <select class="form-select" id="class" onchange="selectClass(this.value)" name="class" aria-label="Default select example">
                                    <option value=""> -- Select Class --</option>
                                    <?php
                                    $file_to_read = fopen("../database/General/all_class.csv", "r");
                                    if ($file_to_read !== FALSE) {
                                        while (($data = fgetcsv($file_to_read)) !== FALSE) {
                                            foreach ($data as $i) {
                                                echo '<option value="' . $data[0] . '">' . $data[1] . '</option>';
                                                break;
                                            }
                                        }
                                        fclose($file_to_read);
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="friend" class="form-label">Your Friend In Selected Class</label>
                                <select class="form-select" id="friend" name="friend" aria-label="Default select example">

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="platform" class="form-label">You Preffered Platform</label>
                                <select class="form-select" name="platform" id="platform" aria-label="Default select example">
                                    <option value=""> -- Select Platform --</option>
                                    <option value="1">Website</option>
                                    <option value="2">Desktop</option>
                                    <option value="3">Mobile</option>
                                </select>
                            </div>
                            <button class="btn bg-custom-1 text-custom-1 col-12">Submit Data</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-7">
                <div class="card">
                    <div class="card-header">
                        All Data
                    </div>
                    <div class="card-body">
                        <?php
                        $file_to_read = fopen("../database/General/all_class.csv", "r");
                        if ($file_to_read !== FALSE) {
                            while (($data = fgetcsv($file_to_read)) !== FALSE) {
                                foreach ($data as $i) {
                                    $element = '';
                                    $element .=  '<div class="m-custom-2">';
                                    $element .= '<h5 class="text-custom-2">' . $data[0] . " - " . $data[1] . '</h5>';
                                    $element .= '<table class="table table-striped">';
                                    $element .= '<thead class="bg-custom-1 text-custom-1">';
                                    $element .= '<tr>';
                                    $element .= '<th scope="col" class="size-custom-1">#</th>';
                                    $element .= '<th scope="col" class="size-custom-1">Student Id</th>';
                                    $element .= '<th scope="col" class="size-custom-1">First Name</th>';
                                    $element .= '<th scope="col" class="size-custom-1">Last Name</th>';
                                    $element .= '<th scope="col" class="size-custom-1">Class Name</th>';
                                    $element .= '<th scope="col" class="size-custom-1">Group</th>';
                                    $element .= '<th scope="col" class="size-custom-1">Preffere Platform</th>';
                                    $element .= '<th scope="col" class="size-custom-1">Created At</th>';
                                    $element .= '</tr>';
                                    $element .= '</thead>';
                                    $element .= '<tbody>';

                                    $filename = "../database/Class/" . $data[2] . "";
                                    if (!file_exists($filename)) {
                                        $element .= '<tr>';
                                        $element .= '<td colspan="8" class="text-center">Data Not Found</td>';
                                        $element .= '</tr>';
                                    } else {
                                        $member_file_read = fopen($filename, "r");
                                        if ($member_file_read !== FALSE) {
                                            while (($member = fgetcsv($member_file_read)) !== FALSE) {
                                                $element .= '<tr>';
                                                for ($j = 0; $j < count($member); $j++) {
                                                    if ($j == 7) {
                                                        $element .= '<td>' . $date->format($member[$j]) . '</td>';
                                                    } else {
                                                        $element .= '<td>' . $member[$j] . '</td>';
                                                    }
                                                }
                                                $element .= '</tr>';
                                            }
                                            fclose($member_file_read);
                                        }
                                    }
                                    $element .= '</tbody>';
                                    $element .= '</table>';
                                    $element .= '</div>';
                                    echo $element;
                                    break;
                                }
                            }
                            fclose($file_to_read);
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End contact Section  -->
    <?php require_once 'components/_script.php' ?>
    <?php require_once 'components/_customJs.php' ?>
</body>

</html>