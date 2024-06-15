<?php
session_start();
include_once "../config/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once PARCIALS_FOLDER . "/_meta.php"; ?>
    <title>Maewi | Planning</title>
    <script src="<?= PUBLIC_URL ?>assets/js/calendar.js" defer></script>
</head>

<body>
    <?php require_once TEMPLATES_FOLDER . 'nav.php'; ?>
    <main>
        <?php include_once TEMPLATES_FOLDER . "/calendar.php" ?>
    </main>
    <footer></footer>
    <!-- PUBLISH EVENT -->
    <?= require_once PARCIALS_FOLDER . '/modals/_pub_event.php' ?>
    <?= require_once PARCIALS_FOLDER . '/modals/_chat_user.php' ?>
    <!-- SCRIPT -->
    <script src="<?= PUBLIC_URL ?>assets/js/event.js" defer></script>
    <script src="<?= PUBLIC_URL ?>assets/js/chat.js" defer></script>
</body>

</html>