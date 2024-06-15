<?php
session_start();
include_once "../config/config.php";
include_once "../config/config_chat.php";
if (!isset($_SESSION['unique_id'])) {
    header("location: ../../index.php");
    exit();
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include_once PARCIALS_FOLDER . "/_meta.php"; ?>
        <title>Maewi | Chat</title>
        <style>
            .wrapper {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                position: absolute;
                width: 100%;
                height: 100vh;
                left: 0;
                background: url("<?= PUBLIC_URL ?>assets/img/other/scattered-forcefields.png");
            }

            .chat_area {
                width: 100%;
                /* height: 88%; */
                position: absolute;
                margin: 0;
                padding: 0;
                box-shadow: rgb(0 0 0 / 5%), rgb(0 0 0 / 5%);
            }

            .chat_area header {
                width: 100%;
                height: 55px;
                display: flex;
                padding-left: 1rem;
                column-gap: 1.5rem;
                align-items: center;
                background: #fff;
                border-radius: 5px;
                position: relative;
            }


            .chat_area header img {
                height: 45px;
                width: 45px;
                border-radius: 50%;
                object-fit: fill;
            }

            .chat_area img {
                object-fit: cover;
                width: 50px;
                height: 50px;
                border-radius: 50%;
            }


            .chat_area .chat_box {
                width: 100%;
                max-height: 880px;
                height: 750px;
                padding: 0.5rem;
                background: url("<?= PUBLIC_URL ?>assets/img/other/confetti-doodles.png");
                box-shadow: inset 0 32px 32px -32px rgb(0 0 0 / 5%),
                    inset 0 -32px 32px -32px rgb(0 0 0 / 5%);
                overflow-y: auto;
                border-radius: 5px;
            }

            .chat_box .text {
                position: absolute;
                top: 45%;
                left: 50%;
                width: calc(100% - 50px);
                text-align: center;
                transform: translate(-50%, -50%);
            }

            .chat_box .chat {
                margin: 15px 0;
            }

            .chat_box .chat p {
                word-wrap: break-word;
                padding: 8px 16px;
                box-shadow: 0 0 32px rgb(0 0 0 / 8%),
                    0rem 16px 16px -16px rgb(0 0 0 / 10%);
            }

            .chat_box .outgoing {
                display: flex;
            }

            .chat_box .outgoing .details {
                margin-left: auto;
                max-width: calc(100% - 130px);
            }

            .outgoing .details p {
                background: #333;
                color: #fff;
                border-radius: 18px 18px 0 18px;
            }

            .chat_box .incoming {
                display: flex;
                align-items: flex-end;
            }

            .chat_box .incoming img {
                height: 35px;
                width: 35px;
            }

            .chat_box .incoming .details {
                margin-right: auto;
                margin-left: 10px;
                max-width: calc(100% - 130px);
            }

            .incoming .details p {
                background: #fff;
                color: #333;
                border-radius: 18px 18px 18px 0;
            }

            .typing-area {
                background: #fff;
                padding: 1.35rem;
                border-radius: 5px;
            }


            /* Scrollbar styling for the chat box */
            .chat_box::-webkit-scrollbar {
                width: 5px;
            }

            .chat_box::-webkit-scrollbar-thumb {
                background: #007bff;
                border-radius: 5px;
            }

            .chat_box::-webkit-scrollbar-thumb:hover {
                background: #0056b3;
            }

            .typing-area .input-field {
                flex: 1;
                border: none;
                padding: 10px 15px;
                border-radius: 20px;
                background: #f1f1f1;
                outline: none;
            }

            .typing-area button {
                border: none;
                background: #007bff;
                color: #fff;
                padding: 10px 15px;
                border-radius: 50%;
                margin-left: 10px;
                cursor: pointer;
                transition: background 0.3s;
            }

            .typing-area button:hover {
                background: #0056b3;
            }

            .typing-area button.active {
                background: #0056b3;
            }

            @media screen and (min-width: 760px) {
                .chat_area {
                    width: 75%;
                }
            }

            @media screen and (min-width: 1161px) {
                .chat_area {
                    width: 70%;
                    left: 18.5%;
                }
            }

            @media screen and (min-width: 1168px) {
                .chat_area {
                    width: 70%;
                    left: 25.5%;
                }
            }

            @media screen and (min-width: 1720px) {
                .chat_area {
                    width: 75%;
                    left: 20.5%;
                }

            }
        </style>
    </head>

    <body>
        <?php include_once "./template/nav.php"; ?>
        <div class="wrapper">
            <section class="chat_area">
                <header>
                    <?php
                    $user_id = mysqli_real_escape_string($conn, $_GET['userId']);
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                    if (mysqli_num_rows($sql) > 0) {
                        $row = mysqli_fetch_assoc($sql);
                    } else {
                        header("location: users.php");
                        exit();
                    }
                    ?>
                    <a href="<?= URL ?>" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                    <img src="<?php echo PUBLIC_URL . "assets/img/profile/" . $row['user_profile_photo']; ?>" alt="">
                    <div class="details">
                        <span><?php echo $row['user_name'] . " " . $row['user_surname']; ?></span>
                        <p><?php echo $row['status']; ?></p>
                    </div>
                </header>
                <div class="chat_box" id="chat-box"></div>
                <form action="#" class="typing-area">
                    <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                    <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                    <button><i class="fab fa-telegram-plane"></i></button>
                </form>
            </section>
            <!-- PUBLISH EVENT -->
            <?= require_once PARCIALS_FOLDER . '/modals/_pub_event.php' ?>
            <?= require_once PARCIALS_FOLDER . '/modals/_chat_user.php' ?>
        </div>
        <script src="<?= PUBLIC_URL ?>assets/js/chat.js" defer></script>
        <script src="<?= PUBLIC_URL ?>assets/js/chat_users.js" defer></script>
    </body>

    </html>

<?php
}
?>