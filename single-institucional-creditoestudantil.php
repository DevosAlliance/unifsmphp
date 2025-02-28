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
                                     src="<?php echo esc_url(!empty($pessoa['foto']) ? $pessoa['foto']['url'] : get_template_directory_uri() . '/src/assets/images/FOTOSINFORMATIVAS.jpeg'); ?>" />
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
    <?php if (!empty($anexos) || !empty($links)) : ?>
    <section class="section">
        <div class="container">
            <h2 class="text-center text-2xl font-bold mb-8">Documentos e Links</h2>
            <div class="text-center">
                <?php 
                $count_items = 0;

                // Exibir Documentos (Anexos)
                if (!empty($anexos)) :
                    foreach ($anexos as $anexo) :
                        if (!empty($anexo['arquivo']['url']) && !empty($anexo['nome'])) :
                            $count_items++;
                ?>
                            <a class="btn mb-2" href="<?php echo esc_url($anexo['arquivo']['url']); ?>" target="_blank">
                                📄 <?php echo esc_html($anexo['nome']); ?>
                            </a>
                            <?php if ($count_items % 3 == 0) echo '<div style="width: 100%;"></div>'; // Quebra a linha a cada 3 itens ?>
                <?php 
                        endif;
                    endforeach;
                endif;

                // Exibir Links Externos
                if (!empty($links)) :
                    foreach ($links as $link) :
                        if (!empty($link['link']) && !empty($link['nome'])) :
                            $count_items++;
                ?>
                            <a class="btn mb-2" href="<?php echo esc_url($link['link']); ?>" target="_blank">
                                🔗 <?php echo esc_html($link['nome']); ?>
                            </a>
                            <?php if ($count_items % 3 == 0) echo '<div style="width: 100%;"></div>'; // Quebra a linha a cada 3 itens ?>
                <?php 
                        endif;
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </section>
<?php endif; ?>
    <section class="section">
    <iframe width="560" height="700" style="border: none;" src="https://fundacred.org.br/estudante-web/frame-simulador?ie=1021%7C1023%7C1024%7C1025%7C1026%7C1027"></iframe>
    </section>
</main>

<?php 
    endwhile;
endif;

get_footer();
?>
