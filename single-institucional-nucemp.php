<?php
/**
 * Template Name: Núcleo de Empregabilidade
 */
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
/* Estilos para a página do Núcleo de Empregabilidade */

/* Cores principais */
:root {
    --primary-color: #1b2972;
    --primary-dark: #1b2972;
    --primary-light:rgb(14, 182, 253);
    --accent-color: #0086be;
    --text-light: #FFFFFF;
    --text-dark: #212121;
    --background-light: #FAFAFA;
    --background-dark:rgb(255, 255, 255);
}

/* Estilos gerais de seção */
.section {
    padding: 60px 0;
}

.section-heading {
    text-align: center;
    margin-bottom: 40px;
}

.section-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: var(--primary-dark);
    position: relative;
    display: inline-block;
    padding-bottom: 15px;
}

.section-title:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background-color: var(--accent-color);
}

/* Banner de Destaque */
.empregabilidade-banner-section {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
    color: var(--text-light);
    padding: 80px 0;
    overflow: hidden;
}

.empregabilidade-banner {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    gap: 30px;
}

.banner-content {
    flex: 1;
    min-width: 300px;
}

.banner-title {
    font-size: 3.5rem;
    font-weight: bold;
    margin-bottom: 20px;
    line-height: 1.2;
}

.banner-description {
    font-size: 1.8rem;
    margin-bottom: 30px;
}

.banner-buttons {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.banner-qrcode {
    flex: 0 0 350px;
    background-color: var(--accent-color);
    padding: 25px;
    border-radius: 10px;
    text-align: center;
}

.banner-qrcode h3 {
    font-size: 1.2rem;
    margin-bottom: 15px;
    font-weight: bold;
}

.qrcode-container {
    max-width: 200px;
    margin: 0 auto;
    background-color: white;
    padding: 10px;
    border-radius: 5px;
}

.qrcode-container img {
    width: 100%;
    height: auto;
}

.empregabilidade-button {
    display: inline-block;
    padding: 15px 30px;
    background-color: var(--text-light);
    color: var(--primary-color);
    font-weight: bold;
    text-decoration: none;
    border-radius: 30px;
    text-transform: uppercase;
    font-size: 1rem;
    transition: all 0.3s ease;
    border: 2px solid var(--text-light);
}

.empregabilidade-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    background-color: rgba(255, 255, 255, 0.9);
}

.empregabilidade-button-outline {
    background-color: transparent;
    color: var(--text-light);
}

.empregabilidade-button-outline:hover {
    background-color: rgba(255, 255, 255, 0.2);
}

/* Estilos gerais da seção */
.recursos-section {
    background-color: #f8f9fa;
    padding: 60px 0;
}

.section-heading {
    text-align: center;
    margin-bottom: 40px;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--primary-color);
    position: relative;
    display: inline-block;
    padding-bottom: 15px;
}

.section-title:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background-color: var(--primary-light); 
}

/* Grid de recursos */
.recursos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 30px;
}

/* Cards de recurso */
.recurso-card {
    background-color: white;
    border-radius: 10px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.recurso-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

/* Ícones */
.recurso-icon {
    width: 80px;
    height: 80px;
    background-color: var(--primary-light); 
    border-radius: 50%;
    margin: 0 auto 20px;
    color: var(--text-light);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.recurso-card:hover .recurso-icon {
    background-color: var(--primary-color);
    color: white;
}

/* Estilos dos ícones bootstrap */
.recurso-icon i {
    font-size: 2.5rem;
    color:var(--primary-color);
    transition: all 0.3s ease;
}

.recurso-card:hover .recurso-icon i {
    color: white;
}

/* Título do recurso */
.recurso-title {
    font-size: 1.2rem;
    font-weight: bold;
    margin-bottom: 20px;
    color: #333;
    flex: 1;
    line-height: 1.4;
}

/* Link do recurso */
.recurso-link {
    display: inline-block;
    padding: 10px 20px;
    background-color: var(--primary-color);
    color: white;
    text-decoration: none;
    border-radius: 30px;
    margin-top: 15px;
    transition: all 0.3s ease;
    font-weight: 500;
}

.recurso-link:hover {
    background-color:  var(--primary-color);
    transform: translateY(-3px);
}

/* Responsividade */
@media (max-width: 992px) {
    .section-title {
        font-size: 2rem;
    }
    
    .recursos-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    }
}

@media (max-width: 768px) {
    .section-title {
        font-size: 1.8rem;
    }
    
    .recursos-grid {
        gap: 20px;
    }
    
    .recurso-card {
        padding: 20px;
    }
    
    .recurso-icon {
        width: 70px;
        height: 70px;
    }
    
    .recurso-icon i {
        font-size: 2rem;
    }
    
    .recurso-title {
        font-size: 1.1rem;
    }
}

@media (max-width: 576px) {
    .section-title {
        font-size: 1.5rem;
    }
    
    .recursos-grid {
        grid-template-columns: 1fr;
    }
    
    .recurso-icon {
        width: 60px;
        height: 60px;
    }
    
    .recurso-icon i {
        font-size: 1.8rem;
    }
}

/* Plataforma Section */
.plataforma-section {
    background: url('../images/background-pattern.png') center center;
    background-size: cover;
    padding: 100px 0;
    position: relative;
    color: var(--text-light);
}

.plataforma-section:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--accent-color) 100%);
    opacity: 0.9;
}

