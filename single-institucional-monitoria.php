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
                    <span>Envio/entrega de documentos:</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="accordion-content">
                    <p>Em formato digital (PDF ou foto): apenas por e-mail: <a href="mailto:monitoria@fsmead.com.br">monitoria@fsmead.com.br</a>
                    Em formato físico: assinar a lista e deixar na mesa da Coordenação de Monitoria (Bloco A)
                    Informações detalhadas se encontram no passo a passo para novos monitores, assim como todos os modelos de documentos para preencher se encontram no site: <a href="https://www.unifsm.edu.br/monitoria/">https://www.unifsm.edu.br/monitoria/</a>
                    </p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header">
                    <span>Termo de Compromisso:</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="accordion-content">
                    <p>O início das atividades de monitoria só será autorizado após a entrega do Termo de Compromisso de Monitoria assinado.
                    Entrega em formato físico e TAMBÉM por e-mail (enviar foto) <a href="mailto:monitoria@fsmead.com.br">monitoria@fsmead.com.br</a>
                    Modelo no site: <a href="https://www.unifsm.edu.br/monitoria/">https://www.unifsm.edu.br/monitoria/</a>
                    Termo de Compromisso só deverá ser entregue apenas 1 vez ao início da monitoria e válido por 2 semestres.
                    Todas as assinaturas devem ser físicas (escritas a mão) ou preenchidas através do gov.br
                </p>
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
                    <span>Cronograma de Atividades:</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="accordion-content">
                    <p>
                        O(A) monitor(a) deverá preencher o Cronograma de Atividades de Monitoria para fazer uso dos laboratórios e salas da instituição com solicitação mínima de uma semana de antecedência.
                        Entrega APENAS por e-mail (enviar foto) <a href="mailto:monitoria@fsmead.com.br">monitoria@fsmead.com.br</a>
                        Modelo no site: <a href="https://www.unifsm.edu.br/monitoria/">https://www.unifsm.edu.br/monitoria/</a>
                        Cronograma de Atividades deverá ser entregue ao início de cada semestre.
                        Todas as assinaturas devem ser físicas (escritas a mão) ou preenchidas através do gov.br
                    </p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header">
                    <span>Relatório Semestral de Atividades:</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="accordion-content">
                    <p>
                        O(A) monitor(a) deverá preencher o Relatório Semestral de Atividades ao final de cada semestre e enviar para comprovação de atividades necessárias para validação do certificado.
                        Entrega APENAS em formato digital pela plataforma EAD e TAMBÉM por e-mail <a href="mailto:monitoria@fsmead.com.br">monitoria@fsmead.com.br</a>
                        Modelo no site: <a href="https://www.unifsm.edu.br/monitoria/">https://www.unifsm.edu.br/monitoria/</a>
                        Relatório Semestral de Atividades deverá ser entregue ao final de cada semestre.
                        Todas as assinaturas devem ser físicas (escritas a mão) ou preenchidas através do gov.br
                    </p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header">
                    <span>Termo de Desligamento de Monitoria:</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="accordion-content">
                    <p>
                        O(A) monitor(a) poderá se desligar da monitoria a qualquer momento desde que preencha e assine o Termo de Desligamento.
                        Entrega APENAS em formato digital por e-mail <a href="mailto:monitoria@fsmead.com.br">monitoria@fsmead.com.br</a>
                        Modelo no site: <a href="https://www.unifsm.edu.br/monitoria/">https://www.unifsm.edu.br/monitoria/</a>
                        Todas as assinaturas devem ser físicas (escritas a mão) ou preenchidas através do gov.br
                    </p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header">
                    <span>Certificados de Monitoria:</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="accordion-content">
                    <p>
                        O(A) monitor(a) deverá solicitar o certificado de monitoria por e-mail <a href="mailto:monitoria@fsmead.com.br">monitoria@fsmead.com.br</a> ao final do prazo de 2 semestres de monitoria, bem como enviar cópia dos relatórios semestrais de monitoria em anexo para validação das horas.
                        O(A) monitor(a) que cumprir apenas 1 semestre de monitoria e desejar solicitar certificado, deverá solicitar o certificado de monitoria por e-mail <a href="mailto:monitoria@fsmead.com.br">monitoria@fsmead.com.br</a> com o relatório semestral e o termo de desligamento em anexo para validação de horas e confirmação de término de monitoria
                        Solicitações incompletas e/ou com informações erradas serão descartadas.
                        Prazo para recebimento do certificado após solicitação por e-mail: de 1 a 2 meses.
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
