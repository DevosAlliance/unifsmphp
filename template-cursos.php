<?php
/**
 * Template Name: Cursos
 */
get_header();
?>
    <main class="main">
        <section class="section">
            <div class="title__box">
            <div class="tb__title">
                <h2>CURSOS</h2>
            </div>
            </div>
        </section>
        
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
                <div class="g__carousel">
                    <div class="g__tab__box">
                        <button class="tab__btn active">Presencial</button>
                        <button class="tab__btn">Cursos Digitais</button>
                    </div>
                    <div class="g__content__box">
                        <?php
                        $modalidades = ['Presencial', 'Digital'];

                        foreach ($modalidades as $index => $modalidade) :
                            // Query para buscar cursos conforme a modalidade
                            $args = array(
                                'post_type'      => 'curso',
                                'posts_per_page' => -1,
                                'meta_key'       => 'modalidade',
                                'meta_value'     => $modalidade,
                                'orderby'        => 'title',
                                'order'          => 'ASC',
                            );

                            $query = new WP_Query($args);
                            $cursos = [];

                            // Reorganiza para colocar 'Medicina' no topo
                            if ($query->have_posts()) :
                                while ($query->have_posts()) : $query->the_post();
                                    $curso = array(
                                        'title'      => get_the_title(),
                                        'link'       => get_permalink(),
                                        'tipo'       => get_field('tipo') ?: 'Não informado', // Evita undefined
                                        'semestres'  => get_field('semestres') ?: 'Não informado',
                                        'periodo'    => get_field('periodo') ?: 'Não informado',
                                    );

                                    if ($curso['title'] === 'Medicina') {
                                        array_unshift($cursos, $curso); // Move Medicina para o topo
                                    } else {
                                        $cursos[] = $curso;
                                    }
                                endwhile;
                                wp_reset_postdata();
                            endif;
                        ?>
                        <div class="g__content <?php echo $index === 0 ? 'active' : ''; ?>">
                            <ul class="cards">
                                <?php if (!empty($cursos)) :
                                    foreach ($cursos as $curso) : ?>
                                        <li class="cards__card">
                                            <a href="<?php echo esc_url($curso['link']); ?>">
                                                <div class="cards__i" draggable="false">
                                                    <i class="ri-graduation-cap-fill"></i>
                                                    <h5><?php echo esc_html($curso['title']); ?></h5>
                                                </div>
                                                <div class="cards_content">
                                                    <p><?php echo esc_html($curso['tipo']); ?></p>
                                                    <p><?php echo esc_html($curso['semestres']); ?></p>
                                                    <p><?php echo esc_html($curso['periodo']); ?></p>
                                                </div>
                                                <div class="cards__link">
                                                    <a href="<?php echo esc_url($curso['link']); ?>"><i class="ri-add-line"></i> Saiba mais</a>
                                                </div>
                                            </a>
                                        </li>
                                    <?php endforeach;
                                else : ?>
                                    <li class="cards__card">Nenhum curso encontrado.</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>



        <section class="section">
            <div class="div__container i_cta">
            <img src="<?php echo get_template_directory_uri(); ?>/src/assets/images/cta.png" alt="" />
            </div>
            <div class="div__container i__presentation">
            <div class="i__presentation__img">
                <!--<img src="<?php echo get_template_directory_uri(); ?>/src/assets/images/img-teste.png" alt="" />-->
                <iframe width="100%" class="video__presentation" src="https://www.youtube.com/embed/WikgGoMZm7w" title="VESTIBULAR DE MEDICINA 2024.2" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div class="i__presentation__content">
                <h5>Estude na UNIFSM</h5>
                <p>
                <?php echo esc_html(get_field('sobre_nos_resumido', 'option')); ?>
                </p>
            </div>
            </div>
        </section>
    </main>


    <!-- Custom -->
    <script src="<?php echo get_template_directory_uri(); ?>/src/assets/js/main.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/src/assets/js/tabs.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/src/assets/js/accordion.js"></script>
<?php get_footer(); ?>
