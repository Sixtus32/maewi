<script>
    // Obtener el idioma seleccionado de la sesión PHP
    var language = "<?php echo isset($_SESSION['language']) ? $_SESSION['language'] : 'en'; ?>";

    // Cargar las traducciones según el idioma seleccionado
    var translations = <?php include_once 'index.js' ?>

    // Mostrar el título de la aplicación según el idioma seleccionado
    document.getElementById('title').innerText = translations.applicationl.title[language];
</script>