<?php

// Ativar suporte a menus
function meu_tema_setup() {
    register_nav_menus(array(
        'menu-principal' => __('Menu Principal', 'meu-tema')
    ));
}

add_action('after_setup_theme', 'meu_tema_setup');

// Carregar scripts e estilos
function meu_tema_scripts() {
    wp_enqueue_style('style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'meu_tema_scripts');


if (is_user_logged_in()) {
    show_admin_bar(true);
}

function definir_pagina_home_como_padrao($query) {
    if ($query->is_home() && $query->is_main_query()) {
        $query->set('post_type', 'post');
    }
}
add_action('pre_get_posts', 'definir_pagina_home_como_padrao');

// Suporte a imagens destacadas
add_theme_support('post-thumbnails');

add_theme_support('post-thumbnails', array('post'));

// Função AJAX para buscar cursos em tempo real
add_action('wp_ajax_search_courses', 'search_courses_callback');
add_action('wp_ajax_nopriv_search_courses', 'search_courses_callback');

function search_courses_callback() {
    $query = sanitize_text_field($_GET['query']);

    $args = array(
        'post_type'      => 'curso',
        'posts_per_page' => 5,
        's'              => $query,
    );

    $cursos = new WP_Query($args);

    $resultados = [];

    if ($cursos->have_posts()) {
        while ($cursos->have_posts()) {
            $cursos->the_post();
            $resultados[] = [
                'title' => get_the_title(),
                'link'  => get_permalink(),
            ];
        }
        wp_reset_postdata();
    }

    wp_send_json($resultados);
}


add_action('wp_ajax_send_lead_email', 'send_lead_email');
add_action('wp_ajax_nopriv_send_lead_email', 'send_lead_email');

function send_lead_email() {
    // **Recebe os dados via POST**
    $firstname = sanitize_text_field($_POST['firstname']);
    $lastname = sanitize_text_field($_POST['lastname']);
    $email = sanitize_email($_POST['email']);
    $tel = sanitize_text_field($_POST['tel']);
    $course_name = sanitize_text_field($_POST['course_name']);
    $agree = sanitize_text_field($_POST['agree']);

    // **Validação**
    if (empty($firstname) || empty($lastname) || empty($email) || empty($tel) || empty($course_name) || $agree !== 'Sim') {
        wp_send_json(['success' => false, 'message' => '⚠️ Todos os campos são obrigatórios.']);
    }

    // **E-mail do administrador**
    $admin_email = get_option('admin_email');

    // **Montar corpo do e-mail**
    $subject = 'Novo Lead Capturado - Investimento';
    $message = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; }
                .lead-info { margin: 10px 0; }
                .lead-info strong { color: #333; }
            </style>
        </head>
        <body>
            <h2>📩 Novo Lead Capturado!</h2>
            <div class='lead-info'><strong>Curso:</strong> {$course_name}</div>
            <div class='lead-info'><strong>Nome:</strong> {$firstname} {$lastname}</div>
            <div class='lead-info'><strong>E-mail:</strong> {$email}</div>
            <div class='lead-info'><strong>Telefone:</strong> {$tel}</div>
            <div class='lead-info'><strong>Consentimento:</strong> {$agree}</div>
            <hr />
            <p>⚠️ Este e-mail foi gerado automaticamente pelo formulário de investimento do site.</p>
        </body>
        </html>
    ";

    // **Cabeçalhos para e-mail HTML**
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: Site UNIFSM <' . $admin_email . '>'
    );

    // **Envia o e-mail**
    if (wp_mail($admin_email, $subject, $message, $headers)) {
        wp_send_json(['success' => true, 'message' => '✅ Lead enviado com sucesso!']);
    } else {
        wp_send_json(['success' => false, 'message' => '❌ Erro ao enviar o e-mail.']);
    }
}




// css home

function carregar_css_home_personalizada() {
    if (is_page_template('template-home.php')) { 
        wp_enqueue_style('owl.carousel2.min', get_template_directory_uri() . '/node_modules/owl.carousel/dist/assets/owl.carousel.min.css');
        wp_enqueue_style('owl.carousel.min', get_template_directory_uri() . '/bower_components/owl.carousel/dist/assets/owl.carousel.min.css');
        wp_enqueue_style('home-style', get_template_directory_uri() . '/src/assets/css/style.css');
        wp_enqueue_style('top-nav', get_template_directory_uri() . '/src/assets/css/top-nav.css');
        wp_enqueue_style('header', get_template_directory_uri() . '/src/assets/css/header.css');
        wp_enqueue_style('slides', get_template_directory_uri() . '/src/assets/css/slides.css');
        wp_enqueue_style('footer', get_template_directory_uri() . '/src/assets/css/footer.css');
        wp_enqueue_style('b-footer', get_template_directory_uri() . '/src/assets/css/b-footer.css');
        wp_enqueue_style('new', get_template_directory_uri() . '/src/assets/css/new.css');
        wp_enqueue_style('infos', get_template_directory_uri() . '/src/assets/css/infos.css');
        wp_enqueue_style('graduation', get_template_directory_uri() . '/src/assets/css/graduation.css');
        wp_enqueue_style('postgraduate', get_template_directory_uri() . '/src/assets/css/postgraduate.css');
        wp_enqueue_style('about-us', get_template_directory_uri() . '/src/assets/css/about-us.css');
        wp_enqueue_style('contact', get_template_directory_uri() . '/src/assets/css/contact.css');
    }
}
add_action('wp_enqueue_scripts', 'carregar_css_home_personalizada');

// css single curso
function carregar_css_single_curso() {
    if (is_singular('curso')) { 
        wp_enqueue_style('home-style', get_template_directory_uri() . '/src/assets/css/style.css');
        wp_enqueue_style('top-nav', get_template_directory_uri() . '/src/assets/css/top-nav.css');
        wp_enqueue_style('header', get_template_directory_uri() . '/src/assets/css/header.css');
        wp_enqueue_style('footer', get_template_directory_uri() . '/src/assets/css/footer.css');
        wp_enqueue_style('b-footer', get_template_directory_uri() . '/src/assets/css/b-footer.css');
        wp_enqueue_style('courses', get_template_directory_uri() . '/src/assets/css/courses.css');
        wp_enqueue_style('infos', get_template_directory_uri() . '/src/assets/css/infos.css');
        wp_enqueue_style('course', get_template_directory_uri() . '/src/assets/css/course.css');
        wp_enqueue_style('modal', get_template_directory_uri() . '/src/assets/css/modal.css');
        wp_enqueue_style('new', get_template_directory_uri() . '/src/assets/css/new.css');
    }
}
add_action('wp_enqueue_scripts', 'carregar_css_single_curso');

function carregar_css_cursos() {
    if (is_page_template('template-cursos.php')) {
        wp_enqueue_style('home-style', get_template_directory_uri() . '/src/assets/css/style.css');
        wp_enqueue_style('top-nav', get_template_directory_uri() . '/src/assets/css/top-nav.css');
        wp_enqueue_style('header', get_template_directory_uri() . '/src/assets/css/header.css');
        wp_enqueue_style('footer', get_template_directory_uri() . '/src/assets/css/footer.css');
        wp_enqueue_style('b-footer', get_template_directory_uri() . '/src/assets/css/b-footer.css');
        wp_enqueue_style('infos', get_template_directory_uri() . '/src/assets/css/infos.css');
        wp_enqueue_style('graduation', get_template_directory_uri() . '/src/assets/css/graduation.css');
        wp_enqueue_style('courses', get_template_directory_uri() . '/src/assets/css/courses.css');
    }
}
add_action('wp_enqueue_scripts', 'carregar_css_cursos');

function carregar_css_noticia() {
    if (is_single()) { 
        wp_enqueue_style('home-style', get_template_directory_uri() . '/src/assets/css/style.css');
        wp_enqueue_style('top-nav', get_template_directory_uri() . '/src/assets/css/top-nav.css');
        wp_enqueue_style('header', get_template_directory_uri() . '/src/assets/css/header.css');
        wp_enqueue_style('footer', get_template_directory_uri() . '/src/assets/css/footer.css');
        wp_enqueue_style('b-footer', get_template_directory_uri() . '/src/assets/css/b-footer.css');
        wp_enqueue_style('infos', get_template_directory_uri() . '/src/assets/css/infos.css');
        wp_enqueue_style('graduation', get_template_directory_uri() . '/src/assets/css/graduation.css');
        wp_enqueue_style('courses', get_template_directory_uri() . '/src/assets/css/courses.css');
    }
}
add_action('wp_enqueue_scripts', 'carregar_css_noticia');


function definir_template_para_pagina_de_posts($template) {
    if (is_home()) { // Verifica se é a página de posts (Notícias)
        $pagina_posts = get_option('page_for_posts'); // Obtém o ID da página de posts
        if ($pagina_posts) {
            $novo_template = locate_template('template-noticias.php'); // Nome do seu template
            if ($novo_template) {
                return $novo_template; // Retorna o template personalizado
            }
        }
    }
    return $template;
}
add_filter('template_include', 'definir_template_para_pagina_de_posts');

function carregar_css_universidade() {
    if (is_page_template('template-universidade.php')) {
        wp_enqueue_style('home-style', get_template_directory_uri() . '/src/assets/css/style.css');
        wp_enqueue_style('top-nav', get_template_directory_uri() . '/src/assets/css/top-nav.css');
        wp_enqueue_style('header', get_template_directory_uri() . '/src/assets/css/header.css');
        wp_enqueue_style('footer', get_template_directory_uri() . '/src/assets/css/footer.css');
        wp_enqueue_style('b-footer', get_template_directory_uri() . '/src/assets/css/b-footer.css');
        wp_enqueue_style('new', get_template_directory_uri() . '/src/assets/css/new.css');
        wp_enqueue_style('about-us', get_template_directory_uri() . '/src/assets/css/about-us.css');
        wp_enqueue_style('graduation', get_template_directory_uri() . '/src/assets/css/graduation.css');
        wp_enqueue_style('university', get_template_directory_uri() . '/src/assets/css/university.css');
    }
}
add_action('wp_enqueue_scripts', 'carregar_css_universidade');

function carregar_css_cpa() {
    if (is_page_template('template-cpa.php')) {
        wp_enqueue_style('home-style', get_template_directory_uri() . '/src/assets/css/style.css');
        wp_enqueue_style('top-nav', get_template_directory_uri() . '/src/assets/css/top-nav.css');
        wp_enqueue_style('header', get_template_directory_uri() . '/src/assets/css/header.css');
        wp_enqueue_style('footer', get_template_directory_uri() . '/src/assets/css/footer.css');
        wp_enqueue_style('b-footer', get_template_directory_uri() . '/src/assets/css/b-footer.css');
        wp_enqueue_style('new', get_template_directory_uri() . '/src/assets/css/new.css');
        wp_enqueue_style('about-us', get_template_directory_uri() . '/src/assets/css/about-us.css');
        wp_enqueue_style('cpa', get_template_directory_uri() . '/src/assets/css/cpa.css');
        wp_enqueue_style('page3', get_template_directory_uri() . '/src/assets/css/page3.css');
        wp_enqueue_style('course', get_template_directory_uri() . '/src/assets/css/course.css');
    }
}
add_action('wp_enqueue_scripts', 'carregar_css_cpa');

function carregar_css_biblioteca() {
    if (is_page_template('template-biblioteca.php')) {
        wp_enqueue_style('home-style', get_template_directory_uri() . '/src/assets/css/style.css');
        wp_enqueue_style('top-nav', get_template_directory_uri() . '/src/assets/css/top-nav.css');
        wp_enqueue_style('header', get_template_directory_uri() . '/src/assets/css/header.css');
        wp_enqueue_style('footer', get_template_directory_uri() . '/src/assets/css/footer.css');
        wp_enqueue_style('b-footer', get_template_directory_uri() . '/src/assets/css/b-footer.css');
        wp_enqueue_style('biblioteca', get_template_directory_uri() . '/src/assets/css/biblioteca.css');
    }
}
add_action('wp_enqueue_scripts', 'carregar_css_biblioteca');


function carregar_css_reitoria() {
    if (is_page_template('template-reitoria.php')) {
        wp_enqueue_style('home-style', get_template_directory_uri() . '/src/assets/css/style.css');
        wp_enqueue_style('top-nav', get_template_directory_uri() . '/src/assets/css/top-nav.css');
        wp_enqueue_style('header', get_template_directory_uri() . '/src/assets/css/header.css');
        wp_enqueue_style('footer', get_template_directory_uri() . '/src/assets/css/footer.css');
        wp_enqueue_style('b-footer', get_template_directory_uri() . '/src/assets/css/b-footer.css');
        wp_enqueue_style('about-us', get_template_directory_uri() . '/src/assets/css/about-us.css');
        wp_enqueue_style('page3', get_template_directory_uri() . '/src/assets/css/page3.css');
    }
}
add_action('wp_enqueue_scripts', 'carregar_css_reitoria');

?>
