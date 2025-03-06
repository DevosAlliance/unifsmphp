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
        <div class="accordion">
            <div class="accordion-item">
                <div class="accordion-header">
                    <span>Educação Cidadã</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="accordion-content">
                    <p>A bolsa Educação Cidadã do programa PROEDUCA, não é um financiamento, você paga apenas os 50% durante a duração da bolsa.</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header">
                    <span>Duração da bolsa</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="accordion-content">
                    <p>A bolsa Educação Cidadã tem a duração de 2 anos, durante este tempo, o estudante pode migrar para o FIES ou PROUNI, caso não consiga e comprovando pode nos procurar por novas possibilidades.</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header">
                    <span>Documentação Necessária</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="accordion-content">
                    <p>Todos os documentos devem ser originais, fazemos o escaneamento aqui na instituição.</p>
                    <ul>
                        <li>Certificado do Ensino Médio</li>
                        <li>Histórico do Ensino Médio</li>
                        <li>RG, C.P.F e Título de Eleitor</li>
                        <li>Comprovantes da última votação</li>
                        <li>Reservista/Alistamento (para homem)</li>
                        <li>Registro de Nascimento ou Casamento</li>
                        <li>Comprovante de Residência</li>
                        <li>RG e CPF (Pai e Mãe)</li>
                    </ul>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header">
                    <span>Transferência de bolsas entre alunos</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="accordion-content">
                    <p>Não, infelizmente a bolsa é vinculada ao registro do estudante cadastrado, se ele decidir transferir para outra pessoa, não pode.</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header">
                    <span>Transferência em caso mudança de curso</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="accordion-content">
                    <p>Pode sim, porém, é necessário que entre em contato com o setor de Políticas de Relações Externas para que façam o encaminhamento dos documentos e façam o processo da troca de curso com a bolsa.</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header">
                    <span>Trancamento de curso</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="accordion-content">
                    <p>Você pode sim trancar e se manter dentro da bolsa, porém, você tem um período letivo para retornar e se manter dentro da bolsa.</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header">
                    <span>Como faço para me transferir para o Centro Universitário Santa Maria?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="accordion-content">
                    <p>Você pode vir na instituição com seus documentos originais e o histórico e as ementas do curso que você deseja transferir para a instituição.</p>
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
