  <main class="main">

      <!-- ========================   CONTENEDOR DE IMÁGENES  ========================-->
      <div class="imgs">
          <img class="lazyload hero_img top_section_img show" data-src="<?= PUBLIC_URL ?>assets/img/hero_image_2.jpg" id="img-1" data-img alt="hero image" />


          <img class="lazyload hero_img" data-src="<?= PUBLIC_URL ?>assets/img/hero_image_4.jpg" id="img-2" data-img alt="hero image" />

          <img class="lazyload hero_img" data-src="<?= PUBLIC_URL ?>assets/img/hero_image_5.jpg" id="img-3" data-img alt="hero image" />
      </div>

      <!-- HERO SECTION -->
      <section class="top_section full_screen_section section">

          <div class="left">
              <h2>Divierte Como Nunca <br>
                  Haciendo Amigos</h2>
              <p class="section_hero_description">Una plataforma para <br>
                  organizar planes y eventos</p>
              <div class="hero_btns">
                  <button class="primary_btn btn view_modal-login" id="view-modal-login">Crear una cuenta</button>
                  <button class="secondary_btn btn view_modal-sign" id="view-modal-sign-up">Iniciar Sessión</button>
              </div>
          </div>

          <div class="right">
              <img class="lazyload hero_main_img" data-src="<?= PUBLIC_URL ?>assets/img/hero_image_3.jpg" alt="hero image">
          </div>

      </section>

      <!--  POST SECTION -->
      <section class="full_screen_section first_main_section section">
          <h3>Publica Planes</h3>
          <p class="section_description">Postea, elabora planes <br>
              y eventos emocionantes en Maewi.</p>
          <img src="<?= PUBLIC_URL ?>assets/img/hero_image_1.jpg" alt="">
          <div data-img-to-show="#img-1"></div>
      </section>


      <!--  EXPERIENCE SECTION -->
      <section class="full_screen_section section">
          <h3>Nuevas Experiencias</h3>
          <p class="section_description">Sal de tu marco, <br>
              y traza nuevos planes al instante.
          </p>
          <img src="<?= PUBLIC_URL ?>assets/img/hero_image_7.jpg" alt="hero image">
          <div data-img-to-show="#img-2"></div>
      </section>

      <!--  SELLER SECTION -->
      <section class="full_screen_section section">
          <h3>Planes Comerciales</h3>
          <p class="section_description">
              Compra y vende pases o entradas <br>
              en Maewi para participar en planes <br>e eventos
              en tu zona.
          </p>
          <div data-img-to-show="#img-3"></div>
      </section>

  </main>
  <!-- <?= require_once PARCIALS_FOLDER . 'modals/_login.php' ?> -->