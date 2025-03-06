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

 .localizacao {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
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
            <div class="localizacao">
                <iframe src="<?php echo esc_url(get_field('embed_localizacao_google', 'option')); ?>"
                    width="100%"
                    height="100%"
                    style="border: 0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

</main>

<?php 
    endwhile;
endif;

get_footer();
?>
