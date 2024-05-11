<?php
session_start();
include_once "./src/config/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Maewi | Planes de forma sencilla </title>
    <meta name="autor" content="Sixtus Nosike">
    <meta name="application-name" content="Maewi">
    <meta name="heywords" content="friendly meetup calendar">
    <!-- =============    CSS ESTILO PRINCIPAL   ============= -->
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>assets/css/style.css">
    <!-- Others CSS -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>assets/js/cdn/bootstrap.min.js">

    <!-- =============    CONGIF JS  ============= -->
    <script src="<?= PUBLIC_URL ?>assets/js/base.config.js"></script>
    <script src="<?= PUBLIC_URL ?>assets/js/cdn/lazysizes.min.js"></script>
    <script src="<?= PUBLIC_URL ?>assets/js/main.js" defer></script>
    <script src="<?= PUBLIC_URL ?>assets/js/login.multi.step.js" defer></script>
    <script src="<?= PUBLIC_URL ?>assets/js/footer_date.js" defer></script>
</head>
<?php
if (!isset($_SESSION['unique_id'])) {
?>

    <body>
        <!-- ======================== HEADER ======================== -->
        <?php include_once TEMPLATES_FOLDER . "/header.php" ?>
        <!-- ======================== MAIN ======================== -->
        <?php include_once TEMPLATES_FOLDER . "/main.php" ?>
        <!-- ======================== FOOTER ======================== -->
        <?php include_once TEMPLATES_FOLDER . "/footer.php" ?>
        <!-- ======================== MODALS ======================== -->
        <?= require_once PARCIALS_FOLDER . '/modals/_sign_up.php' ?>
        <?= require_once PARCIALS_FOLDER . '/modals/_login.php' ?>
        <!-- ======================== COOKIES ======================== -->
        <?php include_once PARCIALS_FOLDER . "/_cookie.php" ?>
        <!-- ======================== SCRIPT ======================== -->
        <script src="<?= PUBLIC_URL ?>assets/js/cookie.js" defer></script>
        <script src="<?= PUBLIC_URL ?>assets/js/pass-show-hide.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
<?php
} else {
    // para usuarios registrados.
?>

    <body>
        <h1>REGISTRADO</h1>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>

</html>
<?php } ?>