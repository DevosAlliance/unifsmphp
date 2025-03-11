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
                <div class="text-justify text-gray-600">
                    <?php echo wpautop(wp_kses_post(get_field('sobre') ?: "Nenhuma informação disponível.")); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Slogan Principal - Nova Seção -->
    <section class="section cpa-slogan-section">
        <div class="container">
            <div class="cpa-slogan">
                <h2 class="slogan-title">Avaliar para transformar</h2>
                <p class="slogan-description">DESCUBRA O QUE A CPA PODE FAZER POR VOCÊ!</p>
                <div class="cpa-buttons">
                    <a href="#saiba-mais" class="cpa-button">Saiba Mais</a>
                    <a href="#contato" class="cpa-button cpa-button-outline">Fale Conosco</a>
                </div>
            </div>
        </div>
    </section>

    <!-- O que é a CPA - Nova Seção -->
    <section id="o-que-e" class="section cpa-info-section">
        <div class="container">
            <div class="info-box">
                <h3 class="info-title">O QUE É A CPA?</h3>
                <div class="info-content">
                    <p>A Comissão Própria de Avaliação é o setor responsável pela implantação e pelo desenvolvimento do processo de avaliação institucional, que ocorre anualmente, com o objetivo de rever objetivos e metas a serem concretizados, mediante ações dos diversos segmentos da IES.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Importância da Avaliação - Nova Seção -->
    <section id="importancia" class="section cpa-info-section cpa-alt-section">
        <div class="container">
            <div class="info-box">
                <h3 class="info-title">QUAL A IMPORTÂNCIA DA AVALIAÇÃO INSTITUCIONAL?</h3>
                <div class="info-content">
                    <p>A avaliação institucional tem como principal função harmonizar, apoiar, orientar, reforçar e corrigir os aspectos avaliados. Assim, a avaliação institucional possibilita a reestruturação do processo educacional e a introdução de mudanças na instituição.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Autoavaliação - Nova Seção -->
    <section id="autoavaliacao" class="section cpa-info-section">
        <div class="container">
            <div class="info-box">
                <h3 class="info-title">O QUE É AUTOAVALIAÇÃO INSTITUCIONAL?</h3>
                <div class="info-content">
                    <p>É o processo mediante o qual a instituição, com a participação de todos os seus segmentos, se analisa internamente, objetivando relacionar o que realmente é com o que deseja ser, assim como as suas realizações, o modo como se organiza e atua.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Importância da CPA - Nova Seção -->
    <section id="importancia-cpa" class="section cpa-info-section cpa-alt-section">
        <div class="container">
            <div class="info-box">
                <h3 class="info-title">POR QUE É TÃO IMPORTANTE TER COMISSÃO PRÓPRIA DE AVALIAÇÃO?</h3>
                <div class="info-content">
                    <p>A CPA é um instrumento fundamental para o diagnóstico institucional, trazendo diversos benefícios e possibilitando um levantamento sobre as potencialidades e fragilidades da IES, a partir da opinião dos alunos, professores, colaboradores, egressos e sociedade civil sobre as condições de ensino, pesquisa, extensão e gestão.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Integrantes da CPA - Nova Seção -->
    <section id="saiba-mais" class="section cpa-members-section">
        <div class="container">
            <div class="cpa-members">
                <h3 class="members-title">QUEM INTEGRA A CPA?</h3>
                <div class="members-content">
                    <p>A CPA é composta por representantes de alunos, professores, colaboradores e comunidade externa.</p>
                </div>
                <div class="members-action">
                    <a href="#membros" class="cpa-button">Conheça os Membros</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção de Setores -->
    <?php if ($existe_setor === 'Sim' && !empty($setores)) : ?>
        <section id="membros" class="section">
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
                                <span><?php echo esc_html($pessoa['telefone']); ?></span>
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

    <!-- Contato CPA - Nova Seção -->
    <section id="contato" class="section cpa-contact-section">
        <div class="container">
            <div class="cpa-contact">
                <h3 class="contact-title">Fale Conosco!</h3>
                <div class="contact-methods">
                    <div class="contact-method">
                        <h4>Telefone</h4>
                        <p>(83) 99306-4363</p>
                    </div>
                    <div class="contact-method">
                        <h4>E-mail</h4>
                        <p>cpa@unifsm.edu.br</p>
                    </div>
                    <div class="contact-method">
                        <h4>Instagram</h4>
                        <p>@CPAUNIFSM</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
</main>

<?php 
    endwhile;
endif;

get_footer();
?>