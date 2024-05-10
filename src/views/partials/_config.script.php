<!-- Script de configuración para cliente en js. -->
<script src="<?=PUBLIC_URL?>assets/js/base.config.js"></script>
<!-- JSON-LD (JSON for Linked Data)
    @context:   Define el contexto en el que se encuentra
                el objeto JSON-LD. En este caso, se establece
                como "http://schema.org".
    @type :     Define el tipo de entidad, que en este caso es una "Organización".
    name :      Nombre de la organización (Maewi)
    url :       La URL de la página principal de la organización (www.maewi.com).
    description : Descripción breve de Maewi
    foundingDate : Fecha de fundación de la organización.
    founders :  Lista de fundadores donde se detallan sus nombres y se especifica su tipo como "Person"
    sameAs :    Lista de URLs que representan perfiles de redes sociales de la organización
-->
<script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Organization",
        "name" : "Maewi",
        "url" : "https://maewi.com/",
        "description" : "Los mejores planes son aquellos
        pertudurán en la mente, y buscan ser replicados
        o superados. Únete hoy a Maewi.",
        "foundingDate" : "2024-01-31",
        "founders" : [
            {
                "@type" : "Person",
                "name" : "Sixtus Nosike"
            }
        ],
        "sameAs" : [
            "https://www.youtube.com/maewi",
            "https://twitter.com/maewi"
        ]
    }
</script>