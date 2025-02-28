<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php bloginfo('name'); ?></title>
        <!-- Bootstrap -->
        <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        />
        <!-- Remix Icon -->
        <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css"
        integrity="sha512-kJlvECunwXftkPwyvHbclArO8wszgBGisiLeuDFwNM8ws+wKIw0sv1os3ClWZOcrEB2eRXULYUsm8OVRGJKwGA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
        />
        <!-- Custom -->
        <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/assets/css/style.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/assets/css/top-nav.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/assets/css/header.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/assets/css/slides.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/assets/css/footer.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/assets/css/b-footer.css">
        <?php wp_head(); ?>
    </head>

    <body>

        <?php get_header(); ?>
        
        

        

        <?php get_footer(); ?>
        <?php wp_footer(); ?>

        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Custom -->
    </body>
</html>
