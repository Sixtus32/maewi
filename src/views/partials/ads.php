    <div class="ads_container">
        <div class="ads_content">
            <div class="ads_header">
                <h4>Próximos eventos</h4>
            </div>
            <hr>
            <ul class="ads_list">
                <li class="ads_list-item">
                    <img src="<?= PUBLIC_URL . "assets/img/other/party1.jpg" ?>" alt="PARTY 1">
                    <a href="#" class="item-content">
                        <div class="date">
                            <span class="day">16</span>
                            <span class="month">FEB</span>
                        </div>
                        <div class="info">
                            <div class="place">
                                <div class="time">
                                    <span>23:00 a 04:00</span>
                                </div>
                                <div class="location">
                                    <span>SAN VALENTÍN<br>UNIVERSITARIO</span>
                                </div>
                                <span class="artist">
                                    <span class="marquee">Artista: Skrillex
                                        [ MÚSICA ]
                                    </span>
                                </span>
                            </div>
                            <div class="direct">
                                <span class="age">+16</span>
                                <span class="watch">
                                    <i class="ri-live-line"></i>
                                    En DIRECTO
                                </span>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="ads_list-item">
                    <img src="<?= PUBLIC_URL . "assets/img/other/party3.jpg" ?>" alt="PARTY 2">
                    <a href="#" class="item-content">
                        <div class="date">
                            <span class="day">21</span>
                            <span class="month">MAR</span>
                        </div>
                        <div class="info">
                            <div class="place">
                                <div class="time">
                                    <span>23:00 a 04:00</span>
                                </div>
                                <div class="location">
                                    <span>SAN JUAN</span>
                                </div>
                                <span class="artist">
                                    <span class="marquee">Artista: Skrillex</span>
                                </span>
                            </div>
                            <div class="direct">
                                <span class="age">+18</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="ads_list-item">
                    <img src="<?= PUBLIC_URL . "assets/img/other/party2.jpg" ?>" alt="PARTY 3">
                    <a href="#" class="item-content">
                        <div class="date">
                            <span class="day">21</span>
                            <span class="month">MAR</span>
                        </div>
                        <div class="info">
                            <div class="place">
                                <div class="time">
                                    <span>23:00 a 04:00</span>
                                </div>
                                <div class="location">
                                    <span>SAN JUAN</span>
                                </div>
                                <span class="artist">
                                    <span class="marquee">Artista: Skrillex</span>
                                </span>
                            </div>
                            <div class="direct">
                                <span class="age">+18</span>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="trend">

    </div>

    <style>
        .ads_container {
            display: none;
        }

        @media screen and (min-width: 1165px) {
            .ads_container {
                display: block;
                position: fixed;
                width: 350px;
                height: 400px;
                position: absolute;
                right: 2%;
                top: 10%;
                border-radius: 10px;
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
                background-color: #000000;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='250' height='30' viewBox='0 0 1000 120'%3E%3Cg fill='none' stroke='%23222' stroke-width='10' %3E%3Cpath d='M-500 75c0 0 125-30 250-30S0 75 0 75s125 30 250 30s250-30 250-30s125-30 250-30s250 30 250 30s125 30 250 30s250-30 250-30'/%3E%3Cpath d='M-500 45c0 0 125-30 250-30S0 45 0 45s125 30 250 30s250-30 250-30s125-30 250-30s250 30 250 30s125 30 250 30s250-30 250-30'/%3E%3Cpath d='M-500 105c0 0 125-30 250-30S0 105 0 105s125 30 250 30s250-30 250-30s125-30 250-30s250 30 250 30s125 30 250 30s250-30 250-30'/%3E%3Cpath d='M-500 15c0 0 125-30 250-30S0 15 0 15s125 30 250 30s250-30 250-30s125-30 250-30s250 30 250 30s125 30 250 30s250-30 250-30'/%3E%3Cpath d='M-500-15c0 0 125-30 250-30S0-15 0-15s125 30 250 30s250-30 250-30s125-30 250-30s250 30 250 30s125 30 250 30s250-30 250-30'/%3E%3Cpath d='M-500 135c0 0 125-30 250-30S0 135 0 135s125 30 250 30s250-30 250-30s125-30 250-30s250 30 250 30s125 30 250 30s250-30 250-30'/%3E%3C/g%3E%3C/svg%3E");
            }

            .ads_container .ads_header {
                text-align: center;
                padding: 1.25rem;
            }

            .ads_container .ads_header h4 {
                color: #fff;
                font-size: .965rem;
                font-weight: 700;
            }

            .ads_container .ads_list {
                display: grid;
                row-gap: .5rem;
                align-items: center;
                justify-content: center;
                padding: 0.75rem 0;
                width: 100%;
                height: 100%;
            }

            .ads_container .ads_list .ads_list-item {
                position: relative;
                background: blue;
                width: 332px;
                height: 100px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                overflow: hidden;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .ads_container .ads_list .ads_list-item:hover {
                transform: scale(1.03);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            }

            .ads_container .ads_list .ads_list-item img {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                z-index: 0;
                border-radius: 10px;
                transition: opacity 0.3s ease;
            }

            .ads_container .ads_list .ads_list-item:hover img {
                opacity: 0.8;
            }

            .ads_container .ads_list .ads_list-item .item-content {
                position: relative;
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 100%;
                height: 100%;
                padding: 0 5px;
                column-gap: .75rem;
                z-index: 1;
                /* Asegura que el contenido esté encima de la imagen */
            }

            .item-content .date {
                font-size: 0.8rem;
                width: 15%;
                height: 45px;
                border-radius: 10px;
                position: relative;
                background: #232323;
                display: grid;
                justify-content: center;
                align-items: center;
                text-align: center;
                top: -20%;
            }

            .item-content .date span {
                color: #fff;
                font-size: .85rem;
                font-weight: 600;
            }

            .item-content .info {
                position: relative;
                width: 85%;
                height: 100%;
                padding: 0.15rem 0;
                display: flex;
                justify-content: space-between;
            }

            .item-content .info .time {
                background: #232323;
                width: 125px;
                height: 20px;
                border-radius: 10px;
                color: #fff;
                text-align: center;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.854rem;
            }

            .item-content .info .place {
                display: grid;
                justify-content: start;
                align-items: center;
                border-radius: 10px;
                background: transparent;
                row-gap: .225rem;
            }

            .item-content .info .location {
                transition: background-color 0.3s ease, opacity 0.3s ease;
                background: rgba(35, 35, 35, 0.8);
                /* Fondo semi-transparente */
                color: #fff;
                font-size: 1.25rem;
                padding: 0.259rem;
                font-weight: 700;
                border-radius: 10px;
                opacity: 0.8;
                margin-bottom: 0.2rem;
                /* Hacer medio transparente */
            }

            .item-content .info .location:hover {
                opacity: 1;
            }

            .item-content .info .artist {
                position: relative;
                overflow: hidden;
                width: 100%;
                height: 12px;
                background: #232323;
                /* Fondo semi-transparente claro */
                color: #fff;
                font-size: 0.25rem;
                border-radius: 5px;
                font-weight: 600;
                text-align: center;
                transition: background-color 0.3s ease, color 0.3s ease;
                top: -7px;
            }

            .artist .marquee {
                display: inline-block;
                white-space: nowrap;
                padding-left: 100%;
                animation: marquee 8s linear infinite;
                font-size: 0.75rem;
                color: #fff;
                text-shadow: 0 0 10px #00f, 0 0 20px #00f, 0 0 30px #00f,
                    0 0 40px #00f, 0 0 50px #00f, 0 0 60px #00f,
                    0 0 70px #00f;
                /* Repetir el patrón de fondo */
                background-repeat: repeat;
                width: 120px;
            }

            @keyframes marquee {
                0% {
                    transform: translateX(100%);
                }

                100% {
                    transform: translateX(-100%);
                }
            }

            .direct .age {
                width: 40px;
                height: 20px;
                position: absolute;
                border-radius: 15px;
                top: 10px;
                right: 15px;
                background: #232323;
                color: #fff;
                text-align: center;
                padding: 0.1rem;
                font-weight: 600;
            }

            .direct .watch {
                width: 85px;
                height: 20px;
                display: inline-flex;
                position: relative;
                top: 70px;
                border-radius: 5px;
                background: red;
                color: #fff;
                align-items: center;
                text-align: center;
                justify-content: center;
                column-gap: .25rem;
                font-weight: 600;
                font-size: 0.65rem;
            }
        }
    </style>