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

function minificar_css($file_path) {
    // Caminho real do arquivo no servidor
    $full_path = get_template_directory() . $file_path;

    // Caminho do arquivo minificado
    $minified_path = str_replace('.css', '.min.css', $full_path);

    // Caminho relativo para o navegador carregar o arquivo minificado
    $minified_url = str_replace('.css', '.min.css', $file_path);

    // Se o arquivo minificado já existir e for mais recente que o original, usá-lo
    if (file_exists($minified_path) && filemtime($minified_path) >= filemtime($full_path)) {
        return $minified_url;
    }

    // Minificação do CSS
    if (file_exists($full_path)) {
        $css = file_get_contents($full_path);
        $css = preg_replace('/\s+/', ' ', $css); // Remove espaços extras
        $css = preg_replace('/\/\*.*?\*\//s', '', $css); // Remove comentários
        $css = str_replace([' : ', ' {', '{ ', ' }', '} ', ' ;', '; '], [':', '{', '{', '}', '}', ';', ';'], $css); // Remove espaços desnecessários

        // Salva o arquivo minificado
        file_put_contents($minified_path, $css);

        return $minified_url;
    }

    // Se o arquivo original não existir, retorna o caminho original
    return $file_path;
}

function carregar_css_otimizado() {
    $estilos_comuns = [
        'home-style' => '/src/assets/css/style.css',
        'top-nav' => '/src/assets/css/top-nav.css',
        'header' => '/src/assets/css/header.css',
        'footer' => '/src/assets/css/footer.css',
        'b-footer' => '/src/assets/css/b-footer.css',
    ];

    $estilos_por_pagina = [
        'template-home.php' => [
            'slides' => '/src/assets/css/slides.css',
            'new' => '/src/assets/css/new.css',
            'infos' => '/src/assets/css/infos.css',
            'graduation' => '/src/assets/css/graduation.css',
            'postgraduate' => '/src/assets/css/postgraduate.css',
            'about-us' => '/src/assets/css/about-us.css',
            'contact' => '/src/assets/css/contact.css',
        ],
        'template-cursos.php' => [
            'courses' => '/src/assets/css/courses.css',
            'graduation' => '/src/assets/css/graduation.css',
            'infos' => '/src/assets/css/infos.css',
        ],
        'template-universidade.php' => [
            'university' => '/src/assets/css/university.css',
            'new' => '/src/assets/css/new.css',
            'about-us' => '/src/assets/css/about-us.css',
            'graduation' => '/src/assets/css/graduation.css',
        ],
        'template-cpa.php' => [
            'cpa' => '/src/assets/css/cpa.css',
            'new' => '/src/assets/css/new.css',
            'about-us' => '/src/assets/css/about-us.css',
            'page3' => '/src/assets/css/page3.css',
            'course' => '/src/assets/css/course.css',
        ],
        'template-biblioteca.php' => [
            'biblioteca' => '/src/assets/css/biblioteca.css',
        ],
        'template-reitoria.php' => [
            'reitoria' => '/src/assets/css/reitoria.css',
            'about-us' => '/src/assets/css/about-us.css',
        ],
        'institucional' => [
            'reitoria' => '/src/assets/css/reitoria.css',
            'about-us' => '/src/assets/css/about-us.css',
        ]
    ];

    // Registra estilos comuns (já minificados)
    foreach ($estilos_comuns as $handle => $path) {
        wp_enqueue_style($handle, get_template_directory_uri() . minificar_css($path));
    }

    // Registra estilos específicos por página (já minificados)
    foreach ($estilos_por_pagina as $template => $styles) {
        if (is_page_template($template) || is_singular($template)) {
            foreach ($styles as $handle => $path) {
                wp_enqueue_style($handle, get_template_directory_uri() . minificar_css($path));
            }
        }
    }
}
add_action('wp_enqueue_scripts', 'carregar_css_otimizado');

// configurações de melhoria
function converter_para_webp($file) {
    // Verifica se a extensão do arquivo é suportada
    $extensoes_suportadas = ['jpg', 'jpeg', 'png'];
    $file_type = pathinfo($file['file'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($file_type), $extensoes_suportadas)) {
        return $file; // Se não for uma imagem suportada, retorna sem modificar
    }

    // Obtém o caminho do arquivo original
    $image = new Imagick($file['file']);
    $image->setImageFormat('webp'); // Define o formato para WebP

    // Define qualidade da imagem WebP (padrão: 80)
    $image->setImageCompressionQuality(80);

    // Salva a nova imagem no mesmo diretório, com extensão .webp
    $novo_nome = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $file['file']);
    $image->writeImage($novo_nome);
    $image->destroy();

    // Remove a imagem original após conversão (opcional)
    unlink($file['file']);

    // Atualiza o caminho do arquivo para apontar para o WebP
    $file['file'] = $novo_nome;
    $file['type'] = 'image/webp';

    return $file;
}
add_filter('wp_handle_upload', 'converter_para_webp');

function adicionar_lazy_loading($content) {
    if (!is_admin()) {
        $content = preg_replace('/<img(.*?)src=/', '<img$1loading="lazy" src=', $content);
    }
    return $content;
}
add_filter('the_content', 'adicionar_lazy_loading');


?>
