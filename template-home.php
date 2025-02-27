<?php
/**
 * Template Name: Home Personalizada
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
    <section class="section slides">
        <div class="background">
            <div class="slider-container">
                <div class="slider">
                    <?php
                    // Obtém a galeria de fotos da página de opções
                    $banners = get_field('fotos', 'option');

                    if (!empty($banners)) :
                        foreach ($banners as $banner) :
                            $image_url = esc_url($banner['url']);
                            $image_alt = esc_attr($banner['alt'] ?: 'Banner');
                            ?>
                            <div class="slide">
                                <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>" />
                            </div>
                            <?php
                        endforeach;
                    else :
                        echo '<p>Nenhum banner encontrado.</p>';
                    endif;
                    ?>
                </div>
                <button class="prev">&#10094;</button>
                <button class="next">&#10095;</button>
                <div class="dots-container">
                    <?php
                    if (!empty($banners)) :
                        foreach ($banners as $index => $banner) :
                            echo '<span class="dot" data-index="' . $index . '"></span>';
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Notícias -->
    <section class="section news">
        <div class="new__container">
            <div class="title__container">
                <h5 class="title">Acontece na UNIFSM</h5>
                <div>
                <a class="a__yellow" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">Mais Notícias <i class="ri-arrow-right-up-line"></i></a>
                </div>
            </div>
            <div class="b__new">
                <div class="new__group">
                <?php
                // Query para o post mais recente
                $args = array(
                    'posts_per_page' => 1,
                    'post_type' => 'post',
                );
                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="new__img_l">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>">
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/src/assets/images/img-teste.png" alt="Imagem Padrão">
                            <?php endif; ?>
                        </div>
                        <div class="new__content_l">
                            <h5><?php the_title(); ?></h5>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?></p>
                            <div>
                                <a href="<?php the_permalink(); ?>">Continuar lendo <i class="ri-arrow-right-up-line"></i></a>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                endif;
                ?>
                </div>
                <div class="col__r">
                <?php
                // Query para os próximos 3 posts
                $args = array(
                    'posts_per_page' => 3,
                    'post_type' => 'post',
                    'offset' => 1
                );
                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="new__group_r">
                            <div class="new__img_r">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>">
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/src/assets/images/img-teste.png" alt="Imagem Padrão">
                                <?php endif; ?>
                            </div>
                            <div class="new__content_r">
                                <h5><?php the_title(); ?></h5>
                                <p><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
                                <div>
                                    <a href="<?php the_permalink(); ?>">Continuar lendo <i class="ri-arrow-right-up-line"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>Nenhuma notícia encontrada.</p>';
                endif;
                ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Formas de financiamento -->
    <section class="section">
        <div class="div__container i__accordion">
            <?php
            // Consulta para recuperar os posts do CPT "info-curso"
            $infoCursos = new WP_Query(array(
                'post_type'      => 'info-curso',
                'posts_per_page' => -1,
                'title'          => 'info-cursos',
            ));

            if ($infoCursos->have_posts()) :
                while ($infoCursos->have_posts()) : $infoCursos->the_post();

                    // Verifica se o campo 'item' existe e tem dados
                    if (have_rows('item')) :
                        while (have_rows('item')) : the_row();
                            $item_menu = get_sub_field('item_menu');
                            $itens = get_sub_field('itens');

                            // Exibe o título do acordeão
                            echo '<div class="accordion">';
                            echo '<div class="a__title">';
                            echo '<span>' . esc_html($item_menu) . '</span>';
                            echo '<i class="ri-arrow-drop-down-line"></i>';
                            echo '</div>';

                            // Exibe os links dos itens associados
                            if ($itens) {
                                echo '<div class="a__btns"><ul>';
                                foreach ($itens as $item) {
                                    $nome = $item['nome'];
                                    $link = $item['link'];
                                    echo '<li><a href="' . esc_url($link) . '">' . esc_html($nome) . ' <i class="ri-arrow-right-up-line"></i></a></li>';
                                }
                                echo '</ul></div>';
                            }

                            echo '</div>';
                        endwhile;
                    endif;

                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>Nenhuma informação encontrada.</p>';
            endif;
            ?>
        </div>
    </section>

    <section class="section">
      <div class="g__container">
          <div class="title__container">
              <h5 class="title">Graduação</h5>
              <div>
                  <a class="a__yellow" href="<?php echo esc_url(home_url('/cursos')); ?>">
                      Todos os cursos <i class="ri-arrow-right-up-line"></i>
                  </a>
              </div>
          </div>
          <div class="g__carousel">
              <div class="g__tab__box">
                  <button class="tab__btn active" data-tab="presencial">Presencial</button>
                  <button class="tab__btn" data-tab="digital">Cursos Digitais</button>
              </div>
              <div class="g__content__box">
                  <?php
                  // Array para armazenar IDs dos cursos já exibidos
                  $exibidos = array();
                  ?>

                  <!-- Cursos Presenciais -->
                  <div class="g__content active" id="presencial">
                      <ul class="owl-carousel owl-theme">
                          <?php
                          $args = array(
                              'post_type'      => 'curso',
                              'posts_per_page' => -1,
                              'meta_query'     => array(
                                  array(
                                      'key'   => 'modalidade',
                                      'value' => 'Presencial',
                                  ),
                              ),
                          );
                          $query = new WP_Query($args);
                          if ($query->have_posts()) :
                              while ($query->have_posts()) : $query->the_post();
                                  if (!in_array(get_the_ID(), $exibidos)) { // Verifica se já foi exibido
                                      $exibidos[] = get_the_ID(); // Adiciona ao array de exibidos
                                      $nome = get_field('nome_curso');
                                      $tipo = get_field('tipo');
                                      $semestres = get_field('semestres');
                                      $periodo = get_field('periodo');
                                      $link = get_permalink();
                          ?>
                                      <li class="card__item item">
                                          <a href="<?php echo esc_url($link); ?>">
                                              <div class="card__i" draggable="false">
                                                  <i class="ri-graduation-cap-fill"></i>
                                                  <h5><?php echo esc_html($nome); ?></h5>
                                              </div>
                                              <div class="card_content">
                                                  <p><?php echo esc_html($tipo); ?></p>
                                                  <p><?php echo esc_html($semestres); ?> semestres</p>
                                                  <p><?php echo esc_html($periodo); ?></p>
                                              </div>
                                              <div class="card__link">
                                                  <a href="<?php echo esc_url($link); ?>"><i class="ri-add-line"></i> Saiba mais</a>
                                              </div>
                                          </a>
                                      </li>
                          <?php
                                  }
                              endwhile;
                          else :
                              echo '<p>Nenhum curso presencial encontrado.</p>';
                          endif;
                          wp_reset_postdata();
                          ?>
                      </ul>
                  </div>

                  <!-- Cursos Digitais -->
                  <div class="g__content" id="digital">
                      <ul class="owl-carousel owl-theme">
                          <?php
                          $args = array(
                              'post_type'      => 'curso',
                              'posts_per_page' => -1,
                              'meta_query'     => array(
                                  array(
                                      'key'   => 'modalidade',
                                      'value' => 'Digital',
                                  ),
                              ),
                          );
                          $query = new WP_Query($args);
                          if ($query->have_posts()) :
                              while ($query->have_posts()) : $query->the_post();
                                  if (!in_array(get_the_ID(), $exibidos)) { // Verifica se já foi exibido
                                      $exibidos[] = get_the_ID(); // Adiciona ao array de exibidos
                                      $nome = get_field('nome_curso');
                                      $tipo = get_field('tipo');
                                      $semestres = get_field('semestres');
                                      $periodo = get_field('periodo');
                                      $link = get_permalink();
                          ?>
                                      <li class="card__item item">
                                          <a href="<?php echo esc_url($link); ?>">
                                              <div class="card__i" draggable="false">
                                                  <i class="ri-graduation-cap-fill"></i>
                                                  <h5><?php echo esc_html($nome); ?></h5>
                                              </div>
                                              <div class="card_content">
                                                  <p><?php echo esc_html($tipo); ?></p>
                                                  <p><?php echo esc_html($semestres); ?> semestres</p>
                                                  <p><?php echo esc_html($periodo); ?></p>
                                              </div>
                                              <div class="card__link">
                                                  <a href="<?php echo esc_url($link); ?>"><i class="ri-add-line"></i> Saiba mais</a>
                                              </div>
                                          </a>
                                      </li>
                          <?php
                                  }
                              endwhile;
                          else :
                              echo '<p>Nenhum curso digital encontrado.</p>';
                          endif;
                          wp_reset_postdata();
                          ?>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
    </section>




    <section class="section">
      <div class="pg__container">
          <div class="pg__graduation">
          <h5 class="title">Pós-Graduação</h5>
          <p class="pg__text">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Error
              eligendi doloremque porro vero expedita, non dicta dolores ducimus
              deleniti exercitationem, incidunt voluptatem atque sit iusto vel
              nisi saepe in laudantium!
          </p>
          <div>
              <a class="a__yellow" href="#"
              >Saiba mais <i class="ri-arrow-right-up-line"></i
              ></a>
          </div>
          </div>
          <div class="pg__content">
          <div class="pg__card">
              <div>
              <span>Residência Médica</span>
              </div>
              <a href="#">Saiba mais</a>
          </div>
          <div class="pg__card">
              <div>
              <span>Cursos Rápidos</span>
              </div>
              <a href="#">Saiba mais</a>
          </div>
          <div class="pg__card">
              <div>
              <span>Pós em EAD</span>
              </div>
              <a href="#">Saiba mais</a>
          </div>
          <div class="pg__card">
              <div>
              <span>Cursos</span>
              </div>
              <a href="#">Saiba mais</a>
          </div>
          </div>
      </div>
    </section>

    <section class="section">
        <div class="au__container">
            <div class="au_content">
            <h5 class="title white--color">UNIFSM</h5>
            <p class="au_text">
                <?php echo esc_html(get_field('sobre_nos_resumido', 'option')); ?>
            </p>
            <div class="au__btn">
              <a class="a__yellow" href="#"
                >Saiba mais <i class="ri-arrow-right-up-line"></i
              ></a>
            </div>
            </div>
            <div class="au__img" class="a__yellow">
            <img src="<?php echo get_template_directory_uri(); ?>/src/assets/images/unifsm.png" alt="" />
            </div>
        </div>
    </section>

    <section class="section">
        <div class="c__container">
            <div class="title__container">
                <h5 class="title">Fale Conosco</h5>
            </div>
            <div class="c__content">
                <!-- Contatos Dinâmicos -->
                <div class="c__contacts">
                    <div class="c__contacts__box">
                        <a href="mailto:<?php echo esc_attr(get_field('e-mail', 'option')); ?>">
                            <i class="ri-mail-line"></i> <?php echo esc_html(get_field('e-mail', 'option')); ?>
                        </a>
                        <a href="tel:<?php echo esc_attr(get_field('telefone', 'option')); ?>">
                            <i class="ri-phone-line"></i> <?php echo esc_html(get_field('telefone', 'option')); ?>
                        </a>
                        <a>
                            <i class="ri-map-pin-line"></i> <?php echo esc_html(get_field('endereco', 'option')); ?>
                        </a>
                    </div>
                    
                    <!-- Ícones de Redes Sociais -->
                    <div class="c__contacts__icons">
                        <a href="<?php echo esc_attr(get_field('youtube', 'option')); ?>" target="_blank">
                            <i class="ri-youtube-fill"></i>
                        </a>
                        <a href="<?php echo esc_attr(get_field('instagram', 'option')); ?>" target="_blank">
                            <i class="ri-instagram-fill"></i>
                        </a>
                        <a href="<?php echo esc_attr(get_field('tiktok', 'option')); ?>" target="_blank">
                            <i class="ri-tiktok-line"></i>
                        </a>
                    </div>
                </div>

                <!-- Mapa Dinâmico -->
                <div class="c__map">
                    <iframe src="<?php echo esc_url(get_field('embed_localizacao_google', 'option')); ?>"
                            width="100%"
                            height="100%"
                            style="border: 0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
  $(document).ready(function() {
    var owl = $('.owl-carousel');

    owl.owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
        autoplay: true,
        autoplayTimeout: 3000, // Aumentei para 3 segundos para melhor experiência
        stagePadding: 30,
        responsive: {
            0: {
                items: 1,
                stagePadding: 0,
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            },
            1440: {
                items: 4
            }
        }
    });

    $('.customNextBtn').click(function() {
        owl.trigger('next.owl.carousel');
    });

    $('.customPrevBtn').click(function() {
        owl.trigger('prev.owl.carousel', [300]);
    });
  });
</script>

<!-- Custom -->
    <script src="<?php echo get_template_directory_uri(); ?>/src/assets/js/script.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/src/assets/js/main.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/src/assets/js/tabs.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/src/assets/js/accordion.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/src/assets/js/carousel.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/src/assets/js/slider.js"></script>

<?php get_footer(); ?>
