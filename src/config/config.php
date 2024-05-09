<?php

/**
 *  Configuraciones genéricas.
 */
// Nuestras URLs


/**
 *  Configuraciones genéricas.
 */
// Nuestras URLs
define("PUBLIC_URL", "/maewi_dev/public/");
define("LOCAL_URL", "file:///C:/xampp/htdocs/maewi_dev/src/");
define("BASE_URL", "/maewi_dev/");
define('URL', 'http://127.0.0.1/maewi_dev');
define("BASE_URL_DEV", "http://127.0.0.1/maewi_dev/public/");

define("BASE_URL_PRE", "http://127.0.0.1/maewi_pre");
define("BASE_URL_PRO", "http://127.0.0.1/maewi_pro");
define("SITE_URL", "maewi.com/");
define("ADMIN_URL", "admin.maewi.com/");
define("BLOG_URL", "blog.maewi.com/");
define("POLICY_URL", "policy.maewi.com/");
define("HELP_URL", "help.maewi.com/");
define("ERROR_404_URL", "src/pages/404.php");

// Base de Datos
define("DB_HOST", 'localhost');     // Host del servidor MySQL
define("DB_USER", "root");          // Usuario del servidor MySQL
define("DB_PASSWORD", "");          // Contraseña del usuario
define("DB_NAME", "maewi");         // Nombre de la base de datos a utilizar
define("DB_CHARSET", "utf8");       // Caracteres Encode

// Configuración de rutas de directorios y ficheros
define("MODELS_FOLDER",  "models/");
define("VIEWS_FOLDER", LOCAL_URL . "views/");
define("TEMPLATES_FOLDER", LOCAL_URL . "views/template/");
define("PARCIALS_FOLDER", LOCAL_URL . "views/partials/");
define("CONTROLLERS_FOLDER", "controllers/");
define("AUTOLOADER_FILE", "config/app/autoload.php");
define("CONFIG_FILE", "config/config.php");
// Dirección de Conexión
define("CONNECTION_DIR", "config/app/connection.php");


// Credenciales de autenticación u otros tokens define("API_KEY", "YOUR_API_KEY");
define("AUTH_TOKEN", "YOUR_AUTH_TOKEN");

// Nombre de las tablas de la base de datos.
define("TB_USERS", "users");
define("TB_USER_DETAILS", "users_details");
define("TB_SOCIAL_LINKS", "social_media_links");
define("TB_EVENTS", "events");
define("TB_TICKETS", "tickets");
define("TB_SAVED", "saved");
define("TB_RATINGS", "ratings");
define("TB_PUBLICATIONS", "publications");
define("TB_PAYMENTS", "payments");
define("TB_MESSAGES", "messages");
define("TB_FOLLOWERS", "followers");
define("TB_COMMENTS", "comments");

/*
        DATOS DEL SERVIDOR
     */

// Obtener la url actual
$currentURL =   'http' . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 's' : '')
    . "://" . $_SERVER['HTTP_HOST']  .  $_SERVER['REQUEST_URI'];
// Obtener la dirección IP del cliente
$clienteIP = $_SERVER['REMOTE_ADDR'];
// Obtener el método de la solicitud HTTP (GET, POST, etc..)
$methodRequest = $_SERVER["REQUEST_METHOD"];
// Obtener información sobre el archivo en ejecución.
$filePath = $_SERVER["SCRIPT_FILENAME"];
