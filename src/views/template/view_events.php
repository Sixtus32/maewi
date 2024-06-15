<?php

if (!isset($_SESSION['unique_id'])) {
    header("location: ../../index.php");
    exit();
} else {
?>

    <?php
    $resultPub = $mysqli->query("SELECT events.*,
                            users.username,
                            users.user_name,
                            users.user_surname,
                            users.user_profile_photo,
                            users.status,
                            users.unique_id
                            FROM events JOIN users ON events.unique_id = users.unique_id");
    ?>

    <div class="events_container">
        <?php while ($row = $resultPub->fetch_assoc()) :
            $eventImageUrl = !empty($row['event_image_url']) ? htmlspecialchars($row['event_image_url']) : 'default_image.jpg';
            $dateStarted = new DateTime($row['date_started']);
            $dateEnded = new DateTime($row['date_ended']);
            $formattedStartTime = $dateStarted->format('h:i A');
            $formattedEndTime = $dateEnded->format('h:i A');
            // Comprobar si el usuario ya participando de un evento
            $eventId = $row['eventId'];
            $userId = $_SESSION['unique_id'];
            $participationResult = $mysqli->query("SELECT * FROM participations WHERE unique_id = $userId AND eventId = $eventId");
            $isParticipating = $participationResult && $participationResult->num_rows > 0;
            $buttonClass = $isParticipating ? 'participando' : 'no-participando';
        ?>
            <article class="card_item" id="<?= $eventId; ?>">
                <header>
                    <div class="user_info">
                        <a href="<?= URL ?>/src/views/profile.php?username=<?= htmlspecialchars($row['username']) ?>" class="user_info_profile">
                            <img class="user_image" src="<?= PUBLIC_URL ?>assets/img/profile/<?= htmlspecialchars($row['user_profile_photo']) ?>" alt="Profile Image">
                            <div class="user_data">
                                <p><?= htmlspecialchars($row['username']); ?></p>
                                <span>[ <?= htmlspecialchars($row['event_location']); ?> ]</span>
                            </div>
                        </a>
                    </div>
                </header>
                <div class="event_main" style="position: relative;">
                    <img src="<?= PUBLIC_URL ?>assets/img/pub/<?= $eventImageUrl ?>" alt="Event Image">
                    <div class="event_info">
                        <div class="event_title">
                            <p><?= htmlspecialchars($row['event_title']); ?></p>
                        </div>
                        <div class="event_time">
                            <span><?= $formattedStartTime ?> - <?= $formattedEndTime ?></span>
                        </div>
                    </div>
                    <div class="event_date">
                        <span class="month"><?= date('M', strtotime($row['date_started'])); ?></span>
                        <span class="day"><?= date('d', strtotime($row['date_started'])); ?></span>
                    </div>
                    <div class="event_date">
                        <span class="month"><?= date('M', strtotime($row['date_started'])); ?></span>
                        <span class="day"><?= date('d', strtotime($row['date_started'])); ?></span>
                    </div>
                    <div class="event_icon">
                        <?php if ($row['privacy'] == 1) : ?>
                            <!-- Si es privado -->
                            <i class="ri-lock-line" style="color: #FF5733;"></i>
                        <?php else : ?>
                            <!-- Si no es privado -->
                            <i class="ri-lock-unlock-line" style="color: #33FF99;"></i>
                        <?php endif; ?>
                        <i class="ri-heart-2-line" style="color: #FF5733;"></i>
                        <?php if ($row['payment'] == 1) : ?>
                            <!-- Si hay que pagar -->
                            <i class="ri-money-dollar-circle-line" style="color: #FFC300;"></i>
                        <?php else : ?>
                            <!-- Si no hay que pagar -->
                            <i class="ri-wallet-3-line" style="color: #3366FF;"></i>
                        <?php endif; ?>
                    </div>
                    <div class="event_description">
                        <p><?= htmlspecialchars($row['event_description']); ?></p>
                    </div>
                </div>
                <footer>
                    <form class="participate" method="POST" action="<?= $isParticipating ? FUNC . 'unparticipate.php' : FUNC . 'participate.php' ?>">
                        <input type="hidden" name="eventId" value="<?= $eventId; ?>">
                        <button type="submit" class="<?= $buttonClass; ?>"><?= $isParticipating ? 'Participando' : 'Participar' ?></button>
                    </form>
                </footer>
            </article>
        <?php endwhile; ?>
    </div>

    <style>
        .event_date {
            position: absolute;
            width: 65px;
            height: 50px;
            left: 12.5px;
            top: 15px;
            border-radius: 10px;
            display: grid;
            justify-content: center;
            align-items: center;
            text-align: center;
            background: linear-gradient(90deg, #3f4458, #3498db);
            color: #fff;
            font-weight: 600;
        }

        .events_container {
            position: absolute;
            /* height: 100%; */
            width: 100%;
            display: grid;
            justify-content: center;
            align-items: center;
            padding: 1rem;
            row-gap: 4.75rem;
            top: 5%;
            margin-bottom: 200px;
            background: url("<?= PUBLIC_URL ?>assets/img/other/scattered-forcefields.png");
            background-repeat: repeat;
            background-position: center;
        }

        .events_container article {
            max-width: 375px;
            width: 350px;
            height: 620px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .events_container article:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .events_container article header {
            width: 100%;
            height: 10%;
            display: flex;
            align-items: center;
            justify-content: start;
            padding: 0.5rem;
            border-bottom: 1px solid #e6e6e6;
        }

        .events_container article header .user_info {
            width: 100%;
            height: 100%;
        }

        .events_container article header .user_info_profile {
            display: flex;
            justify-content: start;
            align-items: center;
            column-gap: 1rem;
        }

        .events_container article header .user_info_profile img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
        }

        .events_container article .event_main {
            width: 100%;
            height: 80%;
            display: flex;
            align-items: center;
            justify-content: start;
            padding: 0.5rem;
            overflow: hidden;
            position: relative;
        }

        .events_container article .event_main img {
            width: 100%;
            height: 100%;
            border-radius: 10px;
            transition: transform 0.5s ease;
        }

        .events_container article .event_main .event_info {
            position: absolute;
            width: 95%;
            min-height: 50px;
            display: flex;
            justify-content: center;
            flex-direction: column;
            gap: 5px;
            padding: 0 20px;
            padding-left: 50px;
            color: #fff;
            background: linear-gradient(90deg, #3f4458, transparent);
            cursor: pointer;
            bottom: 10%;
            z-index: 1;
        }

        .events_container article .event_main .event_icon {
            position: absolute;
            width: 95%;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 36px;
            box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.4);
            column-gap: 2rem;
            bottom: 0%;
            margin-bottom: 0.9rem;
            z-index: 1;
        }

        .events_container article .event_main .event_icon i {
            font-size: 1.2rem;
            font-weight: 600;
            color: #fff;
        }

        .events_container article .event_main .event_description {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: rgba(0, 0, 0, 0.8);
            color: #fff;
            opacity: 0;
            visibility: hidden;
            transform: scale(0.9) translateY(20px);
            transition: all 0.5s ease;
            z-index: 2;
            border-radius: 10px;
        }

        .events_container article .event_main:hover img {
            transform: scale(1.5);
        }

        .events_container article .event_main:hover .event_description {
            opacity: 1;
            visibility: visible;
            transform: scale(1) translateY(0);
        }

        .events_container article footer {
            width: 100%;
            height: 10%;
            display: flex;
            align-items: center;
            justify-content: start;
            padding: 0.5rem;
            border-top: 1px solid #e6e6e6;
        }

        .participate {
            display: grid;
            width: 100%;
            height: 100%;
        }

        /* Estilo común del botón */
        .participate button {
            width: 100%;
            height: 100%;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 8px;
            outline: none;
            transition: background 0.3s ease, color 0.3s ease;
        }

        /* Botón cuando el usuario está participando */
        .participando {
            background: url("<?= PUBLIC_URL ?>assets/img/other/scattered-forcefields.png");
            background-size: cover;
            background-repeat: repeat;
            color: #232323;
            font-weight: 700;
        }

        .participando:hover {
            background-color: darkgreen;
        }

        /* Botón cuando el usuario no está participando */
        .no-participando {
            background: url("<?= PUBLIC_URL ?>assets/img/other/scattered-forcefields-black.png");
            background-size: cover;
            background-repeat: repeat;
            color: #fff;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .no-participando:hover {
            background-color: darkred;
        }
    </style>

<?php
}
?>