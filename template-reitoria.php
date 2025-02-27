<?php
/**
 * Template Name: reitoria
 */
get_header();

?>

<!-- jQuery (Necessário para o Owl Carousel funcionar) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Arquivos CSS do Owl Carousel -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<!-- Arquivo JS do Owl Carousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>



<main class="main">
      <section class="section">
        <div class="title__box">
          <div class="tb__title">
            <h2>Reitoria</h2>
          </div>
        </div>
      </section>
      <section class="section">
        <div class="container">
          <div class="spacing">
            <p>
              A Reitoria é órgão executivo superior de gestão, acompanhamento e
              avaliação das atividades do Centro Universitário Santa Maria.
            </p>
          </div>
          <div class="cards__img">
            <div>
                <img src="<?php echo get_template_directory_uri(); ?>/src/assets/images/orientador.png" alt="">
                <p>Ana Costa Goldfarb</p>
                <span>Reitora</span>
            </div>
            <div>
                <img src="<?php echo get_template_directory_uri(); ?>/src/assets/images/orientador.png" alt="">
                <p>Silvania Lira Braga Ramalho</p>
                <span>Secretária Executiva</span>
                <span>(83) 98108-5849</span>
                <span>secretariafsm@gmail.com</span>
            </div>
            <div>
                <img src="<?php echo get_template_directory_uri(); ?>/src/assets/images/orientador.png" alt="">
                <p>Sheylla Nadjane Batista Lacerda</p>
                <span>Reitora</span>
            </div>
          </div>
        </div>
      </section>
    </main>

<!-- Custom -->
    <script src="<?php echo get_template_directory_uri(); ?>/src/assets/js/script.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/src/assets/js/main.js"></script>

<?php get_footer(); ?>
