<?php
/**
 * Template Name: biblioteca
 */
get_header();
?>
    <main class="main">
      <section class="section">
        <div class="title__box">
          <div class="tb__title">
            <h2>Biblioteca</h2>
          </div>
        </div>
      </section>
      <section class="section">
        <div class="container r_container">
          <div class="b__container">
            <div class="b__card">
              <h4>Informações e dúvidas frequentes</h4>
              <div>
                <h5>Horário de Funcionamento:</h5>
                <p>De Segunda à Sexta, das 07h às 22h00.</p>
              </div>
            </div>
            <div class="b__card">
              <h4>Biblioteca Física</h4>
              <div>
                <h5>Para Cadastrar</h5>
                <p>
                  Dirija-se ao balcão de atendimento da Biblioteca Júlio
                  Goldfarb de posse do número da sua matrícula. (Obs.: não
                  precisa foto 3x4)
                </p>
              </div>
            </div>
            <div class="b__card span__row">
              <h4>Biblioteca Virtual:</h4>
              <div class="col">
                <div>
                    <h5>Para Cadastrar</h5>
                    <p>
                      Para ter acesso a Biblioteca Virtual solicite seu cadastro
                      através do e-mail: biblioteca@unifsm.edu.br ou dirija-se até a
                      biblioteca, informando o número da sua matrícula.
                    </p>
                  </div>
                  <div>
                    <h5>Para Acessar</h5>
                    <a href="#">https://dliportal.zbra.com.br/Login.aspx?key=FSM</a>
                    <p>Usuário: matrícula Senha: data de nascimento</p>
                  </div>
              </div>
            </div>
            <div class="b__card">
              <h4>Renovações dos livros</h4>
              <div>
                <h5>Acesse o link:</h5>
                <a href="#">https://web.siabi.cloud/FSM/</a>
                <p>
                  Usuário: matrícula Senha: (use sua senha pessoal com 6 números
                  criada no ato do cadastro)
                </p>
              </div>
            </div>
            <div class="b__card">
              <h4>Empréstimos</h4>
              <div>
                <p>
                  Até 3 livros e 3 atlas com prazo de 7 dias, podendo fazer mais
                  2 renovações com o mesmo prazo do empréstimo (caso não tenha
                  reserva).
                </p>
              </div>
            </div>
            <div class="b__card span__column">
              <h4>Multas</h4>
              <div>
                <h5>Caso atrase o prazo de devolução do livro</h5>
                <p>Será cobrado multa de R$ 0,50 centavos por dia/livro</p>
                <p>Será cobrado multa de R$ 1,00 real por dia/ atlas</p>
              </div>
            </div>
            <div class="b__card">
              <h4>Repositório institucional</h4>
              <div>
                <h5>
                  Os Trabalhos de Conclusão de Curso (TCC) encontram-se no
                  Repositório Institucional do UNIFSM no link:
                </h5>
                <a href="#">https://fsm.i10bibliotecas.com.br/</a>
              </div>
            </div>
            <div class="b__card span__column-3">
              <h4>Ficha catalográfica</h4>
              <div>
                <h5>
                    Aos alunos que não publicarem seu TCC, é necessário solicitar a elaboração da ficha catalográfica.
                </h5>
                <div class="bc__row">
                    <div>
                        <h5>1°</h5>
                        <p>Envie o formulário preenchido com os dados do seu TCC para o e-mail da biblioteca, fsm.biblioteca@gmail.com</p>
                    </div>
                    <div>
                        <h5>2°</h5>
                        <p>O formulário de solicitação da ficha catalográfica:</p>
                        <a href="#" class="a__yellow">CLIQUE AQUI</a>
                    </div>
                    <div>
                        <h5>3°</h5>
                        <p>A biblioteca tem o prazo de até 48h úteis para elaboração e envio da ficha catalográfica por e-mail.</p>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>


    <!-- Custom -->
    <script src="<?php echo get_template_directory_uri(); ?>/src/assets/js/main.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/src/assets/js/tabs.js"></script>
<?php get_footer(); ?>
