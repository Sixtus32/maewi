<?php
require_once "../lib/bd.inc.php";

// Función publishEvent
function publishEvent($event_title, $event_description, $event_image_url, $date_started, $date_ended, $event_location, $number_passes, $passes, $privacy, $event_status, $payment, $unique_id)
{
    try {
        $conn = new BD_Connection();

        // Validar longitud de event_title
        if (strlen($event_title) > 25) {
            throw new Exception("El título del evento no debe exceder los 25 caracteres.");
        }

        // Validar longitud de event_description
        if (strlen($event_description) > 200) {
            throw new Exception("La descripción del evento no debe exceder los 200 caracteres.");
        }

        // Validar fechas
        $date_started_dt = DateTime::createFromFormat('Y-m-d\TH:i', $date_started);
        $date_ended_dt = DateTime::createFromFormat('Y-m-d\TH:i', $date_ended);
        if (!$date_started_dt || !$date_ended_dt) {
            throw new Exception("Por favor, introduzca fechas válidas para el inicio y fin del evento.");
        }

        // Insertar evento en la base de datos
        $sqlInsertEvent = $conn->connection_start()->prepare("INSERT INTO events
            (eventId, event_title, event_description, event_image_url, date_started, date_ended, event_location, number_passes, passes, privacy, event_status, payment, unique_id)
            VALUES (null, :event_title, :event_description, :event_image_url, :date_started, :date_ended, :event_location, :number_passes, :passes, :privacy, :event_status, :payment, :unique_id)");

        $sqlInsertEvent->bindValue(':event_title', $event_title);
        $sqlInsertEvent->bindValue(':event_description', $event_description);
        $sqlInsertEvent->bindValue(':event_image_url', $event_image_url);
        $sqlInsertEvent->bindValue(':date_started', $date_started);
        $sqlInsertEvent->bindValue(':date_ended', $date_ended);
        $sqlInsertEvent->bindValue(':event_location', $event_location);
        $sqlInsertEvent->bindValue(':number_passes', $number_passes);
        $sqlInsertEvent->bindValue(':passes', $passes);
        $sqlInsertEvent->bindValue(':privacy', $privacy, PDO::PARAM_INT);
        $sqlInsertEvent->bindValue(':event_status', $event_status);
        $sqlInsertEvent->bindValue(':payment', $payment, PDO::PARAM_INT);
        $sqlInsertEvent->bindValue(':unique_id', $unique_id);
        $sqlInsertEvent->execute();
    } catch (Exception $e) {
        // echo "<script>
        // console.log('Error al registrar el evento1');
        // </script>";
        echo "Error: " . $e->getMessage();
    }
}
