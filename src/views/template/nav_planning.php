        <header class="home_header">
            <nav class="home_nav">
                <h1>
                    <a href="<?= URL ?>" class="nav_logo">
                        maewi
                    </a>
                </h1>

                <div class="home_header_box">
                    <!-- BUSCADOR EN EL HOME -->
                    <div class="home_search" id="home-search-input">
                        <a href="#" hidden id="home-search-lnk"></a>
                        <input type="text" name="search_input" id="search-input">
                        <div class="autocomplete_box" id="autocomplete-box">
                            <!-- aqui se irán listando  -->
                        </div>
                        <div class="home_search-icon" id="home-search-icon" title="Buscador">
                            <i class="ri-search-2-line"></i>
                        </div>
                    </div>

                    <!-- NOTIFICACIONES -->
                    <div class="home_notification">
                        <a href="#" title="Notificaciones" class="home_notification_link">
                            <span class="home_notification_read"></span>
                            <i class="ri-notification-line"></i>
                        </a>
                    </div>

                    <!-- PERFIL DE USUARIO -->
                    <a href="#" title="Perfil" class="home_profile">
                        <img src="<?= $_SESSION['user_profile_photo'] ?>" alt="user profile photo">
                    </a>
                </div>

                <div class="nav_menu">
                    <ul class="nav_list">

                        <li class="nav_item">
                            <a href="<? URL ?>" class="nav_link" title="Inicio">
                                <i class="ri-home-fill"></i>
                                <span>Inicio</span>
                            </a>
                        </li>

                        <li class="nav_item">
                            <a href="#" class="nav_link" title="Explorar">
                                <i class="ri-search-line"></i>
                                <span>Búsqueda</span>
                            </a>
                        </li>

                        <li class="nav_item">
                            <a href="<?= URL ?>/src/views/explore.php" class="nav_link" title="Explorar">
                                <i class="ri-compass-line"></i>
                                <span>Explorar</span>
                            </a>
                        </li>

                        <li class="nav_item">
                            <a href="#" class="nav_link" title="Publicar" id="view-modal-event">
                                <i class="ri-add-box-line"></i>
                                <span>Publicar</span>
                            </a>
                        </li>

                        <li class="nav_item">
                            <a href="<?= URL ?>/src/views/planning.php" class="nav_link active-link" title="Entradas">
                                <i class="ri-calendar-line"></i>
                                <span title="Pase">Eventos</span>
                            </a>
                        </li>

                        <li class="nav_item" title="Chat" id="view-modal-chat">
                            <a href="#" class="nav_link" title="Chat">
                                <i class="ri-send-plane-line"></i>
                                <span>Chat</span>
                            </a>
                        </li>

                        <li class="nav_item">
                            <a href="#" class="nav_link" title="Explorar">
                                <i class="ri-notification-line"></i>
                                <span>Notificaciones</span>
                            </a>
                        </li>

                        <li class="nav_item">
                            <a href="<?= URL ?>/src/func/close.session.php" class="nav_link" title="Cerrar Sesión">
                                <i class="ri-login-circle-line"></i>
                                <span>Cerrar Sessión</span>
                            </a>
                        </li>
                    </ul>

                </div>
            </nav>
        </header>
        <style>
            /*
*     HOME HEADER FOR VALID USER
*/
            .home_header {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                background-color: var(--container-color);
                z-index: var(--z-fixed);
                transition: box-shadow 0.4s, background-color 0.4s;
            }

            .home_nav {
                height: var(--header-height);
            }

            .home_main {
                position: sticky;
                top: 0;
                background: #fff;
            }

            @media screen and (max-width: 760px) {
                .nav_menu {
                    position: fixed;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    width: 100%;
                    background-color: var(--container-color);
                    box-shadow: 0 -8px 32px hsla(0, 0%, 0%, 0.1);
                    padding: 1.25rem 4rem;
                    transition: background-color.4s;
                    height: 62.5px;
                }

                .nav_logo {
                    display: none;
                }

                .home_header_box {
                    background-color: var(--real-white-color);
                    display: flex;
                    align-items: center;
                    height: 100%;
                    justify-content: center;
                    column-gap: 2rem;
                    padding: 5px 15px;
                    border-bottom: 2px solid var(--container-color);
                }

                /* BUSCADOR EN EL HOME  */
                ::selection {
                    color: var(--white-color);
                    background-color: var(--container-color);
                }

                .home_header_box .home_search {
                    background: var(--white-color);
                    width: 65%;
                    border-radius: 5px;
                    position: relative;
                    box-shadow: 0px 1px 5px 3px rgba(0, 0, 0, 0.12);
                }

                .home_search input {
                    background: var(--input-field-cololr);
                    width: 100%;
                    height: 40px;
                    border-radius: 5px;
                    outline: none;
                    border: none;
                    padding: 0 60px 0 20px;
                    color: var(--font-color);
                    font-size: 1rem;
                }

                .home_search.active input {
                    border-radius: 5px 5px 0 0;
                }

                .home_search .home_search-icon {
                    position: absolute;
                    right: 0px;
                    top: 1px;
                    height: 40px;
                    width: 40px;
                    text-align: center;
                    line-height: 40px;
                    font-size: 20px;
                    color: var(--input-field-insiders);
                    cursor: pointer;
                }

                .home_search .autocomplete_box {
                    padding: 0;
                    opacity: 0;
                    pointer-events: none;
                    max-height: 280px;
                    overflow-y: auto;
                    position: absolute;
                    top: 3.5rem;
                    width: 100%;
                    background-color: var(--real-white-color);
                    border-radius: 5px;
                }

                .home_search.active .autocomplete_box {
                    padding: 10px 8px;
                    opacity: 1;
                    pointer-events: auto;
                }

                .autocomplete_box li {
                    list-style: none;
                    padding: 8px 12px;
                    display: none;
                    width: 100%;
                    cursor: default;
                    border-radius: 3px;
                }

                .home_search.active .autocomplete_box li {
                    display: block;
                }

                .autocomplete_box li:hover {
                    background-color: var(--input-field-cololr);
                }

                /* NOTIFICACIONES EN EL HOME  */
                .home_notification .home_notification_link i {
                    font-size: 1.5rem;
                }

                .home_notification .home_notification_link .home_notification_read {
                    display: block;
                    width: 0.5rem;
                    height: 0.5rem;
                    background-color: var(--notification-color);
                    border-radius: 50%;
                    position: relative;
                    left: 15px;
                    top: 8px;
                }

                /* PERFIL EN EL HOME  */
                .home_profile {
                    border-radius: 50%;
                    height: 42.5px;
                    width: 42.5px;
                    background: linear-gradient(#0250c5, #d43f8d);
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }

                .home_profile img {
                    width: 90%;
                    border-radius: 50%;
                    height: 90%;
                }

                .nav_list {
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                }

                .nav_link {
                    color: var(--font-color);
                    transition: color 0.4s;
                }

                ul.nav_list li.nav_item:nth-child(2),
                ul.nav_list li.nav_item:nth-child(7) {
                    display: none;
                }

                .nav_link span {
                    display: none;
                }

                .nav_link i {
                    font-size: 1.75rem;
                    transition: font-size 0.05s;
                }

                .nav_link i:hover {
                    font-size: 2rem;
                }
            }

            .nav_list .nav_link .active-link i {
                background-color: #000;
            }


            @media screen and (min-width: 760px) {

                .home_header {
                    width: 80px;
                    height: 100%;
                    background: #fff;
                    border-right: 1px solid #dbdbdb;
                }

                .home_header .home_nav {
                    width: 100%;
                    height: 100%;
                }

                .home_header .home_nav .nav_menu {
                    display: flex;
                    justify-content: center;
                    width: 100%;
                    margin-top: 4.5rem;
                }

                .home_header .home_nav h1 a {
                    display: none;
                }

                .home_header .home_nav h1 i {
                    display: block !important;
                }

                .nav_menu .nav_list {
                    width: 100%;
                    display: grid;
                    justify-content: center;
                    row-gap: 1.5rem;
                }

                .nav_list li {
                    width: 100%;
                    height: 25%;
                    padding: 0.5rem;
                }

                .nav_link span {
                    display: none;
                }


                .nav_link i {
                    font-size: 1.5rem;
                    transition: font-size 0.05s;
                }

                ul.nav_list li.nav_item:nth-child(7) {
                    display: none;
                }


                .nav_link i:hover {
                    font-size: 2.5rem;
                }

                .home_header .home_nav .home_header_box .home_search {
                    display: none;
                }

                .home_header_box .home_notification {
                    width: 100%;
                    position: absolute;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    top: 40rem;
                    height: 5%;
                }

                .home_notification .home_notification_read {
                    display: block;
                    width: .5rem;
                    height: .5rem;
                    position: relative;
                    background: var(--notification-color);
                    border-radius: 50%;
                    top: .5rem;
                    right: -1.12rem;
                }

                .home_notification i {
                    font-size: 1.75rem;
                }

                .home_header_box .home_profile {
                    position: absolute;
                    top: 44rem;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    height: 5%;
                    border-radius: 50%;
                }

                .home_profile img {
                    border-radius: 50%;
                    width: 52.5%;
                }

                .home_main {
                    left: 80px;
                    width: calc(100% - 80px);
                }
            }

            @media screen and (min-width: 1165px) {
                .home_header {
                    width: 300px;
                }

                .home_header .home_nav h1 {
                    margin-top: 25px;
                    display: flex;
                    justify-content: center;
                }

                .home_header .home_nav h1 a {
                    display: inline;
                }

                .home_header_box .home_notification {
                    display: none;
                }

                .home_header .home_nav .nav_menu {
                    height: 550px;
                    margin-top: 1rem;
                }

                .nav_menu .nav_list {
                    align-items: center;
                    row-gap: 0;
                }

                .nav_list li {
                    height: 50px;
                }

                .nav_list .nav_item {
                    display: inline-flex;
                    align-items: center;
                    width: 245px;
                    padding: 0 .75rem;
                }

                .nav_list .nav_item .nav_link {
                    width: 100%;
                    display: inline-flex;
                    align-items: center;
                    column-gap: 2rem;
                    height: 100%;
                    padding-left: 0.5rem;
                    font-weight: var(--font-medium);
                }

                .nav_list .nav_item .nav_link:hover {
                    background: #dbdbdb;
                    border-radius: 12px;
                    font-weight: var(--font-semi-bold);
                }

                ul.nav_list li.nav_item:nth-child(7) {
                    display: inline-block;
                }

                .nav_link span {
                    display: inline-block;
                    font-size: var(--h3-font-size);
                }

                .nav_link i {
                    font-size: 2rem;
                }

                .home_header_box .home_profile {
                    height: 200px;
                    display: none;
                }

                .home_main {
                    left: 300px;
                    width: calc(100% - 300px);
                }
            }

            .nav_list .nav_item:last-child .nav_link {
                color: #B22222;
                /* Color rojizo profesional */
            }
        </style>