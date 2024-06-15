<?php
session_start();
require_once("../controllers/bd.events.inc.php");
require_once("../controllers/bd.users.inc.php");
require_once("../config/config.php");

// Verificar si se están recibiendo los datos esperados
if (
    isset($_POST['event_title']) &&
    isset($_POST['event_description']) &&
    isset($_POST['date_started']) &&
    isset($_POST['date_ended']) &&
    isset($_POST['number_passes']) &&
    isset($_POST['event_location'])
) {
    $event_title = $_POST['event_title'];
    $event_description = $_POST['event_description'];
    $event_image_url = '';
    $date_started = $_POST['date_started'];
    $date_ended = $_POST['date_ended'];
    $event_location = $_POST['event_location'];
    $number_passes = $_POST['number_passes'];
    $passes = 0;
    $privacy = isset($_POST['privacy']) ? 1 : 0;
    $event_status = "TO START";
    $payment = isset($_POST['payment']) ? 1 : 0;
    $unique_id = $_SESSION['unique_id'];
    $new_img_name = '';
    echo "<script>console.log('Comencemos');</script>";

    // Procesar la imagen del evento
    if (isset($_FILES['event_image_url']) && $_FILES['event_image_url']['error'] == 0) {
        $img_name = $_FILES['event_image_url']['name'];
        $img_type = $_FILES['event_image_url']['type'];
        $tmp_name = $_FILES['event_image_url']['tmp_name'];

        $img_explode = explode('.', $img_name);
        $img_ext = end($img_explode);

        $extensions = ["jpeg", "png", "jpg"];
        if (!in_array($img_ext, $extensions)) {
            die("Por favor, suba un archivo de imagen - jpeg, png, jpg");
        }

        $types = ["image/jpeg", "image/jpg", "image/png"];
        if (!in_array($img_type, $types)) {
            die("Por favor, suba un archivo de imagen - jpeg, png, jpg");
        }

        $time = time();
        $new_img_name = $time . $img_name;
        $event_image_url = "../../public/assets/img/pub/" . $new_img_name;
        if (!move_uploaded_file($tmp_name, $event_image_url)) {
            die("¡Algo salió mal! ¡Por favor, inténtalo de nuevo!");
        }
    } else {
        // Asigna una URL de imagen predeterminada si no se subió ninguna imagen
        $event_image_url = "../../public/assets/img/pub/default_image.jpg"; // Cambia esta URL a la ruta de tu imagen predeterminada
        $new_img_name = "default_image.jpg";
    }
    // Publicar el evento si todo está bien
    if (publishEvent($event_title, $event_description, $new_img_name, $date_started, $date_ended, $event_location, $number_passes, $passes, $privacy, $event_status, $payment, $unique_id)) {
        echo "success";
    } else {
        // echo "<script>console.log('Error al registrar el evento');</script>";
        echo "Error al registrar el evento.";
    }
}