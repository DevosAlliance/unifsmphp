

        <?php get_header();
        ?>


        <main class="main">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    echo '<h2><a href="'. get_permalink() .'">'. get_the_title() .'</a></h2>';
                    the_excerpt();
                endwhile;
            else :
                echo '<p>Nenhum conteúdo encontrado.</p>';
            endif;
            ?>
        </main>

        

        <?php get_footer(); ?>
