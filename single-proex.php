<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
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

        if (have_rows('documentos')) :
            while (have_rows('documentos')) : the_row();
                if (have_rows('classe')) :
                    while (have_rows('classe')) : the_row();
                        $tipo = get_sub_field('tipo');
                        $dados = get_sub_field('dados');
                        
                        if (!empty($tipo) && !empty($dados)) :
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
    .documentos-wrapper {
    display: flex;
    flex-wrap: wrap;
        gap: 2rem;
        justify-content: space-between;
        margin-bottom: 2rem;
    }

    .documento-coluna {
        flex: 1 1 18%;
        min-width: 200px;
        background-color: #ffffff;
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .documento-coluna h3 {
        text-align: center;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .documento-item {
        display: block;
        background-color: #4299e1;
        color: white;
        padding: 0.6rem;
        border-radius: 6px;
        margin-bottom: 0.5rem;
        text-align: center;
        font-weight: 500;
        text-decoration: none;
        transition: background 0.3s;
    }

    .documento-item:hover {
        background-color: #2b6cb0;
    }

    .select-mobile {
        display: none;
        margin: 1rem 0;
        width: 100%;
        padding: 0.6rem;
        border-radius: 6px;
        font-size: 1rem;
    }

    @media screen and (max-width: 768px) {
        .documentos-wrapper {
            display: none;
        }
        .select-mobile {
            display: block;
        }
        .mobile-documentos {
            margin-top: 1rem;
        }
        .mobile-documentos .documento-item {
            width: 100%;
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
    <?php if ($existe_setor === 'Sim' && !empty($setores)) : ?>
        <section class="section">
            <div class="container">
                <?php foreach ($setores as $setor) : ?>
                    <h2 class="text-center text-xl font-semibold mt-8 titulo-setor"><?php echo esc_html($setor['nome_do_setor']); ?></h2>
                    <div class="cards__img">
                        <?php 
                        $count = 0;
                        if (!empty($setor['pessoa'])) :
                            foreach ($setor['pessoa'] as $pessoa) : 
                                $count++;
                        ?>
                            <div>
                                <img alt="<?php echo esc_attr($pessoa['nome']); ?>" 
                                     src="<?php echo esc_url(!empty($pessoa['foto']) ? $pessoa['foto']['url'] : get_template_directory_uri() . '/src/assets/images/FOTOSINFORMATIVAS.jpeg'); ?>" loading="lazy"/>
                                <p><?php echo esc_html($pessoa['nome']); ?></p>
                                <span><?php echo esc_html($pessoa['cargo']); ?></span>
                                <?php if (!empty($pessoa['telefone'])) : ?>
                                    <span><?php echo esc_html($pessoa['telefone']); ?></span>
                                <?php endif; ?>
                                <?php if (!empty($pessoa['e-mail'])) : ?>
                                    <span><?php echo esc_html($pessoa['e-mail']); ?></span>
                                <?php endif; ?>
                            </div>
                            <?php 
                                if ($count % 3 == 0) echo '<span style="width: 100%;"></span>'; // Quebra a linha a cada 3 pessoas
                            endforeach;
                        endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>



    <!-- Seção de Curricularização da Extensão -->
    <?php if (!empty($texto_curricularizacao)) : ?>
    <section class="section">
        <div class="container">
            <h2 class="text-center text-xl font-semibold mb-8">Curricularização da Extensão</h2>
            <div class="spacing">
                <div class="text-justify text-gray-600">
                    <?php echo wpautop(wp_kses_post($texto_curricularizacao)); ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Seção de Eventos Acadêmicos -->
    <?php if (!empty($texto_eventos) || !empty($eventos)) : ?>
    <section class="section">
        <div class="container">
            <h2 class="text-center text-xl font-semibold mb-8">Eventos Acadêmicos</h2>
            
            <?php if (!empty($texto_eventos)) : ?>
            <div class="spacing">
                <div class="text-justify text-gray-600">
                    <?php echo wpautop(wp_kses_post($texto_eventos)); ?>
                </div>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($eventos)) : ?>
            <div class="cards__img">
                <?php foreach ($eventos as $evento) : ?>
                <div>
                    <?php
                    if (!empty($evento['imagem'])) :
                        $img_id = $evento['imagem'];
                        $img_url = wp_get_attachment_image_url($img_id, 'medium'); // ou 'full', 'thumbnail', etc.
                    ?>
                        <img alt="<?php echo esc_attr($evento['nome']); ?>" 
                            src="<?php echo esc_url($img_url); ?>" loading="lazy"/>
                    <?php endif; ?>
                    <p><?php echo esc_html($evento['nome']); ?></p>
                    <?php if (!empty($evento['informacoes'])) : ?>
                    <span><?php echo esc_html($evento['informacoes']); ?></span>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Seção de Internacionalização -->
    <?php if (!empty($texto_internacionalizacao) || !empty($parceiros)) : ?>
    <section class="section">
        <div class="container">
            <h2 class="text-center text-xl font-semibold mb-8">Internacionalização</h2>
            
            <?php if (!empty($texto_internacionalizacao)) : ?>
            <div class="spacing">
                <div class="text-justify text-gray-600">
                    <?php echo wpautop(wp_kses_post($texto_internacionalizacao)); ?>
                </div>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($parceiros)) : ?>
            <h3 class="text-center text-lg font-semibold mb-4">Parceiros Internacionais</h3>
            <div class="cards__img">
                <?php foreach ($parceiros as $parceiro) : ?>
                <div>
                    <?php
                    if (!empty($parceiro['foto'])) :
                        $img_id = $parceiro['foto'];
                        $img_url = wp_get_attachment_image_url($img_id, 'medium'); // ou 'full', se quiser imagem maior
                    ?>
                        <img alt="<?php echo esc_attr($parceiro['nome']); ?>" 
                            src="<?php echo esc_url($img_url); ?>" loading="lazy"/>
                    <?php endif; ?>

                    <p><?php echo esc_html($parceiro['nome']); ?></p>
                    <?php if (!empty($parceiro['link'])) : ?>
                    <a href="<?php echo esc_url($parceiro['link']); ?>" target="_blank" class="btn">Visitar</a>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>


    <!-- Seção de Ligas e Atléticas -->
    <?php if (!empty($texto_ligas) || !empty($ligas)) : ?>
    <section class="section">
        <div class="container">
            <h2 class="text-center text-xl font-semibold mb-8">Ligas e Atléticas</h2>
            
            <?php if (!empty($texto_ligas)) : ?>
            <div class="spacing">
                <div class="text-justify text-gray-600">
                    <?php echo wpautop(wp_kses_post($texto_ligas)); ?>
                </div>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($ligas)) : ?>
            <div class="cards__img">
                <?php foreach ($ligas as $liga) : ?>
                <div>
                    <?php if (!empty($liga['foto'])) : ?>
                    <img alt="<?php echo esc_attr($liga['nome']); ?>" 
                         src="<?php echo esc_url($liga['foto']['url']); ?>" loading="lazy"/>
                    <?php endif; ?>
                    <p><?php echo esc_html($liga['nome']); ?></p>
                    <?php if (!empty($liga['link'])) : ?>
                    <a href="<?php echo esc_url($liga['link']); ?>" target="_blank" class="btn">Visitar</a>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Seção de Publicações -->
    <?php if (!empty($publicacoes)) : ?>
    <section class="section">
        <div class="container">
            <h2 class="text-center text-xl font-semibold mb-8">Publicações</h2>
            <div class="cards__img">
                <?php foreach ($publicacoes as $publicacao) : ?>
                <div>
                    <?php if (!empty($publicacao['foto'])) : ?>
                    <img alt="<?php echo esc_attr($publicacao['nome']); ?>" 
                         src="<?php echo esc_url($publicacao['foto']['url']); ?>" loading="lazy"/>
                    <?php endif; ?>
                    <p><?php echo esc_html($publicacao['nome']); ?></p>
                    <?php if (!empty($publicacao['link'])) : ?>
                    <a href="<?php echo esc_url($publicacao['link']); ?>" target="_blank" class="btn">Acessar</a>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Seção de Documentos - Desktop -->
    <section class="section d-none-mobile">
        <h2 class="text-center text-xl font-semibold mb-8">Documentos</h2>
        <div class="container">
            <div class="cards__img">
                <?php foreach ($documentos_agrupados as $tipo => $docs) : ?>
                    <div class="cards__img">
                        <h3 class="text-center font-bold mb-2"><?php echo esc_html($tipo); ?></h3>
                        <?php foreach ($docs as $doc) : ?>
                            <a class="btn" href="<?php echo esc_url($doc['arquivo']['url']); ?>" target="_blank">
                                <?php echo esc_html($doc['nome']); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Seção de Documentos - Mobile -->
    <section class="section only-mobile">
        <div class="container">
            <select id="filtro-documento" class="btn w-full mb-2">
                <option value="">Selecione uma categoria</option>
                <?php foreach ($documentos_agrupados as $tipo => $docs) : ?>
                    <option value="<?php echo esc_attr($tipo); ?>"><?php echo esc_html($tipo); ?></option>
                <?php endforeach; ?>
            </select>

            <div id="documentos-filtrados">
                <?php foreach ($documentos_agrupados as $tipo => $docs) : ?>
                    <div class="grupo-documento" data-tipo="<?php echo esc_attr($tipo); ?>" style="display:none;">
                        <?php foreach ($docs as $doc) : ?>
                            <a class="btn w-full mb-2" href="<?php echo esc_url($doc['arquivo']['url']); ?>" target="_blank">
                                <?php echo esc_html($doc['nome']); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <script>
        document.getElementById('filtro-documento').addEventListener('change', function () {
            const tipo = this.value;
            document.querySelectorAll('.grupo-documento').forEach(group => {
                group.style.display = group.getAttribute('data-tipo') === tipo ? 'block' : 'none';
            });
        });
        </script>
    </section>

</main>

<style>
@media screen and (max-width: 768px) {
    .d-none-mobile { display: none !important; }
    .only-mobile { display: block !important; }
}

@media screen and (min-width: 769px) {
    .only-mobile { display: none !important; }
}
</style>

<?php 
    endwhile;
endif;

get_footer();
?>