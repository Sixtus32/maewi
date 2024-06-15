<?php
session_start();
include_once "./src/config/config.php";
include_once "./src/config/config_chat.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once PARCIALS_FOLDER . "/_meta.php"; ?>
    <title>Maewi | Planes de forma sencilla</title>
</head>
<?php
if (!isset($_SESSION['unique_id'])) {
?>

    <body>

        <!-- HEADER -->
        <?php include_once TEMPLATES_FOLDER . "/header.php"; ?>
        <!-- MAIN -->
        <?php include_once TEMPLATES_FOLDER . "/main.php"; ?>
        <!-- FOOTER -->
        <?php include_once TEMPLATES_FOLDER . "/footer.php"; ?>
        <!-- MODALS -->
        <?= require_once PARCIALS_FOLDER . '/modals/_sign_up.php'; ?>
        <?= require_once PARCIALS_FOLDER . '/modals/_login.php'; ?>
        <!-- COOKIES -->
        <?php include_once PARCIALS_FOLDER . "/_cookie.php"; ?>
        <!-- SCRIPT -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.js" integrity="sha512-ZHzbWDQKpcZxIT9l5KhcnwQTidZFzwK/c7gpUUsFvGjEsxPusdUCyFxjjpc7e/Wj7vLhfMujNx7COwOmzbn+2w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="<?= PUBLIC_URL ?>assets/js/cookie.js" defer></script>
        <script src="<?= PUBLIC_URL ?>assets/js/pass-show-hide.js" defer></script>
        <script src="<?= PUBLIC_URL ?>assets/js/login.multi.step.js"></script>
        <script src="<?= PUBLIC_URL ?>assets/js/footer_date.js" defer></script>
        <script src="<?= PUBLIC_URL ?>assets/js/signup.js" defer></script>
        <script src="<?= PUBLIC_URL ?>assets/js/signin.js" defer></script>
    </body>
<?php
} else {
    // Para usuarios registrados
?>
    <style>
        main {
            position: absolute;
            width: 100%;
            height: 100%;
            background: url("<?= PUBLIC_URL ?>assets/img/other/scattered-forcefields.png");
            background-repeat: repeat;
            background-position: center;
        }
    </style>

    <body>
        <?php require_once TEMPLATES_FOLDER . 'nav.php'; ?>
        <main>
            <?php include_once TEMPLATES_FOLDER . "/view_events.php"; ?>
            <?php include_once PARCIALS_FOLDER . "/ads.php"; ?>
            <!-- PUBLISH EVENT -->
            <?= require_once PARCIALS_FOLDER . '/modals/_pub_event.php' ?>
            <?= require_once PARCIALS_FOLDER . '/modals/_chat_user.php' ?>
        </main>
        <footer>
            <!-- FOOTER CONTENT -->
            <!-- <div class="footer_container">
                <p class="footer_text">maewi © 2024 - 2025</p>
            </div> -->
        </footer>
        <!-- SCRIPT -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.js" integrity="sha512-ZHzbWDQKpcZxIT9l5KhcnwQTidZFzwK/c7gpUUsFvGjEsxPusdUCyFxjjpc7e/Wj7vLhfMujNx7COwOmzbn+2w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="<?= PUBLIC_URL ?>assets/js/user-data.js" defer></script>
        <script src="<?= PUBLIC_URL ?>assets/js/event.js" defer></script>
        <script src="<?= PUBLIC_URL ?>assets/js/chat.js" defer></script>

    </body>
<?php } ?>

</html>