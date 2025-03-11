<?php
/**
 * Template Name: Editais
 * 
 * Template responsivo para exibição de editais com filtro por mês/ano.
 */
get_header();

// Pegar todos os editais do ACF Options
$editais = get_field('documento', 'option');

// Organizar os editais por data (mais recente primeiro)
if (!empty($editais)) {
    usort($editais, function($a, $b) {
        $date_a = DateTime::createFromFormat('m/Y', $a['data']);
        $date_b = DateTime::createFromFormat('m/Y', $b['data']);
        return $date_b <=> $date_a;
    });
    
    // Agrupar editais por mês/ano para facilitar a filtragem
    $editais_por_data = array();
    foreach ($editais as $edital) {
        if (!empty($edital['data'])) {
            if (!isset($editais_por_data[$edital['data']])) {
                $editais_por_data[$edital['data']] = array();
            }
            $editais_por_data[$edital['data']][] = $edital;
        }
    }
}

// Extrair todos os meses/anos disponíveis para o filtro
$datas_disponiveis = array();
if (!empty($editais)) {
    foreach ($editais as $edital) {
        if (!empty($edital['data'])) {
            $datas_disponiveis[$edital['data']] = $edital['data'];
        }
    }
    // Ordenar datas em ordem decrescente (mais recente primeiro)
    krsort($datas_disponiveis);
}

// Adicionar estilos customizados
wp_enqueue_style('editais-style', get_template_directory_uri() . '/assets/css/editais.css', array(), '1.0.0');
?>

<main class="main">
    <section class="section">
        <div class="title__box">
            <div class="tb__title">
                <h2>Editais</h2>
            </div>
        </div>
    </section>

    <section class="section">
            <!-- Filtro de mês/ano -->
            <div class="editais__filtro">
                <h5 class="title">Filtrar por data</h5>
                <div class="editais__filtro-form">
                    <select id="filtro-data" class="editais__select">
                        <option value="todos">Todos os editais</option>
                        <?php foreach ($datas_disponiveis as $data) : ?>
                            <option value="<?php echo esc_attr($data); ?>"><?php echo esc_html($data); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button id="btn-filtrar" class="editais__btn">Filtrar</button>
                    <button id="btn-limpar" class="editais__btn editais__btn--secundario">Limpar filtro</button>
                </div>
            </div>

            <!-- Contador de resultados -->
            <div id="contador-resultados" class="editais__contador">
                Exibindo <span id="num-resultados"><?php echo count($editais); ?></span> editais
            </div>

            <!-- Lista de editais - Tabela para desktop -->
            <div class="editais__lista-desktop">
                <?php if (!empty($editais)) : ?>
                    <div class="editais__tabela-container">
                        <table class="editais__tabela">
                            <thead>
                                <tr>
                                    <th class="editais__th-nome">Nome</th>
                                    <th class="editais__th-data">Data</th>
                                    <th class="editais__th-acao">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($editais as $edital) : ?>
                                    <tr class="edital-item" data-data="<?php echo esc_attr($edital['data']); ?>">
                                        <td class="editais__td-nome"><?php echo esc_html($edital['nome']); ?></td>
                                        <td class="editais__td-data"><?php echo esc_html($edital['data']); ?></td>
                                        <td class="editais__td-acao">
                                            <?php if (!empty($edital['arquivo'])) : ?>
                                                <a href="<?php echo esc_url($edital['arquivo']['url']); ?>" target="_blank" class="editais__download">
                                                    <span class="editais__icon">📄</span> Visualizar
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <p class="u_text">Nenhum edital disponível no momento.</p>
                <?php endif; ?>
            </div>

            <!-- Lista de editais - Cards para mobile -->
            <div class="editais__lista-mobile">
                <?php if (!empty($editais)) : ?>
                    <?php foreach ($editais as $edital) : ?>
                        <div class="edital-card" data-data="<?php echo esc_attr($edital['data']); ?>">
                            <div class="edital-card__header">
                                <h3 class="edital-card__title"><?php echo esc_html($edital['nome']); ?></h3>
                                <span class="edital-card__date"><?php echo esc_html($edital['data']); ?></span>
                            </div>
                            <?php if (!empty($edital['arquivo'])) : ?>
                                <a href="<?php echo esc_url($edital['arquivo']['url']); ?>" target="_blank" class="edital-card__download">
                                    <span class="edital-card__icon">📄</span> Visualizar Edital
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="u_text">Nenhum edital disponível no momento.</p>
                <?php endif; ?>
            </div>

            <!-- Mensagem de sem resultados (inicialmente escondida) -->
            <div id="sem-resultados" class="sem-resultados" style="display: none;">
                <p>Nenhum edital encontrado para o período selecionado.</p>
                <button id="btn-mostrar-todos" class="editais__btn">Mostrar todos os editais</button>
            </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filtroSelect = document.getElementById('filtro-data');
    const btnFiltrar = document.getElementById('btn-filtrar');
    const btnLimpar = document.getElementById('btn-limpar');
    const btnMostrarTodos = document.getElementById('btn-mostrar-todos');
    const editaisItems = document.querySelectorAll('.edital-item');
    const editaisCards = document.querySelectorAll('.edital-card');
    const semResultados = document.getElementById('sem-resultados');
    const numResultados = document.getElementById('num-resultados');
    
    // Função para filtrar os editais
    function filtrarEditais() {
        const valorFiltro = filtroSelect.value;
        let resultadosEncontrados = 0;
        
        // Filtrar itens na tabela (desktop)
        editaisItems.forEach(item => {
            const dataEdital = item.getAttribute('data-data');
            
            if (valorFiltro === 'todos' || dataEdital === valorFiltro) {
                item.style.display = 'table-row';
                resultadosEncontrados++;
            } else {
                item.style.display = 'none';
            }
        });
        
        // Filtrar cards (mobile)
        editaisCards.forEach(card => {
            const dataEdital = card.getAttribute('data-data');
            
            if (valorFiltro === 'todos' || dataEdital === valorFiltro) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
        
        // Atualizar contador de resultados
        numResultados.textContent = resultadosEncontrados;
        
        // Mostrar ou esconder mensagem de "sem resultados"
        if (resultadosEncontrados > 0) {
            semResultados.style.display = 'none';
        } else {
            semResultados.style.display = 'block';
        }
    }
    
    // Função para limpar filtros
    function limparFiltros() {
        filtroSelect.value = 'todos';
        
        // Mostrar todos os itens
        editaisItems.forEach(item => {
            item.style.display = 'table-row';
        });
        
        editaisCards.forEach(card => {
            card.style.display = 'block';
        });
        
        // Atualizar contador e esconder mensagem
        numResultados.textContent = editaisItems.length;
        semResultados.style.display = 'none';
    }

    // Evento de clique no botão filtrar
    btnFiltrar.addEventListener('click', filtrarEditais);
    
    // Evento de clique no botão limpar
    btnLimpar.addEventListener('click', limparFiltros);
    
    // Evento de clique no botão mostrar todos
    btnMostrarTodos.addEventListener('click', limparFiltros);

    // Opcional: filtrar também quando mudar o select
    filtroSelect.addEventListener('change', function() {
        if (this.value === 'todos') {
            limparFiltros();
        }
    });
    
    // Garantir que o contador esteja correto ao carregar a página
    numResultados.textContent = editaisItems.length;
});
</script>

<?php get_footer(); ?>