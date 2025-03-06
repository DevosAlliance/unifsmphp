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

            .accordion__title {
                font-size: 1.5rem;
                font-weight: 600;
                text-align: center;
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
                            <?php echo wpautop(wp_kses_post(get_field('sobre') ?: "")); ?>
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
                                            src="<?php echo esc_url(!empty($pessoa['foto']) ? $pessoa['foto']['url'] : get_template_directory_uri() . '/src/assets/images/FOTOSINFORMATIVAS.jpeg'); ?>" loading="lazy" />
                                        <p><?php echo esc_html($pessoa['nome']); ?></p>
                                        <span><?php echo esc_html($pessoa['cargo']); ?></span>
                                        <?php if (!empty($pessoa['e-mail'])) : ?>
                                            <span><?php echo esc_html($pessoa['e-mail']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ($count % 3 == 0) echo '<span style="width: 100%;"></span>'; // Quebra a linha a cada 3 pessoas 
                                    ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

            <section class="section">
                <div class="container">
                    <h5 class="spacing accordion__title">Dúvidas e Perguntas Frequentes</h5>
                    <div class="accordion">
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <span>Sobre o Educa Sertão</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="accordion-content">
                                <p>O educa sertão é um financiamento institucional, que assemelha-se ao FIES, ou seja, o aluno pagará 50% do valor da mensalidade ao longo do curso e o restante após concluir. É necessário apresentar documentação com renda comprovada para um mantenedor* e dois fiadores.</p>
                                <p>* O mantenedor é a pessoa que arca com suas despesas.</p>
                                <p>A renda tem que ser de no mínimo 01 salário mínimo. Depois disso, estando a documentação toda ok, é enviado a uma comissão para análise da concessão do financiamento.</p>
                                <p>A primeira matrícula o valor é integral e as demais com 50%.</p>
                                <p>O financiamento não pode haver atrasos nos boletos mensais.</p>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-header">
                                <span>Sobre o valor que será pago após a conclusão do curso:</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="accordion-content">
                                <p>* O valor dos 50% que vai ser pago ao final do curso é SEM juros;</p>
                                <p>* Se o aluno desistir/abandonar pagará o valor que foi utilizado durante o período de imediato.</p>
                                <p>* O pagamento inicia-se logo que conclui o curso.</p>
                                <p>* O parcelamento será feito no mesmo período de tempo utilizado.</p>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-header">
                                <span>O valor acumulado ao longo do curso é pago como?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="accordion-content">
                                <p>O valor acumulado é resultado dos 50% restante do valor da mensalidade somada ao longo do curso sem juros, e será parcelado sem juros para pagamento no mesmo período de tempo em que foi utilizado o financiamento.</p>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-header">
                                <span>Possui carência para o início do pagamento?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="accordion-content">
                                <p>Não possui carência para início do pagamento do restante acumulado.</p>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-header">
                                <span>Documentos Necessários</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="accordion-content">
                                <p>Procurar o setor para solicitar a lista da documentação e forma de envio.</p>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-header">
                                <span>Trancamento/Transferência/Abandono do curso.</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="accordion-content">
                                <p>Nesses casos o aluno irá efetuar o pagamento do valor acumulado de imediato.</p>
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
                    </div>
                </div>
            </section>

        </main>

<?php
    endwhile;
endif;

get_footer();
?>