.plataforma-content {
    position: relative;
    z-index: 1;
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.plataforma-title {
    font-size: 3rem;
    font-weight: bold;
    margin-bottom: 30px;
}

.plataforma-description {
    font-size: 1.3rem;
    margin-bottom: 40px;
    line-height: 1.6;
}

.plataforma-action .empregabilidade-button {
    font-size: 1.2rem;
    padding: 18px 40px;
}

/* Saiba Mais Section */
.saiba-mais-section {
    background-color: var(--background-light);
    padding: 80px 0;
}

.saiba-mais-container {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 50px;
}

.saiba-mais-image {
    flex: 1;
    min-width: 300px;
    height: 400px;
    background-color: var(--primary-light);
    border-radius: 10px;
    overflow: hidden;
    background: url('../images/student-success.jpg') center center;
    background-size: cover;
}

.saiba-mais-content {
    flex: 1;
    min-width: 300px;
}

.saiba-mais-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: var(--primary-dark);
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 15px;
}

.saiba-mais-title:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 3px;
    background-color: var(--accent-color);
}

.saiba-mais-description {
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 30px;
    color: var(--text-dark);
}

.saiba-mais-action .empregabilidade-button {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.saiba-mais-action .empregabilidade-button:hover {
    background-color: var(--primary-dark);
    border-color: var(--primary-dark);
}

/* Ações Section */
.acoes-section {
    background-color: white;
    padding: 80px 0;
}

.acoes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 30px;
}

.acao-card {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
    border-radius: 10px;
    padding: 40px 30px;
    text-align: center;
    color: white;
    transition: all 0.3s ease;
}

