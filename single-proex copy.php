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
?>

<style>
    /* Estilização dos links como botões */
.documentos-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    justify-content: center;
}

.documento-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background-color: #4299e1;
    color: #fff;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: background-color 0.3s ease;
}


.documento-item:hover {
    background-color: #2b6cb0;
}

.documento-icone {
    font-size: 1.2rem;
}

.documento-nome {
    font-size: 1rem;
    white-space: nowrap;
    color: #ffffff;
}

/* Responsivo: empilhar em colunas no mobile */
@media screen and (max-width: 768px) {
    .documentos-grid {
        flex-direction: column;
        align-items: stretch;
    }

    .documento-item {
        justify-content: center;
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

    <!-- Seção de Links -->
    <?php if (!empty($links)) : ?>
    <section class="section">
        <div class="container">
            <h2 class="text-center text-xl font-semibold mb-8">Links Importantes</h2>
            <div class="documentos-container">
                <div class="documentos-grupo">
                    <div class="documentos-grid">
                        <?php foreach ($links as $link) : ?>
                            <?php if (!empty($link['link']) && !empty($link['nome'])) : ?>
                                <a class="documento-item link-item" href="<?php echo esc_url($link['link']); ?>" target="_blank">
                                    <span class="documento-nome"><?php echo esc_html($link['nome']); ?></span>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Seção de Pesquisa -->
    <?php if (!empty($pesquisas)) : ?>
    <section class="section">
        <div class="container">
            <h2 class="text-center text-xl font-semibold mb-8">Pesquisa</h2>
            <div class="documentos-container">
                <div class="documentos-grupo">
                    <div class="documentos-grid">
                        <?php foreach ($pesquisas as $pesquisa) : ?>
                            <?php if (!empty($pesquisa['link']) && !empty($pesquisa['nome'])) : ?>
                                <a class="documento-item link-item" href="<?php echo esc_url($pesquisa['link']); ?>" target="_blank">
                                    <span class="documento-nome"><?php echo esc_html($pesquisa['nome']); ?></span>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Seção de Extensão -->
    <?php if (!empty($extensoes)) : ?>
    <section class="section">
        <div class="container">
            <h2 class="text-center text-xl font-semibold mb-8">Extensão</h2>
            <div class="documentos-container">
                <div class="documentos-grupo">
                    <div class="documentos-grid">
                        <?php foreach ($extensoes as $extensao) : ?>
                            <?php if (!empty($extensao['link']) && !empty($extensao['nome'])) : ?>
                                <a class="documento-item link-item" href="<?php echo esc_url($extensao['link']); ?>" target="_blank">
                                    <span class="documento-nome"><?php echo esc_html($extensao['nome']); ?></span>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
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

    <!-- Seção de Formulários -->
    <?php if (!empty($formularios)) : ?>
    <section class="section">
        <div class="container">
            <h2 class="text-center text-xl font-semibold mb-8">Formulários</h2>
            <div class="documentos-container">
                <div class="documentos-grupo">
                    <div class="documentos-grid">
                        <?php foreach ($formularios as $formulario) : ?>
                            <?php if (!empty($formulario['arquivo']) && !empty($formulario['nome'])) : ?>
                                <a class="documento-item" href="<?php echo esc_url($formulario['arquivo']['url']); ?>" target="_blank">
                                    <span class="documento-nome"><?php echo esc_html($formulario['nome']); ?></span>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
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
</main>

<?php 
    endwhile;
endif;

get_footer();
?>