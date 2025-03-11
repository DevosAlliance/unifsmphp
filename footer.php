
<?php
// Obtém os dados da UNIFSM

?>
            
            <footer class="footer">
                <div class="f__container">
                    <div class="f__info">
                        <div class="f__logo">
                            <img
                                src="<?php echo get_template_directory_uri(); ?>/src/assets/images/logo-footer.png"
                                alt="Logo da UNIFSM"
                                loading="lazy"
                            />
                        </div>

                        <div class="f__contacts">
                            <a href="tel:<?php echo esc_attr(get_field('telefone', 'option')); ?>">
                                <i class="ri-phone-line"></i>
                                <?php echo esc_html(get_field('telefone', 'option')); ?>
                            </a>

                            <a href="mailto:<?php echo esc_attr(get_field('e-mail', 'option')); ?>">
                                <i class="ri-mail-line"></i>
                                <?php echo esc_html(get_field('e-mail', 'option')); ?>
                            </a>

                            <a>
                                <i class="ri-map-pin-line"></i>
                                <?php echo esc_html(get_field('endereco', 'option')); ?>
                            </a>

                            <div class="f__contacts__icons">
                                <a href="<?php echo esc_url(get_field('youtube', 'option')); ?>" target="_blank" rel="noopener noreferrer">
                                    <i class="ri-youtube-fill"></i>
                                </a>
                                <a href="<?php echo esc_url(get_field('instagram', 'option')); ?>" target="_blank" rel="noopener noreferrer">
                                    <i class="ri-instagram-fill"></i>
                                </a>
                                <a href="<?php echo esc_url(get_field('tiktok', 'option')); ?>" target="_blank" rel="noopener noreferrer">
                                    <i class="ri-tiktok-line"></i>
                                </a>
                            </div>
                        </div>

                        <div class="f__qrcode">
                            <img src="<?php echo get_template_directory_uri(); ?>/src/assets/images/qrcode.png" alt="QR Code" loading="lazy" />
                        </div>
                    </div>

                    <div class="f_menu">
                        <div class="f_data">
                        <h5 class="f_item">Institucional</h5>
                        <ul class="f_list">
                            <li><a href="#">UNIFSM</a></li>
                            <li><a href="#">Reitoria</a></li>
                            <li><a href="#">Administração/Financeiro/RH</a></li>
                            <li><a href="#">Secretaria Acadêmica</a></li>
                            <li><a href="#">Biblioteca</a></li>
                            <li><a href="#">CPA - Comissão Própria de Avaliação</a></li>
                            <li><a href="#">NAE</a></li>
                            <li><a href="#">Serviços Gerais</a></li>
                            <li><a href="#">Laboratórios</a></li>
                            <li><a href="#">Tecnologia da Informação</a></li>
                            <li><a href="#">Ouvidoria</a></li>
                            <li><a href="#">Localização</a></li>
                        </ul>
                        </div>
                        <div class="f_data">
                        <h5 class="f_item">Serviços</h5>
                        <ul class="f_list">
                            <li><a href="#">Clínica Santa Maria</a></li>
                            <li><a href="#">Visita Guiada</a></li>
                            <li><a href="#">Núcleo de Empregabilidade, Inovação e Empreendedorismo</a></li>
                        </ul>
                        </div>
                    </div>

                    <div class="f_menu">
                        <div class="f_data">
                        <h5 class="f_item">Acadêmico</h5>
                        <ul class="f_list">
                            <li><a href="#">Vestibular</a></li>
                            <li><a href="#">Calendário 2025.1 Cursos 
                            Presenciais</a></li>
                            <li><a href="#">Financiamentos</a></li>
                            <li><a href="#">Bolsas</a></li>
                            <li><a href="#">Fies / Prouni</a></li>
                            <li><a href="#">CEP</a></li>
                            <li><a href="#">TCC</a></li>
                            <li><a href="#">Monitoria</a></li>
                            <li><a href="#">CEUA</a></li>
                            <li><a href="#">Documentos</a></li>
                        </ul>
                        </div>
                        <div class="f_data">
                        <h5 class="f_item">Cursos</h5>
                        <ul class="f_list">
                            <li><a href="#">Presencial</a></li>
                            <li><a href="#">Cursos Digitais</a></li>
                            <li><a href="#">Pós-Graduação</a></li>
                        </ul>
                        </div>
                    </div>
                    
                    <div class="f_menu">
                        <div class="f_data">
                        <h5 class="f_item">Pró-Reitorias</h5>
                        <ul class="f_list">
                            <li><a href="#">Pró-Reitoria de Graduação</a></li>
                            <li><a href="#">Pró-Reitoria de EAD (NEaD)</a></li>
                            <li><a href="#">Pró-Reitoria de Pesquisa e extensão</a></li>
                            <li><a href="#">Pró-Reitoria de Pós-Graduação</a></li>
                        </ul>
                        </div>
                        <div class="f_data">
                        <ul class="f_list">
                            <li><a href="#">Portal do Aluno</a></li>
                            <li><a href="#">Portal do Aluno EAD</a></li>
                            <li><a href="#">Portal do Professor</a></li>
                        </ul>
                        </div>
                    </div>
                </div>
            </footer>

            <div class="b_footer">
                <div class="b_footer_content">
                    <span>&copy; <?php echo date('Y'); ?> - Centro Universitário Santa Maria. CNPJ  03.945.249/0001-68</span>
                </div>
            </div>
            <div class="b_footer">
                <div class="b_footer_content">
                    <span  span class="devos" style="display: inline-block;">Desenvolvido por <a href="https://devosalliance.com" style="color: #0096fa; text-decoration: none; transition: color 0.3s;">Devos Tecnologia</a></span>
                </div>
            </div>

        <?php wp_footer(); ?>

        <!-- Custom -->
        <script src="<?php echo get_template_directory_uri(); ?>/src/assets/js/main.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/src/assets/js/tabs.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/src/assets/js/accordion.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/src/assets/js/carousel.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/src/assets/js/slider.js"></script>
        <script>
            (function () {
                window.onload = function () {
                    new BlipChat()
                        .withAppKey('dW5pZm1zcm91dGVyOjU4YmI1ZmQ1LTM4MjktNDc0NS04OTcwLWI2ZmMwNTliZmE5NQ==')
                        .withButton({"color":"#0096fa","icon":"https://blipmediastore.blip.ai/public-medias/Media_e9c3f759-f24f-4731-bf55-9bc949a995c4"})
                        .withCustomCommonUrl('https://fsm.chat.blip.ai/')
                        .build();
                    }
             })();
        </script>
    </body>
</html>
