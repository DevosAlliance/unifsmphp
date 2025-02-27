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
?>
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
                <p class="text-center text-gray-600">
                    <?php echo esc_html($sobre ? $sobre : "Nenhuma informação disponível."); ?>
                </p>
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
                                     src="<?php echo esc_url(!empty($pessoa['foto']) ? $pessoa['foto']['url'] : get_template_directory_uri() . '/src/assets/images/orientador.png'); ?>" />
                                <p><?php echo esc_html($pessoa['nome']); ?></p>
                                <span><?php echo esc_html($pessoa['cargo']); ?></span>
                                <?php if (!empty($pessoa['e-mail'])) : ?>
                                    <span><?php echo esc_html($pessoa['e-mail']); ?></span>
                                <?php endif; ?>
                            </div>
                            <?php if ($count % 3 == 0) echo '<span style="width: 100%;"></span>'; // Quebra a linha a cada 3 pessoas ?>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- Seção de Documentos -->
    <?php if ($existe_anexo === 'Sim' && !empty($anexos)) : ?>
        <section class="section">
            <div class="container">
                <h2 class="text-center text-2xl font-bold mb-8">Documentos</h2>
                <div class="text-center">
                    <?php 
                    $count_docs = 0;
                    foreach ($anexos as $anexo) : 
                        $count_docs++;
                    ?>
                        <a class="btn" href="<?php echo esc_url($anexo['arquivo']['url']); ?>" target="_blank">
                            <?php echo esc_html($anexo['nome']); ?>
                        </a>
                        <?php if ($count_docs % 3 == 0) echo '<div style="width: 100%;"></div>'; // Quebra a linha a cada 3 documentos ?>
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
