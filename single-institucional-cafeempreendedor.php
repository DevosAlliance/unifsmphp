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
            .grid__videos {
                width: 100%;
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                grid-template-rows: auto;
                gap: 2rem;
                margin-top: 1rem;
            }

            .grid__videos__tile {
                font-size: 1.5rem;
                font-weight: 600;
                text-align: center;
            }

            .grid__videos div {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .grid__videos div iframe {
                width: 100%;
                max-width: 100%;
                height: 310px;
            }

            .grid__videos div h5 {
                font-size: 1rem;
                font-weight: 400;
                padding: 0.5rem;
            }

            @media screen and (max-width: 1024px) {
                .grid__videos {
                    gap: 1rem;
                }
            }

            @media screen and (max-width: 768px) {
                .grid__videos div iframe {
                    height: 200px;
                }
            }

            @media screen and (max-width: 600px) {
                .grid__videos {
                    grid-template-columns: repeat(1, 1fr);
                }

                .grid__videos div iframe {
                    height: 250px;
                }
            }

            @media screen and (max-width: 425px) {
                .grid__videos div iframe {
                    height: 190px;
                }
            }

            @media screen and (max-width: 320px) {
                .grid__videos div iframe {
                    height: 150px;
                }
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

            <section class="section">
                <div class="container">
                    <h5 class="grid__videos__tile">Nossos Convidados</h5>
                    <div class="grid__videos">
                        <div>
                            <iframe src="https://www.youtube.com/embed/9xFc4fUhB44" title="Café Empreendedor - Convidado Daniel Beltrammi" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h5>Daniel Beltrammi</h5>
                        </div>
                        <div>
                            <iframe src="https://www.youtube.com/embed/h83KemLGFLM" title="Café Empreendedor com Maitê Proença" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h5>Maitê Proença</h5>
                        </div>
                        <div>
                            <iframe src="https://www.youtube.com/embed/EVIC2LIFa1s" title="Café Empreendedor com Helio de la Peña" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h5>Helio de La Peña</h5>
                        </div>
                        <div>
                            <iframe src="https://www.youtube.com/embed/0bBmRM-igRA" title="Café Empreendedor com Prof. Dr. Roberto Kalil Filho" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h5>Roberto Kalil Filho</h5>
                        </div>
                        <div>
                            <iframe src="https://www.youtube.com/embed/PgmO-IIz73E" title="Café Empreendedor com Rossandro Klinjey" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h5>Rossandro Klinjey</h5>
                        </div>
                        <div>
                            <iframe src="https://www.youtube.com/embed/LdrS1Z-8crg" title="Café Empreendedor com Rodrigo Alvarez" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h5>Rodrigo Alvarez</h5>
                        </div>
                        <div>
                            <iframe src="https://www.youtube.com/embed/WrnLjO2fdD0" title="Café Empreendedor com André Vieira" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h5>André Vieira</h5>
                        </div>
                        <div>
                            <iframe src="https://www.youtube.com/embed/1iOxLhpMtLo" title="Café Empreendedor com Laura Fuks" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h5>Laura Fuks</h5>
                        </div>
                        <div>
                            <iframe src="https://www.youtube.com/embed/OCIa_GqhWlg" title="Café Empreendedor com Claudio Shen" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h5>Claudio Shen</h5>
                        </div>
                        <div>
                            <iframe src="https://www.youtube.com/embed/KuRAbzXexmQ" title="Café Empreendedor com Matheus Nogueira" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h5>Matheus Nogueira</h5>
                        </div>
                        <div>
                            <iframe src="https://www.youtube.com/embed/qWMw7uI2sRM" title="Café Empreendedor com Eduardo Alves" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h5>Eduardo Alves</h5>
                        </div>
                        <div>
                            <iframe src="https://www.youtube.com/embed/VvMhlVo08Do" title="Café Empreendedor com Márcio Oricolli Jr." frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h5>Márcio Oricolli Jr.</h5>
                        </div>
                        <div>
                            <iframe src="https://www.youtube.com/embed/HtBpIWCI-e0" title="Café Empreendedor com Raquel e Ítalo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h5>Raquel Michele e Ítalo Félix</h5>
                        </div>
                        <div>
                            <iframe src="https://www.youtube.com/embed/I-RGO7MJfdQ" title="Café Empreendedor com Luciana Albuquerque" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h5>Luciana Albuquerque</h5>
                        </div>
                        <div>
                            <iframe src="https://www.youtube.com/embed/22UDHM9Mye8" title="Café com Sandro Magaldi" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h5>Sandro Magaldi</h5>
                        </div>
                        <div>
                            <iframe src="https://www.youtube.com/embed/yHewwheSmoM" title="Café Empreendor com Marcelo Braga" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h5>Marcelo Braga</h5>
                        </div>
                        <div>
                            <iframe src="https://www.youtube.com/embed/W99G-K8w0Fg" title="Café Empreendedor com Gilmário Cajá" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h5>Gilmário Cajá</h5>
                        </div>
                        <div>
                            <iframe src="https://www.youtube.com/embed/7gaIxIxsMrM" title="Café Empreendedor com Dra. Chris Cavalcante" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h5>Chris Cavalcante</h5>
                        </div>
                        <div>
                            <iframe src="https://www.youtube.com/embed/Br0MdHLYQBo" title="CAFÉ EMPREENDEDOR COM ALEX GARCIA" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h5>Alex Garcia</h5>
                        </div>
                        <div>
                            <iframe src="https://www.youtube.com/embed/gv_iW7XhnXM" title="Café Empreendedor com João Victor da Silva Xavier" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h5>João Victor</h5>
                        </div>
                        <div>
                            <iframe src="https://www.youtube.com/embed/f9nFv7XeOBY" title="CAFÉ EMPREENDEDOR - ANNA LÍVIA" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h5>Anna Lívia</h5>
                        </div>
                        <div>
                            <iframe src="https://www.youtube.com/embed/8nEFqe-vsR4" title="CAFÉ EMPREENDEDOR COM ANA PAULA CASTRO" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h5>Ana Paula</h5>
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
