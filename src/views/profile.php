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
        <title>Maewi | Profile</title>
        <style>
            .wrapper {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                position: absolute;
                width: 100%;
                height: 100%;
                left: 0;
                background: url("<?= PUBLIC_URL ?>assets/img/other/scattered-forcefields.png");
            }

            /* PERFIL */

            .p-top {
                width: 90%;
                height: 210px;
                margin: auto;
                clear: both;
                background: #fff;
                border-radius: 8px;
                padding: 10px;
                box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.1);
                position: relative;
                max-width: 1200px;
                left: 10px;
            }

            .button_white {
                background-color: white;
                -moz-border-radius: 6px;
                -webkit-border-radius: 6px;
                border-radius: 6px;
                display: inline-block;
                cursor: pointer;
                color: #262626;
                font-size: 16px;
                padding: 6px 9px;
                text-decoration: none;
                border: 1px solid #DBDBDB;
                font-family: 'Segoe UI', monospace;
                font-weight: 600;
                line-height: 18px;
            }

            .button_white:active {
                position: relative;
                top: 1px;
            }

            @media screen and (min-width: 1165px) {
                .p-top {
                    left: 245px;
                }
            }

            @media screen and (min-width: 1520px) {
                .p-top {
                    left: 150px;
                }
            }

            .p-foto {
                width: 30%;
                height: 210px;
                float: left;
            }

            .p-foto img {
                margin-top: 20px;
                margin-left: 20px;
                border-radius: 12px;
            }

            .p-name {
                width: 70%;
                height: 60px;
                float: left;
            }

            .p-user {
                margin-right: 4%;
                height: 60px;
                float: left;
                font-size: 32px;
                line-height: 32px;
                font-weight: 200;
            }

            .p-editar {
                margin-right: 4%;
                height: 60px;
                float: left;
            }

            .p-config {
                margin-right: 4%;
                height: 60px;
                float: left;
            }

            .p-info {
                width: 70%;
                height: 40px;
                float: left;
            }

            .p-infor {
                width: 33.3%;
                height: 40px;
                float: left;
                font-size: 18px;
                font-weight: 400;
                line-height: 18px;
                color: #262626;
            }

            .p-nombre {
                width: 70%;
                height: 30px;
                float: left;
                font-size: 18px;
                font-weight: 600;
                line-height: 18px;
                color: #262626;
            }

            .p-location {
                width: 70%;
                height: 30px;
                float: left;
                font-size: 18px;
                font-weight: 400;
                line-height: 18px;
                color: #262626;
            }

            .p-description {
                width: 70%;
                height: 50px;
                float: left;
                font-size: 16px;
                font-weight: 400;
                line-height: 18px;
                color: #262626;
            }

            .p-mid {
                width: 90%;
                margin: auto;
                clear: both;
                padding-top: 10px;
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                background: #fff;
                box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.1);
                position: relative;
                max-width: 1200px;
                left: 10px;
                border-radius: 10px;
                height: auto;
                overflow-y: auto;
                overflow-x: hidden;
                padding-left: 1rem;
            }


            @media screen and (min-width: 1165px) {
                .p-mid {
                    left: 245px;
                }
            }

            @media screen and (min-width: 1520px) {
                .p-mid {
                    left: 150px;
                }
            }

            .event-card {
                position: relative;
                width: 300px;
                background: #fff;
                border-radius: 8px;
                box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }

            .event-card img {
                width: 100%;
                height: 150px;
                object-fit: cover;
            }

            .event-card .event-info {
                padding: 10px;
            }

            .event-card .event-title {
                font-size: 18px;
                font-weight: 600;
                margin-bottom: 5px;
            }

            .event-card .event-date {
                font-size: 14px;
                color: #777;
            }

            .delete-icon {
                position: absolute;
                top: 5px;
                right: 5px;
                cursor: pointer;
                display: none;
                color: red;
                font-size: 18px;
                background-color: white;
                border-radius: 50%;
                padding: 5px;
            }

            .event-card:hover .delete-icon {
                display: block;
            }
        </style>
    </head>

    <body>
        <?php

        if (isset($_GET['username'])) {

            $sqlA = $mysqli->query("SELECT * FROM users WHERE username = '" . $_GET['username'] . "'");
            $rowA = $sqlA->fetch_array();

            $sqlAA = $mysqli->query("SELECT * FROM accounts WHERE userId = '" . $rowA['userId'] . "'");
            $rowB = $sqlAA->fetch_array();

            $sqlB = $mysqli->query("SELECT * FROM events WHERE unique_id = '" . $rowA['unique_id'] . "' ORDER BY eventId DESC");
            $totalp = $sqlB->num_rows;

            // Obtener los eventos en los que el usuario está participando
            $userId = $rowA['unique_id'];
            $participationQuery = $mysqli->query("SELECT events.* FROM events
                                                  JOIN participations ON events.eventId = participations.eventId
                                                  WHERE participations.unique_id = '$userId'
                                                  ORDER BY events.eventId DESC");
        }
        ?>
        <?php require_once TEMPLATES_FOLDER . 'nav.php'; ?>
        <div class="wrapper">
            <div class="p-top">
                <div class="p-foto"><img src="<?= PUBLIC_URL ?>assets/img/profile/<?= $rowA['user_profile_photo'] ?>" width="180" height="180"></div>
                <div class="p-name">
                    <div class="p-user"><?php echo $rowA['username']; ?></div>
                    <?php if ($rowA['unique_id'] == $_SESSION['unique_id']) { ?>
                        <div class="p-editar"><a href="edit_profile.php"><button class="button_white">Editar perfil
                                    <i class="ri-edit-line"></i>
                                </button></a></div>
                    <?php } ?>
                </div>
                <div class="p-info">
                    <div class="p-infor"><b><?php echo $totalp; ?></b> Mis Eventos</div>
                </div>
                <div class="p-nombre"><?php echo $rowA['user_name'] . ' ' . $rowA['user_surname']; ?></div>

                <div class="p-location">Pereira, Colombia</div>
                <div class="p-description"><?php echo isset($rowB['account_info']) ? $rowB['account_info'] : 'No info'; ?></div>
            </div>

            <div class="p-mid">
                <h2>Mis Planes 🗺️ </h2>
                <?php while ($event = $participationQuery->fetch_assoc()) : ?>
                    <div class="event-card">
                        <img src="<?= PUBLIC_URL ?>assets/img/pub/<?= htmlspecialchars($event['event_image_url']); ?>" alt="Event Image">
                        <div class="event-info">
                            <div class="event-title"><?= htmlspecialchars($event['event_title']); ?></div>
                            <div class="event-date"><?= date('M d, Y', strtotime($event['date_started'])); ?></div>
                            <!-- Icono de eliminación -->
                            <span class="delete-icon" onclick="deleteEvent(<?= $event['eventId'] ?>)">❌</span>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <script>
            function deleteEvent(eventId) {
                if (confirm("¿Estás seguro de que deseas eliminar este evento?")) {
                    // Realizar una solicitud AJAX para eliminar el evento del backend
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST", PROCESS_URL + "delete_event.php", true);
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            // Si la solicitud es exitosa, eliminar el evento del DOM
                            document.querySelector(`.event-card[data-event-id="${eventId}"]`).remove();
                            location.reload();
                        }
                    };
                    xhr.send("eventId=" + eventId);
                }
            }
        </script>
    </body>

    </html>

<?php
}
?>