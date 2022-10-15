<?php require_once '../app/Config/config.php'; ?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="<?= $config['base_url']; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= $config['base_url']; ?>/assets/css/style.css" rel="stylesheet">
<link rel="shortcut icon" href="<?= $config['base_url']; ?>/assets/img/favicon.ico" type="image/x-icon">
<?php
$page_name = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
if ($page_name == "index.php") {
    $page = "Upload File";
} else {
    $page = "Add Member";
}
?>
<title>Grouping App ~ <?= $page; ?></title>