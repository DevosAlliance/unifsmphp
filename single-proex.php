<?php
get_header();

if (have_posts()):
    while (have_posts()):
        the_post();
        // Obtendo os campos personalizados
        $sobre = get_field('sobre');
        $existe_setor = get_field('existe_setor');
        $setores = get_field('setor');
        $links = get_field('links');
        $pesquisas = get_field('pesquisa');
        $extensoes = get_field('extensao');
        $texto_curricularizacao = get_field('texto_curricularizacao_da_extensao');
        $texto_eventos = get_field('texto_eventos_academicos');
        $eventos = get_field('setor_copiar');
        $texto_internacionalizacao = get_field('internacionalizacao_texto_sobre');
        $parceiros = get_field('parceiros');
        $formularios = get_field('formularios');
        $texto_ligas = get_field('texto_ligas_e_atleticas');
        $ligas = get_field('ligas');
        $publicacoes = get_field('publicacoes');
        $documentos_agrupados = [];

        if (have_rows('documentos')):
            while (have_rows('documentos')):
                the_row();
                if (have_rows('classe')):
                    while (have_rows('classe')):
                        the_row();
                        $tipo = get_sub_field('tipo');
                        $dados = get_sub_field('dados');

                        if (!empty($tipo) && !empty($dados)):
                            foreach ($dados as $doc) {
                                $documentos_agrupados[$tipo][] = $doc;
                            }
                        endif;

                    endwhile;
                endif;
            endwhile;
        endif;
        ?>

        <style>
            /* Ajustes adicionais para seus estilos existentes */
            .documentos-wrapper {
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
                justify-content: center;
                margin-bottom: 2rem;
            }

            .btn-categoria {
                width: 200px;
                background-color: #fff;
                border: 1px solid var(--yellow);
                display: flex;
                align-items: center;
                padding: 1rem;
                gap: 0.5rem;
                border-radius: 20px;
                color: var(--black);
                font-size: var(--size-normal);
                font-weight: 400;
                cursor: pointer;
                transition: background-color .3s;
            }

            .btn-categoria:hover {
                background-color: var(--yellow);
            }

            .btn-categoria i {
                color: var(--yellow);
                font-size: var(--size-i);
            }

            .btn-categoria:hover i {
                color: var(--black);
            }

            .hours {
                margin: 1rem 0;
                gap: 1rem;
            }

            .hours__container {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-wrap: wrap;
                gap: 1rem;
            }

            .hours__card {
                width: 180px;
                padding: 1rem;
                background-color: #fff;
                box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 0.5rem;
            }

            .hours__card h6 {
                font-size: var(--size-text);
                font-weight: 500;
            }

            .hours__card p {
                font-size: var(--size-normal);
                font-weight: 300;
                text-align: center;
            }

            .link_lattes {
                font-size: 0.875rem;
                font-weight: 300;
                color: var(--black);

                display: flex;
                justify-content: center;
                align-items: center;
                gap: 3px;
            }

            /* Estilos para a modal mais larga com 3 colunas */
            .modal {
                display: none;
                position: fixed;
                z-index: 100001;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.5);
            }

            .modal-content {
                background-color: #fff;
                padding: 1.5rem;
                border-radius: 8px;
                width: 90%;
                max-width: 1200px;
                /* Modal mais larga */
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                max-height: 80vh;
                overflow-y: auto;

                /* Centralizar na visualização do usuário */
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            .modal-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #e2e8f0;
                padding-bottom: 1rem;
                margin-bottom: 1.5rem;
            }

            .modal-header h2 {
                margin: 0;
                font-size: 1.25rem;
                font-weight: bold;
                color: #2d3748;
            }

            .modal-close {
                color: #a0aec0;
                font-size: 28px;
                font-weight: bold;
                cursor: pointer;
                line-height: 1;
            }

            .modal-close:hover {
                color: #4a5568;
            }

            /* Layout de 3 colunas para a modal */
            .modal-body {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 1rem;
            }

            /* Estilo para os itens de documento dentro da modal */
            .modal-documento-item {
                display: flex;
                align-items: center;
                background-color: #fff;
                border: 1px solid var(--yellow);
                color: black;
                padding: 12px 15px;
                border-radius: 8px;
                text-decoration: none;
                font-weight: 500;
                transition: background-color 0.3s;
                margin-bottom: 0.5rem;
                width: 100%;
                box-sizing: border-box;
                justify-content: flex-start;
                text-align: left;
                font-size: 0.9rem;
                line-height: 1.3;
            }

            .modal-documento-item:hover {
                background-color: var(--yellow);
            }

            .modal-documento-item::before {
                content: "";
                display: inline-block;
                width: 20px;
                height: 20px;
                margin-right: 10px;
                background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>');
                background-repeat: no-repeat;
                background-position: center;
                flex-shrink: 0;
                stroke: black;
            }

            /* Responsividade */
            @media screen and (max-width: 992px) {
                .modal-body {
                    grid-template-columns: repeat(2, 1fr);
                    /* 2 colunas em tablets */
                }
            }

            @media screen and (max-width: 768px) {
                .modal-content {
                    width: 95%;
                    max-width: 95%;
                    padding: 1rem;
                    max-height: 80vh;
                }

                .modal-body {
                    grid-template-columns: 1fr;
                    /* 1 coluna em dispositivos móveis */
                    gap: 0.5rem;
                }

                .modal-header h2 {
                    font-size: 1.1rem;
                }

                .modal-close {
                    font-size: 24px;
                }

                .modal-documento-item {
                    padding: 10px 12px;
                }

                .btn-categoria {
                    width: 170px;
                }

                .hours__card {
                    width: 150px;
                }
            }

            @media screen and (max-width: 425px) {
                .btn-categoria {
                    width: 150px;
                    padding: 0.5rem;
                    gap: 0.3rem;
                }
            }

            @media screen and (max-width: 375px) {
                .hours__card {
                    width: 100%;
                }
            }

            @media screen and (max-width: 350px) {
                .modal-content {
                    width: 95%;
                    padding: 0.75rem;
                }

                .modal-documento-item {
                    font-size: 0.85rem;
                }
            }
        </style>

        <main class="main">
            <!-- Título da Página -->
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
                        <div class="text-justify text-gray-600">
                            <?php echo wpautop(wp_kses_post(get_field('sobre') ?: "Nenhuma informação disponível.")); ?>
                        </div>

                    </div>
                </div>
            </section>


            <!-- Seção de Setores -->
            <?php if ($existe_setor === 'Sim' && !empty($setores)): ?>
                <section class="section">
                    <div class="container">
                        <?php foreach ($setores as $setor): ?>
                            <h2 class="text-center text-xl font-semibold mt-8 titulo-setor">
                                <?php echo esc_html($setor['nome_do_setor']); ?>
                            </h2>
                            <div class="cards__img">
                                <?php
                                $count = 0;
                                if (!empty($setor['pessoa'])):
                                    foreach ($setor['pessoa'] as $pessoa):
                                        $count++;
                                        ?>
                                        <div>
                                            <img alt="<?php echo esc_attr($pessoa['nome']); ?>"
                                                src="<?php echo esc_url(!empty($pessoa['foto']) ? $pessoa['foto']['url'] : get_template_directory_uri() . '/src/assets/images/FOTOSINFORMATIVAS.jpeg'); ?>"
                                                loading="lazy" />
                                            <p><?php echo esc_html($pessoa['nome']); ?></p>
                                            <span><?php echo esc_html($pessoa['cargo']); ?></span>
                                            <?php if (!empty($pessoa['telefone'])): ?>
                                                <span><?php echo esc_html($pessoa['telefone']); ?></span>
                                            <?php endif; ?>
                                            <?php if (!empty($pessoa['e-mail'])): ?>
                                                <span><?php echo esc_html($pessoa['e-mail']); ?></span>
                                            <?php endif; ?>
                                            <?php if (!empty($pessoa['curriculo_lattes'])): ?>
                                                <a class="link_lattes" href="<?php echo esc_url($pessoa['curriculo_lattes']); ?>" target="_blank" rel="noopener noreferrer"> Currículo Lattes <i class="bi bi-arrow-right-short"></i></a>
                                            <?php endif; ?>
                                        </div>
                                        <?php
                                        if ($count % 3 == 0)
                                            echo '<span style="width: 100%;"></span>'; // Quebra a linha a cada 3 pessoas
                                    endforeach;
                                endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

            <section class="section">
                <div class="container hours">
                    <div class="container">
                        <h2 class="text-center text-xl font-bold mb-8 titulo-setor">Horário de atendimento</h2>
                    </div>
                    <div class="hours__container">
                        <div class="hours__card">
                            <h6>Segunda</h6>
                            <p>07:30 às 11:30 e 18:00 às 22:00</p>
                        </div>
                        <div class="hours__card">
                            <h6>Terça</h6>
                            <p>07:30 às 11:30 e 16:00 às 20:00</p>
                        </div>
                        <div class="hours__card">
                            <h6>Quarta</h6>
                            <p>07:30 às 11:30 e 18:00 às 22:00</p>
                        </div>
                        <div class="hours__card">
                            <h6>Quinta</h6>
                            <p>07:30 às 11:30 e 18:00 às 22:00</p>
                        </div>
                        <div class="hours__card">
                            <h6>Sexta</h6>
                            <p>07:30 às 11:30 e 16:00 às 20:00</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Seção de Curricularização da Extensão -->
            <?php if (!empty($texto_curricularizacao)): ?>
                <section class="section">
                    <div class="container">
                        <h2 class="text-center text-xl font-bold mb-8 titulo-setor">Curricularização da Extensão</h2>
                        <div class="spacing">
                            <div class="text-justify text-gray-600">
                                <?php echo wpautop(wp_kses_post($texto_curricularizacao)); ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Seção de Eventos Acadêmicos -->
            <?php if (!empty($texto_eventos) || !empty($eventos)): ?>
                <section class="section">
                    <div class="container">
                        <h2 class="text-center text-xl font-bold mb-8 titulo-setor">Eventos Acadêmicos</h2>

                        <?php if (!empty($texto_eventos)): ?>
                            <div class="spacing">
                                <div class="text-justify text-gray-600">
                                    <?php echo wpautop(wp_kses_post($texto_eventos)); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($eventos)): ?>
                            <div class="cards__img">
                                <?php
                                $count = 0;
                                foreach ($eventos as $evento):
                                    $count++;
                                    ?>
                                    <div>
                                        <?php
                                        if (!empty($evento['imagem'])):
                                            $img_id = $evento['imagem'];
                                            $img_url = wp_get_attachment_image_url($img_id, 'medium');
                                            ?>
                                            <img alt="<?php echo esc_attr($evento['nome']); ?>" src="<?php echo esc_url($img_url); ?>"
                                                loading="lazy" />
                                        <?php endif; ?>
                                        <p><?php echo esc_html($evento['nome']); ?></p>
                                        <?php if (!empty($evento['informacoes'])): ?>
                                            <span><?php echo esc_html($evento['informacoes']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                    if ($count % 3 == 0)
                                        echo '<span style="width: 100%;"></span>'; // Quebra a linha a cada 3 itens
                                endforeach;
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Seção de Internacionalização -->
            <?php if (!empty($texto_internacionalizacao) || !empty($parceiros)): ?>
                <section class="section">
                    <div class="container">
                        <h2 class="text-center text-xl font-bold mb-8 titulo-setor">Internacionalização</h2>

                        <?php if (!empty($texto_internacionalizacao)): ?>
                            <div class="spacing">
                                <div class="text-justify text-gray-600">
                                    <?php echo wpautop(wp_kses_post($texto_internacionalizacao)); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($parceiros)): ?>
                            <h3 class="text-center text-lg font-bold mb-8">Parceiros</h3>
                            <div class="cards__img">
                                <?php
                                $count = 0;
                                foreach ($parceiros as $parceiro):
                                    $count++;
                                    ?>
                                    <div>
                                        <?php
                                        if (!empty($parceiro['foto'])):
                                            $img_id = $parceiro['foto'];
                                            $img_url = wp_get_attachment_image_url($img_id, 'medium');
                                            ?>
                                            <img alt="<?php echo esc_attr($parceiro['nome']); ?>" src="<?php echo esc_url($img_url); ?>"
                                                loading="lazy" />
                                        <?php endif; ?>

                                        <p><?php echo esc_html($parceiro['nome']); ?></p>
                                        <?php if (!empty($parceiro['link'])): ?>
                                            <a href="<?php echo esc_url($parceiro['link']); ?>" target="_blank" class="btn">Visitar</a>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                    if ($count % 3 == 0)
                                        echo '<span style="width: 100%;"></span>'; // Quebra a linha a cada 3 itens
                                endforeach;
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Seção de Ligas e Atléticas -->
            <?php if (!empty($texto_ligas) || !empty($ligas)): ?>
                <section class="section">
                    <div class="container">
                        <h2 class="text-center text-xl font-bold mb-8 titulo-setor">Ligas e Atléticas</h2>

                        <?php if (!empty($texto_ligas)): ?>
                            <div class="spacing">
                                <div class="text-justify text-gray-600">
                                    <?php echo wpautop(wp_kses_post($texto_ligas)); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($ligas)): ?>
                            <div class="cards__img">
                                <?php
                                $count = 0;
                                foreach ($ligas as $liga):
                                    $count++;
                                    ?>
                                    <div>
                                        <?php if (!empty($liga['foto'])): ?>
                                            <img alt="<?php echo esc_attr($liga['nome']); ?>" src="<?php echo esc_url($liga['foto']['url']); ?>"
                                                loading="lazy" />
                                        <?php endif; ?>
                                        <p><?php echo esc_html($liga['nome']); ?></p>
                                        <?php if (!empty($liga['link'])): ?>
                                            <a href="<?php echo esc_url($liga['link']); ?>" target="_blank" class="btn">Visitar</a>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                    if ($count % 3 == 0)
                                        echo '<span style="width: 100%;"></span>'; // Quebra a linha a cada 3 itens
                                endforeach;
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Seção de Publicações -->
            <?php if (!empty($publicacoes)): ?>
                <section class="section">
                    <div class="container">
                        <h2 class="text-center text-xl font-bold mb-8 titulo-setor">Publicações</h2>
                        <div class="cards__img">
                            <?php
                            $count = 0;
                            foreach ($publicacoes as $publicacao):
                                $count++;
                                ?>
                                <div>
                                    <?php if (!empty($publicacao['foto'])): ?>
                                        <img alt="<?php echo esc_attr($publicacao['nome']); ?>"
                                            src="<?php echo esc_url($publicacao['foto']['url']); ?>" loading="lazy" />
                                    <?php endif; ?>
                                    <p><?php echo esc_html($publicacao['nome']); ?></p>
                                    <?php if (!empty($publicacao['link'])): ?>
                                        <a href="<?php echo esc_url($publicacao['link']); ?>" target="_blank" class="btn">Acessar</a>
                                    <?php endif; ?>
                                </div>
                                <?php
                                if ($count % 3 == 0)
                                    echo '<span style="width: 100%;"></span>'; // Quebra a linha a cada 3 itens
                            endforeach;
                            ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Seção de Documentos -->
            <section class="section">
                <div class="container">
                    <h2 class="text-center text-xl font-bold mb-8 titulo-setor">Documentos</h2>
                    <div class="documentos-wrapper">
                        <?php foreach ($documentos_agrupados as $tipo => $docs): ?>
                            <button class="btn-categoria" data-modal-target="modal-<?php echo esc_attr(sanitize_title($tipo)); ?>">
                                <i class="bi bi-plus-circle-fill"></i> <?php echo esc_html($tipo); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Modais para os documentos -->
                <?php foreach ($documentos_agrupados as $tipo => $docs): ?>
                    <div id="modal-<?php echo esc_attr(sanitize_title($tipo)); ?>" class="modal modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2><?php echo esc_html($tipo); ?></h2>
                                <span class="modal-close">&times;</span>
                            </div>
                            <div class="modal-body">
                                <?php foreach ($docs as $doc): ?>
                                    <a class="documento-item modal-documento-item" href="<?php echo esc_url($doc['arquivo']['url']); ?>"
                                        target="_blank">
                                        <?php echo esc_html($doc['nome']); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </section>



        </main>

        <style>
            @media screen and (max-width: 768px) {
                .d-none-mobile {
                    display: none !important;
                }

                .only-mobile {
                    display: block !important;
                }
            }

            @media screen and (min-width: 769px) {
                .only-mobile {
                    display: none !important;
                }
            }
        </style>

        <?php
    endwhile;
endif;

get_footer();
?>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const botoes = document.querySelectorAll('.btn-categoria');

        function abrirModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            }
        }

        function fecharModal(modal) {
            modal.style.display = 'none';
            document.body.style.overflow = '';
        }

        botoes.forEach(botao => {
            botao.addEventListener('click', function () {
                const modalId = this.getAttribute('data-modal-target');
                abrirModal(modalId);
            });
        });

        const closeButtons = document.querySelectorAll('.modal-close');
        closeButtons.forEach(button => {
            button.addEventListener('click', function () {
                const modal = this.closest('.modal');
                fecharModal(modal);
            });
        });

        window.addEventListener('click', function (event) {
            if (event.target.classList.contains('modal')) {
                fecharModal(event.target);
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                const modaisAbertas = document.querySelectorAll('.modal[style*="display: block"]');
                modaisAbertas.forEach(modal => {
                    fecharModal(modal);
                });
            }
        });
    });
</script>
