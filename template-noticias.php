<?php
/**
 * Template Name: Noticias Personalizada
 */
get_header();
?>

<main class="main">
    <!-- Título da Página -->
    <section class="section">
        <div class="title__box">
            <div class="tb__title">
                <h2>Blog UNIFSM</h2>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="news__grid">

                <?php
                // Configura a query para buscar os posts
                $args = array(
                    'post_type'      => 'post', // Busca os posts padrão do WordPress
                    'posts_per_page' => 9, // Número de posts por página
                    'paged'          => get_query_var('paged') ? get_query_var('paged') : 1, // Paginação
                );

                $query = new WP_Query($args);

                // Loop para exibir os posts dinamicamente
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                ?>

                <div class="new__card">
                    <div class="nc__img">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')); ?>" alt="<?php the_title_attribute(); ?>" />
                            <?php else : ?>
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/src/assets/images/default-image.png'); ?>" alt="Imagem Padrão" />
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="nc__content">
                        <h5><?php the_title(); ?></h5>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                        <a class="a__yellow" href="<?php the_permalink(); ?>">
                            Continuar lendo <i class="ri-arrow-right-up-line"></i>
                        </a>
                    </div>
                </div>

                <?php endwhile; ?>

                <!-- Paginação -->
                <div class="pagination">
                    <?php
                    echo paginate_links(array(
                        'total' => $query->max_num_pages,
                        'prev_text' => '← Anterior',
                        'next_text' => 'Próximo →',
                    ));
                    ?>
                </div>

                <?php else : ?>
                    <p>Nenhuma postagem encontrada.</p>
                <?php endif; ?>

                <?php wp_reset_postdata(); ?> <!-- Reseta a query -->
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?>
