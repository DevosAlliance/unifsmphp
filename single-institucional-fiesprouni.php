<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        // Obtendo os campos personalizados
        $sobre = get_field('sobre');
        $existe_setor = get_field('existe_setor');
        $setores = get_field('setor'); // Repetidor de setores
        $existe_anexo = get_field('existe_anexo');
        $anexos = get_field('documentos'); // Repetidor de documentos
        $links  = get_field('links');
?>


        <style>
            /* Acordeão para fies prouni */

            .accordion {
                width: 100%;
                max-width: 600px;
                background: #fff;
                border-radius: 10px;
                box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }

            .accordion-item {
                border-bottom: 1px solid #ddd;
            }

            .accordion-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 15px;
                background: #003366;
                color: #fff;
                cursor: pointer;
                font-weight: bold;
                transition: background 0.3s ease;
            }

            .accordion-header:hover {
                background: #002855;
            }

            .accordion-header i {
                transition: transform 0.3s ease;
            }

            .accordion-content {
                display: none;
                padding: 15px;
                background: #f9f9f9;
                font-size: 14px;
                line-height: 1.6;
            }

            .accordion-content a {
                color: #003366;
                font-weight: bold;
                text-decoration: none;
            }

            .accordion-content a:hover {
                text-decoration: underline;
            }

            .active .accordion-content {
                display: block;
            }

            .active .accordion-header i {
                transform: rotate(180deg);
            }
        </style>

        <main class="main">
            <!-- Seção de Sobre -->
            <section class="section">
                <div class="title__box">
                    <div class="tb__title">
                        <h2 class="text-center text-2xl font-bold"><?php the_title(); ?></h2>
                    </div>
                </div>
            </section>

            <section class="section">
                <div class="container">
                    <div class="spacing">
                        <div class="text-center text-gray-600">
                            <?php echo wpautop(wp_kses_post(get_field('sobre') ?: "Nenhuma informação disponível.")); ?>
                        </div>

                    </div>
                </div>
            </section>

            <!-- Seção de Setores -->
            <?php if ($existe_setor === 'Sim' && !empty($setores)) : ?>
                <section class="section">
                    <div class="container">
                        <?php foreach ($setores as $setor) : ?>
                            <h2 class="text-center text-xl font-semibold mt-8 titulo-setor"><?php echo esc_html($setor['nome_do_setor']); ?></h2>
                            <div class="cards__img">
                                <?php
                                $count = 0;
                                foreach ($setor['pessoa'] as $pessoa) :
                                    $count++;
                                ?>
                                    <div>
                                        <img alt="<?php echo esc_attr($pessoa['nome']); ?>"
                                            src="<?php echo esc_url(!empty($pessoa['foto']) ? $pessoa['foto']['url'] : get_template_directory_uri() . '/src/assets/images/FOTOSINFORMATIVAS.jpeg'); ?>" loading="lazy" />
                                        <p><?php echo esc_html($pessoa['nome']); ?></p>
                                        <span><?php echo esc_html($pessoa['cargo']); ?></span>
                                        <?php if (!empty($pessoa['e-mail'])) : ?>
                                            <span><?php echo esc_html($pessoa['e-mail']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ($count % 3 == 0) echo '<span style="width: 100%;"></span>'; // Quebra a linha a cada 3 pessoas 
                                    ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Seção de Documentos e Links -->
            <?php if (!empty($anexos) || !empty($links)) : ?>
                <section class="section documentos-section">
                    <div class="container">
                        <div class="documentos-container">
                            <!-- Documentos (Anexos) -->
                            <?php if (!empty($anexos)) : ?>
                            <div class="documentos-grupo">
                                <h3 class="documentos-grupo-titulo">Documentos</h3>
                                <div class="documentos-grid">
                                    <?php foreach ($anexos as $anexo) : ?>
                                        <?php if (!empty($anexo['arquivo']['url']) && !empty($anexo['nome'])) : ?>
                                            <a class="documento-item" href="<?php echo esc_url($anexo['arquivo']['url']); ?>" target="_blank">
                                                <span class="documento-icone">📄</span>
                                                <span class="documento-nome"><?php echo esc_html($anexo['nome']); ?></span>
                                            </a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <!-- Links Externos -->
                            <?php if (!empty($links)) : ?>
                            <div class="documentos-grupo">
                                <h3 class="documentos-grupo-titulo">Links</h3>
                                <div class="documentos-grid">
                                    <?php foreach ($links as $link) : ?>
                                        <?php if (!empty($link['link']) && !empty($link['nome'])) : ?>
                                            <a class="documento-item link-item" href="<?php echo esc_url($link['link']); ?>" target="_blank">
                                                <span class="documento-icone">🔗</span>
                                                <span class="documento-nome"><?php echo esc_html($link['nome']); ?></span>
                                            </a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <section class="section">
                <div class="container">
                    <h5 class="spacing accordion__title">Dúvidas e Perguntas Frequentes</h5>
                    <div class="accordion">
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <span>O que é o FIES?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="accordion-content">
                                <p>O Fundo de Financiamento Estudantil (FIES) é um programa do MEC que oferece financiamento para estudantes matriculados em instituições de ensino superior privadas.</p>
                                <p>O ingresso é feito exclusivamente através da nota do ENEM a partir de 2010.</p>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-header">
                                <span>Quem pode ingressar com o FIES?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="accordion-content">
                                <p>O candidato precisa ter participado do ENEM a partir de 2010, obtendo pelo menos 450 pontos na média das provas e nota acima de zero na redação.</p>
                                <p>As inscrições são feitas através do <a href="https://acessounico.mec.gov.br/fies" target="_blank">Portal Único de Acesso ao Ensino Superior</a>.</p>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-header">
                                <span>O que é PROUNI?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="accordion-content">
                                <p>O Programa Universidade Para Todos (Prouni) oferece bolsas integrais e parciais para estudantes sem diploma de nível superior em instituições privadas de ensino superior.</p>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-header">
                                <span>Como se inscrever no PROUNI?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="accordion-content">
                                <p>As inscrições devem ser feitas através do <a href="https://acessounico.mec.gov.br/prouni" target="_blank">Portal Único de Acesso ao Ensino Superior</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const accordionItems = document.querySelectorAll(".accordion-item");

                    accordionItems.forEach((item) => {
                        const header = item.querySelector(".accordion-header");

                        header.addEventListener("click", function() {
                            // Fecha todos os outros itens antes de abrir o atual
                            accordionItems.forEach((otherItem) => {
                                if (otherItem !== item) {
                                    otherItem.classList.remove("active");
                                    otherItem.querySelector(".accordion-content").style.display = "none";
                                }
                            });

                            // Alterna o estado do item clicado
                            if (item.classList.contains("active")) {
                                item.classList.remove("active");
                                item.querySelector(".accordion-content").style.display = "none";
                            } else {
                                item.classList.add("active");
                                item.querySelector(".accordion-content").style.display = "block";
                            }
                        });
                    });
                });
            </script>

        </main>

<?php
    endwhile;
endif;

get_footer();
?>
