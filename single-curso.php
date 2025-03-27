<?php
get_header();

if (have_posts()) :
  while (have_posts()) : the_post();
    $duracao = get_field('duracao');
    $modalidade = get_field('modalidade');
    $nome_curso = get_field('nome_curso');
    $email_coordenacao = get_field('email_coordenacao');
    $semestres = get_field('semestres');
    $tipo = get_field('tipo');
    $periodo = get_field('periodo');
    $email = get_field('email');
    $carga_horaria = get_field('carga_horaria');
    $edital = get_field('edital');
    $sobre = get_field('sobre');
    $valor = get_field('valor');
    $matriz_curricular = get_field('matriz_curricular');
?>

    <style>
      .i__presentation__img {
        height: 350px;
        max-height: 100%;
      }

      .video__presentation {
        height: 100%;
      }

      .cta {
        height: auto;
      }

      .cta a {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .cta a img {
        width: 100%;
        height: 100%;
        max-width: 100%;
        max-height: 100%;
        border-radius: 50px;
      }

      @media screen and (max-width: 1024px) {
        .i__presentation__img {
          height: 250px;
        }
      }

      @media screen and (max-width: 768px) {
        .i__presentation__img {
          height: 180px;
        }
      }

      @media screen and (max-width: 500px) {
        .cta a img {
          border-radius: 25px;
        }
      }

      @media screen and (max-width: 375px) {
        .i__presentation__img {
          height: 150px;
        }
      }
    </style>

    <main class="main">
      <section class="section">
        <div class="title__box">
          <div class="courses__title tb__title">
            <h2><?php echo esc_html($nome_curso); ?></h2>
            <h4><?php echo esc_html($tipo); ?>: <?php echo esc_html($semestres); ?></h4>
            <h5><?php echo esc_html($modalidade); ?> | <?php echo esc_html($periodo); ?></h5>
            <h6><?php echo esc_html($email); ?></h6>
          </div>
          <div class="courses__btns">
            <button class="cs__btn" onclick="window.open('<?php echo esc_html($matriz_curricular); ?>', '_blank')">
              Matriz Curricular <span><?php echo esc_html($carga_horaria); ?> horas</span>
            </button>
            <button id="btnModal" class="cs__btn">Investimento</button>
          </div>
        </div>
      </section>

      <section class="section">
        <div class="div__container i__accordion">
          <?php
          // Consulta para recuperar os posts do CPT "info-curso"
          $infoCursos = new WP_Query(array(
            'post_type'      => 'info-curso',
            'posts_per_page' => -1,
            'title'          => 'info-cursos',
          ));

          if ($infoCursos->have_posts()) :
            while ($infoCursos->have_posts()) : $infoCursos->the_post();

              // Verifica se o campo 'item' existe e tem dados
              if (have_rows('item')) :
                while (have_rows('item')) : the_row();
                  $item_menu = get_sub_field('item_menu');
                  $itens = get_sub_field('itens');

                  // Exibe o título do acordeão
                  echo '<div class="accordion">';
                  echo '<div class="a__title">';
                  echo '<span>' . esc_html($item_menu) . '</span>';
                  echo '<i class="ri-arrow-drop-down-line"></i>';
                  echo '</div>';

                  // Exibe os links dos itens associados
                  if ($itens) {
                    echo '<div class="a__btns"><ul>';
                    foreach ($itens as $item) {
                      $nome = $item['nome'];
                      $link = $item['link'];
                      echo '<li><a href="' . esc_url($link) . '">' . esc_html($nome) . ' <i class="ri-arrow-right-up-line"></i></a></li>';
                    }
                    echo '</ul></div>';
                  }

                  echo '</div>';
                endwhile;
              endif;

            endwhile;
            wp_reset_postdata();
          else :
            echo '<p>Nenhuma informação encontrada.</p>';
          endif;
          ?>
        </div>
      </section>

      <section class="about__course">
        <div class="ac_container">
          <div class="title__container">
            <h5 class="title">Sobre o Curso</h5>
          </div>
          <div class="ac_text">
            <p>
              <?php echo esc_html($sobre); ?>
            </p>
          </div>
        </div>
      </section>

      <section class="section">
        <div class="container course__container">
          <div class="advisor">
            <?php if (have_rows('estrutura_academica')) : ?>
              <?php while (have_rows('estrutura_academica')) : the_row();
                $nome_coordenador = get_sub_field('nome_do_coordenador');
                $foto_coordenador = get_sub_field('foto_do_coordenador');
                $descricao_coordenador = get_sub_field('descricao_do_coordenador');
              ?>
                <div class="a__advisor">
                  <div class="a__img">
                    <img src="<?php echo esc_url($foto_coordenador ?: get_template_directory_uri() . '/src/assets/images/orientador.png'); ?>"
                      alt="<?php echo esc_attr($nome_coordenador); ?>" loading="lazy" />
                  </div>
                  <div class="a__about">
                    <div class="a__name">
                      <div>
                        <h4><?php echo esc_html($nome_coordenador); ?></h4>
                        <h6>Coordenador(a)</h6>
                      </div>
                      <div class="a__text">
                        <?php if ($descricao_coordenador) : ?>
                          <?php foreach (explode("\n", $descricao_coordenador) as $linha) : ?>
                            <p><?php echo esc_html(trim($linha)); ?></p>
                          <?php endforeach; ?>
                        <?php else : ?>
                          <p>Descrição não disponível.</p>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endwhile; ?>
            <?php else : ?>
              <p class="text-gray-500">Nenhum coordenador encontrado.</p>
            <?php endif; ?>
          </div>

          <div class="faculty">
            <div class="title__container">
              <h5 class="title title--white">Corpo Docente</h5>
            </div>
            <div class="faculty__grid">
              <?php if (have_rows('estrutura_academica_copiar')) : ?>
                <?php while (have_rows('estrutura_academica_copiar')) : the_row();
                  $nome_docente = get_sub_field('nome');
                  $descricao_docente = get_sub_field('descricao');
                  $lattes = get_sub_field('lattes');
                ?>
                  <div class="faculty__card">
                    <div class="fc__content">
                      <div class="fc__infos">
                        <h5><?php echo esc_html($nome_docente); ?></h5>
                        <div>
                          <?php if ($descricao_docente) : ?>
                            <?php foreach (explode("\n", $descricao_docente) as $linha) : ?>
                              <p><?php echo esc_html(trim($linha)); ?></p>
                            <?php endforeach; ?>
                          <?php else : ?>
                            <p>Descrição não disponível.</p>
                          <?php endif; ?>
                        </div>
                      </div>
                      <div class="fc__link">
                        <?php if ($lattes) : ?>
                          <a class="black--color" href="<?php echo esc_url($lattes); ?>" target="_blank">
                            Currículo Lattes <i class="ri-arrow-right-up-line"></i>
                          </a>
                        <?php else : ?>
                          <p>Sem link disponível.</p>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                <?php endwhile; ?>
              <?php else : ?>
                <p class="text-gray-500">Nenhum docente encontrado.</p>
              <?php endif; ?>
            </div>
          </div>

          <div class="cta">
            <a href="https://wa.me/558331427476">
              <img src="<?php echo esc_attr(get_field('cta', 'option')); ?>">
            </a>
          </div>
        </div>
      </section>

      <section class="section">
        <div class="div__container i__presentation">
          <div class="i__presentation__img">
            <!--<img src="<?php echo esc_attr(get_field('foto_unifsm', 'option')); ?>" alt="" />-->
            <iframe width="100%" class="video__presentation" src="<?php echo esc_attr(get_field('video_cursos', 'option')); ?>" title="VESTIBULAR DE MEDICINA 2024.2" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
          </div>
          <div class="i__presentation__content">
            <h5>Estude na UNIFSM</h5>
            <p>
              <?php echo esc_html(get_field('sobre_nos_resumido', 'option')); ?>
            </p>
          </div>
        </div>
      </section>
    </main>


    <!-- Modal Investimento Form -->
    <div id="modalInvestimento" class="modal">
      <div class="modal-content">
        <form id="leadForm">
          <input type="hidden" id="course_name" value="<?php echo esc_html($nome_curso); ?>" />
          <div class="modal__header">
            <div class="mh_title">
              <div class="mh_logo">
                <img src="<?php echo get_template_directory_uri(); ?>/src/assets/images/logo-modal.png" alt="" loading="lazy" />
              </div>
              <div>
                <h5>Investimento</h5>
                <p>Informe seus dados para ver o valor do curso.</p>
              </div>
            </div>
            <div class="close closeInvestimento"><i class="ri-close-large-line"></i></div>
          </div>
          <div class="modal__content">
            <div>
              <div class="input__group">
                <label for="firstname">Nome: </label>
                <input type="text" name="firstname" id="firstname" required />
              </div>
              <div class="input__group">
                <label for="lastname">Sobrenome: </label>
                <input type="text" name="lastname" id="lastname" required />
              </div>
            </div>
            <div>
              <div class="input__group f-2">
                <label for="email">E-mail: </label>
                <input type="email" name="email" id="email" required />
              </div>
              <div class="input__group f-1">
                <label for="tel">Telefone: </label>
                <input type="tel" name="tel" id="tel" required />
              </div>
            </div>
          </div>
          <div class="mc__radio">
            <input type="checkbox" name="agree" id="agree" required />
            <label for="agree">
              Estou ciente e concordo que meus dados serão coletados e utilizados para promover serviços educacionais.
            </label>
          </div>
          <div class="modal__footer">
            <button type="submit" id="btnOrcamento" class="cs__btn">Ver investimento</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal Investimento Valor -->
    <div id="modalOrcamento" class="modal">
      <div class="modal-content">
        <div class="modal__header">
          <div class="mh_title">
            <div class="mh_logo">
              <img src="<?php echo get_template_directory_uri(); ?>/src/assets/images/logo-modal.png" alt="" loading="lazy" />
            </div>
            <div>
              <h5>Investimento</h5>
            </div>
          </div>
          <div class="close closeOrcamento"><i class="ri-close-large-line"></i></div>
        </div>
        <div class="m__content">
          <h4>R$ <?php echo esc_html($valor); ?><span>/mês</span></h4>
          <p>** Valor para pagamento até o dia 7 de cada mês.</p>
        </div>
        <div class="m__footer">
          <button>Fale Conosco</button>
        </div>
      </div>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const leadForm = document.getElementById("leadForm");
        const modalInvestimento = document.getElementById("modalInvestimento");
        const modalOrcamento = document.getElementById("modalOrcamento");
        const closeInvestimento = document.querySelector(".closeInvestimento");
        const closeOrcamento = document.querySelector(".closeOrcamento");
        const btnModal = document.getElementById("btnModal");

        // **Função para abrir modal de investimento**
        if (btnModal) {
          btnModal.addEventListener("click", function() {
            modalInvestimento.style.display = "block";
          });
        }

        // **Fechar modal de investimento**
        if (closeInvestimento) {
          closeInvestimento.addEventListener("click", function() {
            modalInvestimento.style.display = "none";
          });
        }

        // **Fechar modal de orçamento**
        if (closeOrcamento) {
          closeOrcamento.addEventListener("click", function() {
            modalOrcamento.style.display = "none";
          });
        }

        // **Fechar modal ao clicar fora**
        window.addEventListener("click", function(event) {
          if (event.target === modalInvestimento) modalInvestimento.style.display = "none";
          if (event.target === modalOrcamento) modalOrcamento.style.display = "none";
        });

        // **Lógica de validação e envio AJAX**
        leadForm.addEventListener("submit", function(e) {
          e.preventDefault(); // Impede o envio padrão do formulário

          // **Captura os valores do formulário**
          const course_name = document.getElementById("course_name").value.trim();
          const firstname = document.getElementById("firstname").value.trim();
          const lastname = document.getElementById("lastname").value.trim();
          const email = document.getElementById("email").value.trim();
          const tel = document.getElementById("tel").value.trim();
          const agree = document.getElementById("agree").checked ? "Sim" : "Não";

          // **Validações**
          if (!firstname || !lastname || !email || !tel || agree !== "Sim") {
            alert("⚠️ Todos os campos são obrigatórios. Preencha antes de continuar.");
            return;
          }

          // **Valida e-mail**
          if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
            alert("⚠️ Informe um e-mail válido.");
            return;
          }

          // **Formata os dados para envio**
          const formData = new FormData();
          formData.append("action", "send_lead_email");
          formData.append("course_name", course_name);
          formData.append("firstname", firstname);
          formData.append("lastname", lastname);
          formData.append("email", email);
          formData.append("tel", tel);
          formData.append("agree", agree);

          // **Faz a requisição AJAX**
          fetch("<?php echo admin_url('admin-ajax.php'); ?>", {
              method: "POST",
              body: formData,
            })
            .then((response) => response.json())
            .then((result) => {
              // alert(result.message);
              if (result.success) {
                leadForm.reset(); // **Limpa o formulário**
                modalInvestimento.style.display = "none"; // **Fecha modal de investimento**
                modalOrcamento.style.display = "block"; // **Abre modal de orçamento**
              }
            })
            .catch((error) => {
              console.error("Erro:", error);
              alert("❌ Erro no envio do formulário. Tente novamente.");
            });
        });
      });
    </script>




<?php
  endwhile;
endif;

get_footer();
?>
