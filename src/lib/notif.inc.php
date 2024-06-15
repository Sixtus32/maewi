<?php
class App_Notification
{
    private static $state;

    function __construct($state)
    {
        self::$state = $state;
        if ($state) {
            echo "<script>
            console.log('Application notification ON 🔔');
            </script>";
        } else {
            echo "<script>
            console.log('Application notification OFF 🔕');
            </script>";
        }
    }

    static function setAppNotificationState($state)
    {
        self::$state = $state;
    }

    static function getState()
    {
        return self::$state;
    }

    // Usando la consola.
    static function guideMessage($message)
    {
        if (!self::getState()) return;
        echo "console.log('$message')";
    }

    // Usando Toastify
    static function guideToastMessage($type, $message)
    {
        if (!self::getState()) return;

        $className = '';
        $background = '';
        $duration = 3000; // Duración predeterminada para mensajes de éxito e información

        switch ($type) {
            case 'success':
                $className = 'success';
                $background = 'linear-gradient(to right, #5cb85c, #449d44)';
                break;
            case 'warning':
                $className = 'warning';
                $background = 'linear-gradient(to right, #f0ad4e, #eea236)';
                break;
            case 'error':
                $className = 'error';
                $background = 'linear-gradient(to right, #d9534f, #c9302c)';
                $duration = null; // No se cerrará automáticamente
                break;
            default:
                $className = 'info';
                $background = 'linear-gradient(to right, #00b09b, #96c93d)';
                break;
        }

        $toastSettings = [
            'text' => $message,
            'duration' => $duration,
            'className' => $className,
            'style' => [
                'background' => $background
            ],
            'close' => true // Cierre del tostado
        ];

        // Agregar Toastify específico para los mensajes de error y advertencia
        if ($type === 'error' || $type === 'warning') {
            $toastSettings['stopOnFocus'] = true; // Prevenir el cierre al hacer hover
        }

        $toastScript = "Toastify(" . json_encode($toastSettings) . ").showToast();";

        echo $toastScript;
    }

    // USANDO SweetAlert
    static function guideSweetAlertMessage($type, $message)
    {
        if (!self::getState()) return;

        $script = "
        ";

        switch ($type) {
            case 'success':
            case 'warning':
            case 'error':
                $script .= "Swal.fire({
                    icon: '$type',
                    title: '$message',
                    showConfirmButton: false,
                    timer: 3000
                });";
                break;
            default:
                $script .= "Swal.fire({
                    icon: 'info',
                    title: '$message',
                    showConfirmButton: false,
                    timer: 3000
                });";
                break;
        }

        echo $script;
    }
}
