<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>
        <!-- Remix Icon -->
        <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css"
        integrity="sha512-kJlvECunwXftkPwyvHbclArO8wszgBGisiLeuDFwNM8ws+wKIw0sv1os3ClWZOcrEB2eRXULYUsm8OVRGJKwGA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
        />
        <?php wp_head(); ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/assets/css/style.css" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/assets/css/top-nav.css" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/assets/css/header.css" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/assets/css/footer.css" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/assets/css/b-footer.css" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/assets/css/new.css" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/assets/css/news.css" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/assets/css/courses.css" />

        <!-- Meta SEO -->
        <meta name="description" content="<?php bloginfo('description'); ?>">
        <meta name="description" content="A Faculdade Santa Maria (FSM) é referência em ensino superior no Sertão Paraibano, oferecendo cursos de graduação e pós-graduação em Saúde, Humanas e Ciências Sociais.">
        <meta name="keywords" content="Faculdade Santa Maria, FSM, Cajazeiras, ensino superior, cursos de graduação, pós-graduação, faculdade na Paraíba">
        <meta name="author" content="Devos Tecnologia">
        <meta name="robots" content="index, follow">

        <!-- JSON-LD  -->
        <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "CollegeOrUniversity",
        "name": "Faculdade Santa Maria",
        "url": "https://unifsm.edu.br/",
        "logo": "https://unifsm.edu.br/wp-content/uploads/2023/01/logounifsm2.png",
        "sameAs": [
            "https://www.youtube.com/@UNIFSMOFICIAL",
            "https://www.instagram.com/unifsmoficial/",
            "https://www.tiktok.com/@unifsmoficial"
        ],
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "BR 230 Km 504",
            "addressLocality": "Cajazeiras",
            "addressRegion": "PB",
            "postalCode": "58900-000",
            "addressCountry": "BR"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+55-83-3531-1346",
            "email": "marketing@unifsm.edu.br",
            "contactType": "customer service"
        }
        }
        </script>
    </head>

    <style>
        /* Modal de Busca */
        .search-modal {
            display: none;
            position: fixed;
            top: 70px;
            right: 10rem;
            width: 25rem;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            border-radius: 5px;
            z-index: 99999;
            overflow: hidden;
        }

        .search-modal .modal-content {
            padding: 15px;
            color: #333;
        }

        .search-modal ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .search-modal li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .search-modal li a {
            color: #007BFF;
            text-decoration: none;
            display: block;
        }

        .search-modal li a:hover {
            background-color: #f1f1f1;
        }

        .close-modal {
            float: right;
            cursor: pointer;
            color: red;
            font-size: 18px;
        }
    </style>

    <body>
        <header class="header">
            <div class="top__nav">
                <div class="tn_info">
                <div class="tn_icons">
                    <a href="<?php echo esc_url(get_field('youtube', 'option')); ?>"><i class="ri-youtube-fill"></i></a>
                    <a href="<?php echo esc_url(get_field('instagram', 'option')); ?>"><i class="ri-instagram-fill"></i></a>
                    <a href="<?php echo esc_url(get_field('tiktok', 'option')); ?>"><i class="ri-tiktok-line"></i></a>
                    <a href="tel:<?php echo esc_attr(get_field('telefone', 'option')); ?>"><i class="ri-phone-fill tel"></i></a>
                </div>
                <div class="hr"></div>
                <div class="tn_tel"><?php echo esc_html(get_field('telefone', 'option')); ?></div>
                </div>
                <div class="tn_right">
                    <div class="dropdown">
                        <button class="dropbtn">
                        Sou UNIFSM <i class="ri-arrow-drop-down-line"></i>
                        </button>
                        <ul class="tn_links">
                        <li><a href="https://unifsm.rm.cloudtotvs.com.br/FrameHTML/Web/App/Edu/PortalEducacional/login/">Portal do Aluno</a></li>
                        <li><a href="https://unifsm.online/login/index.php?loginredirect=1">Portal do Aluno EAD</a></li>
                        <li><a href="https://unifsm.rm.cloudtotvs.com.br/FrameHTML/Web/App/Edu/PortalDoProfessor/#/login">Portal do Professor</a></li>
                        </ul>
                    </div>
                    <div class="tn_search">
                        <input type="text" placeholder="Pesquisar..." />
                        <div class="search_btn">
                        <i class="ri-search-line"></i>
                        </div>
                        <div class="cancel_btn">
                        <i class="ri-close-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal de Resultados -->
            <div class="search-modal" id="searchModal">
                <div class="modal-content">
                    <span class="close-modal" id="closeModal">&times;</span>
                    <ul id="searchResults"></ul>
                </div>
            </div>

            <nav class="nav">
                <div class="nav__data">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="nav__logo">
                        <img src="<?php echo get_template_directory_uri(); ?>/src/assets/images/logo.png" alt="Logo" />
                    </a>
                    <div class="nav__menu" id="nav-menu">
                        <ul class="nav__list">
                            <?php
                            // Obtém os itens do menu da página de opções
                            $menu_items = get_field('item', 'option');

                            if ($menu_items && is_array($menu_items)) {
                                $menu_count = count($menu_items);
                                $mid = ceil($menu_count / 2);
                                $count = 0;

                                foreach ($menu_items as $item) {
                                    $count++;
                                    $item_menu = $item['item_menu'];
                                    $itens = $item['itens'];
                                    $total_itens = count($itens);

                                    echo '<li class="dropdown__item">';

                                    // Se houver apenas um item, transforma o título em link direto
                                    if ($total_itens === 1) {
                                        $single_item = $itens[0];
                                        echo '<div class="nav__link">';
                                        echo '<a href="' . esc_url($single_item['link']) . '">' . esc_html($item_menu) . '</a>';
                                        echo '</div>';
                                    } else {
                                        // Se houver mais de um item, cria dropdown
                                        echo '<div class="nav__link">';
                                        echo esc_html($item_menu);
                                        echo ' <i class="ri-arrow-drop-down-line dropdown__arrow"></i>';
                                        echo '</div>';

                                        // Renderiza os submenus
                                        echo '<ul class="dropdown__menu">';
                                        $submenu_groups = [];
                                        foreach ($itens as $item_sub) {
                                            $submenu_groups[$item_sub['nome']][] = $item_sub;
                                        }

                                        foreach ($submenu_groups as $nome => $links) {
                                            if (count($links) > 1) {
                                                // Submenu com múltiplos itens
                                                echo '<li class="dropdown__subitem">';
                                                echo '<div class="dropdown__link">' . esc_html($nome) . ' <i class="ri-add-line dropdown__add"></i></div>';
                                                echo '<ul class="dropdown__submenu">';
                                                foreach ($links as $link) {
                                                    echo '<li><a href="' . esc_url($link['link']) . '" class="dropdown__sublink">' . esc_html($link['tipo']) . '</a></li>';
                                                }
                                                echo '</ul></li>';
                                            } else {
                                                // Submenu simples com um único link
                                                foreach ($links as $link) {
                                                    echo '<li><a href="' . esc_url($link['link']) . '" class="dropdown__link">' . esc_html($link['nome']) . '</a></li>';
                                                }
                                            }
                                        }
                                        echo '</ul>';
                                    }

                                    echo '</li>';

                                    // Adiciona a logo secundária no meio do menu
                                    if ($count == $mid) {
                                        echo '<a href="' . esc_url(home_url('/')) . '" class="nav__logo2">';
                                        echo '<img src="' . get_template_directory_uri() . '/src/assets/images/logo.png" alt="Logo">';
                                        echo '</a>';
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="nav__toggle" id="nav-toggle">
                        <i class="ri-menu-line nav__burguer"></i>
                        <i class="ri-close-line nav__close"></i>
                    </div>
                </div>
            </nav>


        </header>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('.tn_search input');
    const modal = document.getElementById('searchModal');
    const resultsContainer = document.getElementById('searchResults');
    const closeModal = document.getElementById('closeModal');

    // Função de busca em tempo real
    searchInput.addEventListener('input', function () {
        const query = searchInput.value;
        if (query.length >= 2) {
            fetch(`${window.location.origin}/wp-admin/admin-ajax.php?action=search_courses&query=${query}`)
                .then(response => response.json())
                .then(data => {
                    resultsContainer.innerHTML = '';
                    if (data.length > 0) {
                        modal.style.display = 'block';
                        data.forEach(course => {
                            const li = document.createElement('li');
                            li.innerHTML = `<a href="${course.link}">${course.title}</a>`;
                            resultsContainer.appendChild(li);
                        });
                    } else {
                        modal.style.display = 'block';
                        resultsContainer.innerHTML = '<li>Nenhum curso encontrado</li>';
                    }
                });
        } else {
            modal.style.display = 'none';
        }
    });

    // Fechar modal ao clicar no X
    closeModal.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    // Fechar modal ao clicar fora
    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
</script>



