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
                                     src="<?php echo esc_url(!empty($pessoa['foto']) ? $pessoa['foto']['url'] : get_template_directory_uri() . '/src/assets/images/FOTOSINFORMATIVAS.jpeg'); ?>"  loading="lazy"/>
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
        <div class="accordion">
            <div class="accordion-item">
                <div class="accordion-header">
                    <span>Acesso ao Ambiente Virtual de Aprendizagem - AVA</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="accordion-content">
                    <ul>
                        <li>Já tentou acessar seu AVA no endereço 
                            <a href="https://unifsm.online/" target="_blank">https://unifsm.online/</a> 
                            utilizando a sua matrícula como login e senha?
                        </li>
                        <li>Caso não tenha conseguido acessar, clique para falar com um de nossos atendentes.</li>
                    </ul>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header">
                    <span>Solicitar a inserção ou remoção de alguma unidade curricular</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="accordion-content">
                    <p><b>1 – Inserir:</b> O NEAD só pode inserir no seu AVA as unidades curriculares que constarem no seu Portal do Aluno. Caso deseje incluir alguma que não conste lá, entre em contato com seu coordenador.</p>
                    <p><b>2 – Remover:</b> O NEAD só poderá remover a unidade curricular se ela não estiver constando no seu Portal do Aluno.</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header">
                    <span>Dúvidas sobre as avaliações</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="accordion-content">
                    <p><b>1 - Discursivas/Fórum de discussão:</b> Avaliação desenvolvida com base no conteúdo do AVA e corrigida pelo professor. Normalmente, tem um peso de 40%.</p>
                    <p><b>2 - Objetivas:</b> São questões de múltipla escolha corrigidas automaticamente pelo sistema, geralmente com peso de 60%. O aluno tem apenas uma tentativa.</p>
                    <p><b>3 - Prazos:</b> As avaliações podem ser feitas a qualquer momento, mas devem respeitar as datas limites estabelecidas.</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header">
                    <span>Cálculos/Média</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="accordion-content">
                    <p>A nota final é calculada da seguinte forma:</p>
                    <p>(Nota da prova objetiva x 60%) + (Nota do Fórum x 40%) / 100 = Nota da Unidade</p>
                    <p>Exemplo: (7,0 x 60) + (8,0 x 40) / 100 = 7,4</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header">
                    <span>Reposições</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="accordion-content">
                    <p>Se perdeu os prazos das avaliações EaD, todas elas serão reabertas na semana de reposições, conforme o calendário acadêmico.</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header">
                    <span>Avaliações finais</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="accordion-content">
                    <p>Somente terão acesso às avaliações finais os alunos que tiverem média entre 4 e 7.</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header">
                    <span>Outras dúvidas</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="accordion-content">
                    <p>Se sua dúvida não estiver na lista, entre em contato com um atendente de segunda a sexta-feira, das 8h às 12h e das 18h às 22h.</p>
                    <p>Acesse o AVA no endereço: 
                        <a href="https://unifsm.online/" target="_blank">https://unifsm.online/</a> e clique em <b>"POSSO AJUDAR"</b>.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const accordionItems = document.querySelectorAll(".accordion-item");

            accordionItems.forEach((item) => {
                const header = item.querySelector(".accordion-header");

                header.addEventListener("click", function () {
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
