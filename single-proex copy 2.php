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
        $internacionalizacao_documentos = get_field('internacionalizacao_documentos');
         // Coleta os campos personalizados
        $categorias = [
            'solicitacoes' => get_field('links'),
            'relatorios' => get_field('pesquisa'),
            'formularios' => get_field('formularios'),
            'editais' => get_field('extensao'),
            'internacionalizacao' => get_field('internacionalizacao_documentos')
        ];
?>

<style>
/* Estilo geral */
.categorias-grid {
    display: flex;
    justify-content: space-between;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.categoria-coluna {
    background: #fff;
    border-radius: 8px;
    padding: 1rem;
    min-width: 250px;
    flex: 1;
}

.categoria-coluna h3 {
    font-size: 1.25rem;
    font-weight: bold;
    text-align: center;
    margin-bottom: 1rem;
}

.documento-item {
    display: block;
    background-color: #4299e1;
    color: white;
    padding: 0.6rem 1rem;
    border-radius: 6px;
    margin-bottom: 0.5rem;
    text-align: center;
    font-weight: 600;
    text-decoration: none;
    transition: background-color 0.3s;
}

.documento-item:hover {
    background-color: #2b6cb0;
}

/* Filtro Mobile */
.filtro-categorias {
    display: none;
    margin-bottom: 1rem;
}

.filtro-categorias select {
    width: 100%;
    padding: 0.6rem;
    font-size: 1rem;
    border-radius: 6px;
    border: 1px solid #ccc;
}

/* Mobile */
@media screen and (max-width: 768px) {
    .categorias-grid {
        flex-direction: column;
    }

    .filtro-categorias {
        display: block;
    }

    .categoria-coluna {
        display: none;
    }

    .categoria-coluna.ativa {
        display: block;
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

    <section class="section">
        <div class="container">
            <div class="filtro-categorias">
                <select onchange="filtrarCategoria(this.value)">
                    <option value="todos">Todas as Categorias</option>
                    <option value="solicitacoes">Solicitações</option>
                    <option value="relatorios">Relatórios</option>
                    <option value="formularios">Formulários</option>
                    <option value="editais">Editais</option>
                    <option value="internacionalizacao">Internacionalização</option>
                </select>
            </div>

            <div class="categorias-grid">
                <?php foreach ($categorias as $slug => $itens) : ?>
                    <?php if (!empty($itens)) : ?>
                    <div class="categoria-coluna" data-categoria="<?php echo esc_attr($slug); ?>">
                        <h3><?php echo ucfirst($slug); ?></h3>
                        <?php foreach ($itens as $item) : ?>
                            <?php 
                                $nome = $item['nome'] ?? '';
                                $link = $item['link']['url'] ?? $item['link'] ?? '';
                                if (!empty($nome) && !empty($link)) :
                            ?>
                                <a class="documento-item" href="<?php echo esc_url($link); ?>" target="_blank">
                                    <?php echo esc_html($nome); ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</main>

<script>
    function filtrarCategoria(categoria) {
        const colunas = document.querySelectorAll('.categoria-coluna');

        colunas.forEach(coluna => {
            if (categoria === 'todos' || coluna.dataset.categoria === categoria) {
                coluna.classList.add('ativa');
            } else {
                coluna.classList.remove('ativa');
            }
        });
    }

    // Mostrar todas por padrão
    document.addEventListener('DOMContentLoaded', () => {
        filtrarCategoria('todos');
    });
</script>


<?php 
    endwhile;
endif;

get_footer();
?>