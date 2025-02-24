<?php
get_header();
?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/assets/css/new.css" />


<main class="main">
    <!-- Título da Notícia -->
    <section class="section">
        <div class="title__box">
            <div class="tb__title">
                <h2><?php the_title(); ?></h2> <!-- Exibe o título do post dinamicamente -->
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <!-- Botões de Compartilhamento -->
            <div class="share__btns">
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">
                    <i class="ri-arrow-left-circle-line"></i> Voltar
                </a>
                <div>
                    <h6>Compartilhe:</h6>
                    <a href="https://api.whatsapp.com/send?text=<?php echo urlencode(get_the_title() . ' ' . get_permalink()); ?>"
                        rel="nofollow" target="_blank" class="whatsapp-share-button">
                        <i class="ri-whatsapp-line"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()); ?>&url=<?php echo urlencode(get_permalink()); ?>"
                        rel="nofollow" target="_blank" class="twitter-share-button">
                        <i class="ri-twitter-line"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
                        rel="nofollow" target="_blank" class="facebook-share-button">
                        <i class="ri-facebook-line"></i>
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>"
                        rel="nofollow" target="_blank" class="linkedin-share-button">
                        <i class="ri-linkedin-line"></i>
                    </a>
                </div>
            </div>

            <!-- Imagem Destacada -->
            <?php if (has_post_thumbnail()) : ?>
                <div class="n__img">
                    <img src="<?php echo get_the_post_thumbnail_url(null, 'full'); ?>" alt="<?php the_title(); ?>" />
                </div>
            <?php endif; ?>

            <!-- Conteúdo da Notícia -->
            <div class="n__text">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?> <!-- Exibe o conteúdo do post -->
                <?php endwhile; endif; ?>
            </div>
        </div>
    </section>
</main>

<script src="<?php echo get_template_directory_uri(); ?>/src/assets/js/share.js"></script>
<?php get_footer(); ?>