.acao-card:hover {
    transform: scale(1.03);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.acao-title {
    font-size: 1.3rem;
    font-weight: bold;
    margin-bottom: 25px;
}

.acao-button {
    display: inline-block;
    padding: 12px 25px;
    background-color: white;
    color: var(--primary-color);
    text-decoration: none;
    border-radius: 30px;
    font-weight: bold;
    transition: all 0.3s ease;
}

.acao-button:hover {
    background-color: rgba(255, 255, 255, 0.9);
    transform: translateY(-3px);
}

/* Contato Section */
.contato-section {
    background-color: var(--background-dark);
    padding: 80px 0;
}

.contato-container {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 50px;
}

.contato-info {
    flex: 1;
    min-width: 300px;
    background-color: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.contato-title {
    font-size: 2.2rem;
    font-weight: bold;
    color: var(--primary-dark);
    margin-bottom: 30px;
    text-align: center;
}

.contato-details {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.contato-item h3 {
    font-size: 1.2rem;
    font-weight: bold;
    color: var(--primary-color);
    margin-bottom: 5px;
}

.contato-item p {
    font-size: 1.1rem;
    color: var(--text-dark);
}

.contato-image {
    flex: 1;
    min-width: 300px;
    height: 350px;
    background-color: var(--primary-light);
    border-radius: 10px;
    overflow: hidden;
    background: url('../images/contact-image.jpg') center center;
    background-size: cover;
}

/* Responsividade */
@media (max-width: 992px) {
    .section {
        padding: 50px 0;
    }
    
    .banner-title {
        font-size: 2.5rem;
    }
    
    .banner-description {
        font-size: 1.5rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .plataforma-title {
        font-size: 2.5rem;
    }
    
    .plataforma-description {
        font-size: 1.1rem;
    }
    
    .saiba-mais-title {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .section {
        padding: 40px 0;
    }
    
    .empregabilidade-banner {
        flex-direction: column;
    }
    
    .banner-content {
        text-align: center;
    }
    
    .banner-buttons {
        justify-content: center;
    }
    
    .banner-title {
        font-size: 2rem;
    }
    
    .banner-description {
        font-size: 1.2rem;
    }
    
    .recursos-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    }
    
    .plataforma-title {
        font-size: 2rem;
    }
    
    .plataforma-description {
        font-size: 1rem;
    }
    
    .saiba-mais-image {
        height: 300px;
    }
    
    .saiba-mais-title {
        font-size: 1.8rem;
    }
}

@media (max-width: 576px) {
    .section {
        padding: 30px 0;
    }
    
    .banner-title {
        font-size: 1.8rem;
    }
    
    .banner-description {
        font-size: 1rem;
    }
    
    .banner-qrcode {
        width: 100%;
    }
    
    .section-title {
        font-size: 1.5rem;
    }
    
    .recursos-grid {
        grid-template-columns: 1fr;
    }
    
    .acoes-grid {
        grid-template-columns: 1fr;
    }
    
    .plataforma-title {
        font-size: 1.8rem;
    }
    
    .saiba-mais-title {
        font-size: 1.5rem;
    }
    
    .contato-info {
        padding: 20px;
    }
    
    .contato-title {
        font-size: 1.8rem;
    }
}

/* Estilos para documentos (já incluídos anteriormente) */
.documentos-section {
    padding: 40px 0;
    background-color: #f9f9f9;
}

.documentos-container {
    margin-top: 30px;
}

.documentos-grupo {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 30px;
}

.documentos-grupo-titulo {
    background-color: var(--primary-color);
    color: white;
    padding: 15px 20px;
    margin: 0;
    font-size: 18px;
    font-weight: 500;
}

.documentos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 15px;
    padding: 20px;
}

.documento-item {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    background-color: #f5f5f5;
    border-radius: 6px;
    transition: all 0.3s ease;
    text-decoration: none;
    color: #333;
    border: 1px solid #e0e0e0;
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
    
    <!-- Banner de Destaque - Nova Seção -->
    <section class="section empregabilidade-banner-section">
        <div class="container">
            <div class="empregabilidade-banner">
                <div class="banner-content">
                    <h2 class="banner-title">Conheça nossa plataforma</h2>
                    <p class="banner-description">Queremos promover você!</p>
                    <div class="banner-buttons">
                        <a href="#plataforma" class="empregabilidade-button">Acessar Plataforma</a>
                        <a href="#recursos" class="empregabilidade-button empregabilidade-button-outline">Conhecer Recursos</a>
                    </div>
                </div>
                <div class="banner-qrcode">
                    <h3>DESCUBRA O NOSSO INSTAGRAM!</h3>
                    <div class="qrcode-container">
                        <img src="https://unifsmhomologacao.devosalliance.com.br/wp-content/uploads/2025/03/Captura-de-tela-2025-03-11-164258.webp" alt="QR Code do Instagram" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sobre o Núcleo - Conteúdo Principal -->
    <section class="section">
        <div class="container">
            <div class="spacing">
                <div class="text-justify text-gray-600">
                    <?php echo wpautop(wp_kses_post(get_field('sobre') ?: "O Núcleo de Empregabilidade, Inovação e Empreendedorismo (NUEIE) do Centro Universitário Santa Maria foi um setor institucionalizado em agosto de 2018, e que tem todas as suas ações norteadas por um Regulamento próprio. Formado por uma coordenação e os chamados alunos colaboradores, esse setor tem como finalidade precípua direcionar a comunidade acadêmica e egressos da Instituição ao mundo do trabalho e da cidadania, por meio de ações que visam obter vagas de estágio extracurricular, emprego e formação continuada e permanente para os mesmos. Na busca por alcance de resultados, o NUEIE tem como norte estratégico identificar, abrir diálogo com empresas do setor público, privado e Terceiro Setor e obter informações de mercado, visando formar profissionais cada vez mais qualificados para o exercício de suas atribuições.")); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Principais Recursos - Nova Seção -->
    <section id="recursos" class="section recursos-section">
        <div class="container">
            <div class="section-heading">
                <h2 class="section-title">PRINCIPAIS RECURSOS</h2>
            </div>
            <div class="recursos-grid">
                <div class="recurso-card">
                    <div class="recurso-icon">
                        <i class="bi bi-building"></i>
                    </div>
                    <h3 class="recurso-title">CONVÊNIO E PARCERIA COM OUTRAS EMPRESAS E INSTITUIÇÕES DA REGIÃO</h3>
                    <a href="#convenios" class="recurso-link">Saiba mais</a>
                </div>
                <div class="recurso-card">
                    <div class="recurso-icon">
                        <i class="bi bi-star"></i>
                    </div>
                    <h3 class="recurso-title">JORNADAS QUE INSPIRAM</h3>
                    <a href="#jornadas" class="recurso-link">Saiba mais</a>
                </div>
                <div class="recurso-card">
                    <div class="recurso-icon">
                        <i class="bi bi-tools"></i>
                    </div>
                    <h3 class="recurso-title">OFICINAS E QUALIFICAÇÕES</h3>
                    <a href="#oficinas" class="recurso-link">Saiba mais</a>
                </div>
                <div class="recurso-card">
                    <div class="recurso-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3 class="recurso-title">ACOMPANHAMENTO DE EGRESSOS</h3>
                    <a href="#egressos" class="recurso-link">Saiba mais</a>
                </div>
                <div class="recurso-card">
                    <div class="recurso-icon">
                        <i class="bi bi-mortarboard"></i>
                    </div>
                    <h3 class="recurso-title">SOLICITAÇÃO DE MONITORIA PARA DESENVOLVIMENTO DE SUCESSO ACADÊMICO</h3>
                    <a href="#monitoria" class="recurso-link">Saiba mais</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Plataforma e Portal - Nova Seção -->
    <section id="plataforma" class="section plataforma-section">
        <div class="container">
            <div class="plataforma-content">
                <h2 class="plataforma-title">SUA JORNADA DE SUCESSO COMEÇA AQUI!</h2>
                <p class="plataforma-description">O Portal do Núcleo de Empregabilidade está disponível para consulta e cadastro de alunos, egressos e empresas. Além do acesso on-line, o campus oferece serviços gratuitos aos interessados.</p>
                <div class="plataforma-action">
                    <a href="https://portal.unifsm.edu.br/empregabilidade" class="empregabilidade-button" target="_blank">ENTRE EM CONTATO CONOSCO</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Saiba Mais - Nova Seção -->
    <section class="section saiba-mais-section">
        <div class="container">
            <div class="saiba-mais-container">
                <div class="saiba-mais-content">
                    <h2 class="saiba-mais-title">SAIBA MAIS</h2>
                    <p class="saiba-mais-description">O Núcleo de Empregabilidade e Empreendedorismo proporciona orientação e apoio aos alunos e ex-alunos da instituição, potencializando a formação profissional, favorecendo o acesso ao mercado de trabalho e promovendo a cultura empreendedora</p>
                    <div class="saiba-mais-action">
                        <a href="#mais-info" class="empregabilidade-button">SAIBA MAIS</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Principais Ações - Nova Seção -->
    <section class="section acoes-section">
        <div class="container">
            <div class="section-heading">
                <h2 class="section-title">PRINCIPAIS AÇÕES</h2>
            </div>
            <div class="acoes-grid">
                <div class="acao-card">
                    <h3 class="acao-title">CONHEÇA O CAFÉ EMPREENDEDOR</h3>
                    <a href="#cafe-empreendedor" class="acao-button">CLICK AQUI</a>
                </div>
                <div class="acao-card">
                    <h3 class="acao-title">CONHEÇA O MULTIPLICANDO COMPETÊNCIAS</h3>
                    <a href="#multiplicando" class="acao-button">CLICK AQUI</a>
                </div>
                <div class="acao-card">
                    <h3 class="acao-title">CONHEÇA NOSSAS HISTÓRIAS DE SUCESSO</h3>
                    <a href="#historias" class="acao-button">CLICK AQUI</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção de Setores (Equipe) -->
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

    <!-- Contato - Nova Seção -->
    <section id="contato" class="section contato-section">
        <div class="container">
            <div class="contato-container">
                <div class="contato-info">
                    <h2 class="contato-title">FALE CONOSCO</h2>
                    <div class="contato-details">
                        <div class="contato-item">
                            <h3>TELEFONE</h3>
                            <p>(83) 99306-4363</p>
                        </div>
                        <div class="contato-item">
                            <h3>E-MAIL</h3>
                            <p>empregabilidade@unifsm.edu.br</p>
                        </div>
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