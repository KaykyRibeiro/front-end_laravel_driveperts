@php
    $tipo = request('tipo');

    $opcoesEntrada = [
        'COMPRA' => 'Compra',
        'DEVOLUCAO' => 'Devolução',
        'OUTROS' => 'Outros'
    ];

    $opcoesSaida = [
        'VENDA' => 'Venda',
        'DEFEITO' => 'Defeito',
        'PERDA' => 'Perda',
        'VENCIMENTO' => 'Vencimento',
        'USO_E_CONSUMO' => 'Uso e Consumo',
    ];
@endphp

<div class="mt-8">
    
    <!-- Cabeçalho da Seção -->
    <div class="flex justify-between items-end mb-6">
        <div>
            <h2 class="text-xl font-bold text-white tracking-wide">Últimas Movimentações</h2>
            <p class="text-sm text-gray-500 mt-1">Acompanhe as entradas e saídas recentes do caixa.</p>
        </div>
        <!-- Nova Movimentação Dropdown -->
        <div class="relative group">
            <button 
                onclick="toggleFilter('dropdown-nova-mov')"
                class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-orange-500 border border-orange-500 text-white hover:bg-orange-600 hover:border-orange-600 transition-colors font-semibold shadow-lg shadow-orange-500/20">
                <i class="fas fa-plus"></i> Nova Movimentação
                <i class="fas fa-chevron-down text-[10px] ml-1 opacity-80"></i>
            </button>
            <div id="dropdown-nova-mov" class="hidden absolute right-0 mt-2 w-48 bg-[#141414] border border-[#2a2a2a] rounded-xl shadow-xl overflow-hidden z-50">
                <a href="{{ request()->url() }}?tipo=ENTRADA" class="flex items-center gap-2 w-full text-left px-4 py-3 text-sm text-emerald-500 hover:text-emerald-400 hover:bg-[#1a1a1a] transition-colors font-medium border-b border-[#1f1f1f]">
                    <i class="fas fa-arrow-up text-xs"></i> Nova Entrada
                </a>
                <a href="{{ request()->url() }}?tipo=SAIDA" class="flex items-center gap-2 w-full text-left px-4 py-3 text-sm text-red-500 hover:text-red-400 hover:bg-[#1a1a1a] transition-colors font-medium">
                    <i class="fas fa-arrow-down text-xs"></i> Nova Saída
                </a>
            </div>
        </div>
    </div>

    <!-- Barra de Pesquisa e Filtros -->
    <div class="flex flex-col lg:flex-row justify-between items-center gap-4 bg-[#141414] border border-[#2a2a2a] p-4 rounded-2xl relative z-20">
        
        <!-- Search Bar -->
        <div class="relative w-full lg:w-96">
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                <i class="fas fa-search text-gray-500"></i>
            </div>
            <input type="text" id="searchInput" onkeyup="filterTable()" class="bg-[#0A0A0A] border border-[#2a2a2a] text-gray-300 text-sm rounded-xl focus:ring-1 focus:ring-orange-500 focus:border-orange-500 block w-full pl-11 p-3 outline-none transition-all duration-300 placeholder-gray-600" placeholder="Buscar por descrição ou valor...">
        </div>

        <!-- Filtros -->
        <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto pb-1 lg:pb-0">
            <span class="text-sm text-gray-500 font-medium mr-1 whitespace-nowrap">Filtrar por:</span>
            
            <!-- Dropdown: Data -->
            <div class="relative group">
                <button onclick="toggleFilter('dropdown-data')" class="flex items-center gap-2 bg-[#0A0A0A] border border-[#2a2a2a] text-gray-400 hover:text-white hover:border-orange-500/50 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-300 whitespace-nowrap">
                    <i class="fas fa-calendar-alt text-gray-500 group-hover:text-orange-500 transition-colors"></i>
                    Data
                    <i class="fas fa-chevron-down text-[10px] ml-1 opacity-50"></i>
                </button>
                <div id="dropdown-data" class="hidden absolute right-0 mt-2 w-40 bg-[#141414] border border-[#2a2a2a] rounded-xl shadow-xl overflow-hidden z-50">
                    <button class="w-full text-left px-4 py-2.5 text-sm text-gray-400 hover:text-white hover:bg-[#1a1a1a] transition-colors">Hoje</button>
                    <button class="w-full text-left px-4 py-2.5 text-sm text-gray-400 hover:text-white hover:bg-[#1a1a1a] transition-colors">Últimos 7 dias</button>
                    <button class="w-full text-left px-4 py-2.5 text-sm text-gray-400 hover:text-white hover:bg-[#1a1a1a] transition-colors">Este Mês</button>
                </div>
            </div>
            
            <!-- Dropdown: Tipo -->
            <div class="relative group">
                <button onclick="toggleFilter('dropdown-tipo')" class="flex items-center gap-2 bg-[#0A0A0A] border border-[#2a2a2a] text-gray-400 hover:text-white hover:border-orange-500/50 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-300 whitespace-nowrap">
                    <i class="fas fa-filter text-gray-500 group-hover:text-orange-500 transition-colors"></i>
                    <span id="label-tipo">Tipo</span>
                    <i class="fas fa-chevron-down text-[10px] ml-1 opacity-50"></i>
                </button>
                <div id="dropdown-tipo" class="hidden absolute right-0 mt-2 w-40 bg-[#141414] border border-[#2a2a2a] rounded-xl shadow-xl overflow-hidden z-50">
                    <button onclick="applyFilterTipo('Todos')" class="w-full text-left px-4 py-2.5 text-sm text-gray-400 hover:text-white hover:bg-[#1a1a1a] transition-colors">Todos</button>
                    <button onclick="applyFilterTipo('Entrada')" class="w-full text-left px-4 py-2.5 text-sm text-emerald-500 hover:text-emerald-400 hover:bg-[#1a1a1a] transition-colors">Entradas</button>
                    <button onclick="applyFilterTipo('Saída')" class="w-full text-left px-4 py-2.5 text-sm text-red-500 hover:text-red-400 hover:bg-[#1a1a1a] transition-colors">Saídas</button>
                </div>
            </div>
            
            <!-- Dropdown: Valor -->
            <div class="relative group">
                <button onclick="toggleFilter('dropdown-valor')" class="flex items-center gap-2 bg-[#0A0A0A] border border-[#2a2a2a] text-gray-400 hover:text-white hover:border-orange-500/50 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-300 whitespace-nowrap">
                    <i class="fas fa-dollar-sign text-gray-500 group-hover:text-orange-500 transition-colors"></i>
                    Valor
                    <i class="fas fa-chevron-down text-[10px] ml-1 opacity-50"></i>
                </button>
                <div id="dropdown-valor" class="hidden absolute right-0 mt-2 w-48 bg-[#141414] border border-[#2a2a2a] rounded-xl shadow-xl overflow-hidden z-50">
                    <button onclick="applySortValor('desc')" class="w-full text-left px-4 py-2.5 text-sm text-gray-400 hover:text-white hover:bg-[#1a1a1a] transition-colors">Maior para Menor</button>
                    <button onclick="applySortValor('asc')" class="w-full text-left px-4 py-2.5 text-sm text-gray-400 hover:text-white hover:bg-[#1a1a1a] transition-colors">Menor para Maior</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabela de Movimentações -->
    <div class="mt-6 overflow-hidden rounded-2xl border border-[#2a2a2a] bg-[#0A0A0A] relative z-10 flex flex-col">
        <div class="overflow-auto max-h-[600px] scrollbar-thin scrollbar-thumb-[#2a2a2a] scrollbar-track-transparent">
            <table class="w-full text-left text-sm text-gray-400 whitespace-nowrap relative" id="movimentacoesTable">
                <thead class="bg-[#141414] text-xs uppercase text-gray-500 border-b border-[#2a2a2a] sticky top-0 z-20" id="table-head">
                    <!-- Gerado dinamicamente via JS -->
                </thead>
                <tbody class="divide-y divide-[#1f1f1f]">
                    @foreach($movimentacoes as $mov)
                        <tr class="hover:bg-[#141414] transition-colors">
                            {{-- Produto --}}
                            <td class="px-6 py-4 text-gray-300">
                                {{ $mov->produto->pro_nome ?? 'Produto removido' }}
                            </td>

                            {{-- Tipo --}}
                            <td class="px-6 py-4">
                                @if($mov->mov_tipo === 'COMPRA' || $mov->mov_tipo === 'DEVOLUCAO' || $mov->mov_tipo === 'OUTROS')
                                    <span class="text-emerald-500 font-semibold">{{ $mov->mov_tipo }}</span>
                                @else
                                    <span class="text-red-500 font-semibold">{{ $mov->mov_tipo }}</span>
                                @endif
                            </td>

                            {{-- Quantidade --}}
                            <td class="px-6 py-4 text-white">
                                {{ $mov->mov_qtd }}
                            </td>

                            {{-- Data --}}
                            <td class="px-6 py-4 text-gray-500">
                                {{ \Carbon\Carbon::parse($mov->mov_data)->format('d/m/Y H:i') }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Rodapé da Tabela -->
        <div class="px-6 py-4 border-t border-[#1f1f1f] bg-[#0A0A0A] flex justify-between items-center text-sm">
            <span class="text-gray-500" id="table-footer-text">Mostrando resultados...</span>
            <div class="flex gap-2">
                <button onclick="prevPage()" id="btn-prev" class="px-3 py-1.5 rounded-lg bg-[#141414] border border-[#2a2a2a] text-gray-400 hover:text-white hover:border-orange-500/50 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                    Anterior
                </button>
                <button onclick="nextPage()" id="btn-next" class="px-3 py-1.5 rounded-lg bg-[#141414] border border-[#2a2a2a] text-gray-400 hover:text-white hover:border-orange-500/50 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    Próxima
                </button>
            </div>
        </div>
    </div>
    <!-- Modal Nova Movimentação -->
    <div id="modal-movimentacao" class="{{ request('tipo') ? 'flex' : 'hidden' }} fixed inset-0 z-[100] flex items-center justify-center">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeModal('modal-movimentacao')"></div>
        
        <!-- Modal Content -->
        <div class="bg-[#141414] border border-[#2a2a2a] rounded-2xl shadow-2xl w-full max-w-md relative z-10 overflow-hidden transform transition-all">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-[#2a2a2a] flex justify-between items-center bg-[#0A0A0A]">
                <h3 id="modal-title" class="text-lg font-bold text-white flex items-center gap-2">
                    <!-- Title injected via JS -->
                </h3>
                <button onclick="closeModal('modal-movimentacao')" class="text-gray-500 hover:text-white transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="px-6 space-y-4">
                <!--  Busca de Produto -->
                    <div>

                        <label class="block text-sm font-medium text-gray-400 mb-1">
                            Buscar Produto
                        </label>

                        <form method="GET" action="{{ route('produto-buscar') }}" class="flex gap-2">
                            <input type="hidden" name="tipo" value="{{ request('tipo') }}">

                            <input type="text" name="busca_produto" value="{{ request('busca_produto') }}" class="w-85 bg-[#0A0A0A] border border-[#2a2a2a] text-white rounded-xl focus:ring-1 focus:ring-orange-500 focus:border-orange-500 p-3 outline-none transition-all placeholder-gray-600" placeholder="Digite nome ou código do produto...">

                            <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded-xl hover:bg-orange-600 transition-colors">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>

                        <!-- Produtos encontrados -->
                        

                    </div>
            </div>
            <!-- Body -->
             <form method="POST" action="{{ route('movimentacoes-store') }}">
                @csrf
                @if(isset($produtosEncontrados) && count($produtosEncontrados) > 0)

                            <div class="mt-5 px-6">
                                <select name="pro_id" class="w-full bg-[#0A0A0A] border border-[#2a2a2a] text-white rounded-xl p-3 outline-none focus:ring-1 focus:ring-orange-500 focus:border-orange-500">

                                    <option value="">
                                        Selecione um produto
                                    </option>

                                    @foreach($produtosEncontrados as $produto)
                                        <option value="{{ Crypt::encryptString($produto->pro_id) }}">
                                            {{ $produto->pro_nome }}
                                            - Código: {{ $produto->pro_cod }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                        @elseif(request('busca_produto'))

                            <p class="text-sm text-red-400 mt-2">
                                Nenhum produto encontrado.
                            </p>

                        @endif
                
                <div class="p-6 space-y-4">

                    <!-- TIpo da movimentação -->
                    <input type="hidden" name="tipo" value="{{ $tipo }}">

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">
                            Tipo de Movimentação
                        </label>

                        <!-- PAREI NA PARTE DE MUDAR O NOME DO CAMPO mov_tipo NO SELECT -->
                        <select name="mov_tipo" class="w-full bg-[#0A0A0A] border border-[#2a2a2a] text-white rounded-xl focus:ring-1 focus:ring-orange-500 focus:border-orange-500 p-3 outline-none transition-all">
                            <option value="" disabled selected>
                                Selecione o tipo de movimentação
                            </option>

                            @if($tipo === 'ENTRADA')

                                @foreach($opcoesEntrada as $valor => $label)

                                    <option value="{{ $valor }}">
                                        {{ $label }}
                                    </option>

                                @endforeach

                            @elseif($tipo === 'SAIDA')

                                @foreach($opcoesSaida as $valor => $label)

                                    <option value="{{ $valor }}">
                                        {{ $label }}
                                    </option>

                                @endforeach

                            @endif

                        </select>
                    </div>

                    

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">
                                Quantidade
                            </label>

                            <input type="number" name="mov_qtd" step="1" min="1" class="w-full bg-[#0A0A0A] border border-[#2a2a2a] text-white rounded-xl focus:ring-1 focus:ring-orange-500 focus:border-orange-500 p-3 outline-none transition-all placeholder-gray-600" placeholder="00">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">
                                Data e Hora
                            </label>

                            <input type="datetime-local" name="mov_data" style="color-scheme: dark;" class="w-full bg-[#0A0A0A] border border-[#2a2a2a] text-white rounded-xl focus:ring-1 focus:ring-orange-500 focus:border-orange-500 p-3 outline-none transition-all text-sm">
                        </div>
                    </div>
                </div>
            
            
            <!-- Footer -->
            <div class="px-6 py-4 border-t border-[#2a2a2a] bg-[#0A0A0A] flex justify-end gap-3">
                <button onclick="closeModal('modal-movimentacao')" class="px-4 py-2 rounded-xl text-gray-400 hover:text-white transition-colors font-medium">
                    Cancelar
                </button>
                <!-- <button type="submit" id="btn-save-mov" class="px-6 py-2 rounded-xl text-white font-semibold shadow-lg transition-all">
                    Salvar
                </button> -->
                <button type="submit" id="btn-save-mov" class="px-6 py-2 rounded-xl text-white font-semibold shadow-lg transition-all bg-emerald-500 hover:bg-emerald-600 shadow-emerald-500/20">
                    Salvar
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Configurações e Dados fornecidos
    const cols = ["produto", "tipo", "quantidade", "data"];
   

    const colLabels = {
        "tipo": "Tipo",
        "descricao": "Descrição",
        "data": "Data e Hora",
        "valor": "Valor"
    };

    // Estado dos filtros e paginação
    let currentFiltroTipo = 'Todos';
    let currentSortValor = null;
    let currentPage = 1;
    const itemsPerPage = 8;

    // Inicializa a tabela
    function initTable() {
        renderHead();
        filterAndRenderTable();
    }

    // Renderiza o cabeçalho baseado no array "cols"
    function renderHead() {
        const thead = document.getElementById('table-head');
        let html = '<tr>';
        cols.forEach(col => {
            const alignClass = col === 'valor' ? 'text-right' : 'text-left';
            html += `<th scope="col" class="px-6 py-4 font-semibold tracking-wider ${alignClass}">${colLabels[col] || col}</th>`;
        });
        html += '</tr>';
        thead.innerHTML = html;
    }

    // Utilitários de formatação
    function formatDateTime(dateStr) {
        if (!dateStr) return '';
        // Substitui espaço por T para garantir o parse correto no Javascript
        const d = new Date(dateStr.replace(' ', 'T'));
        if (isNaN(d)) return dateStr;
        const dia = String(d.getDate()).padStart(2, '0');
        const meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
        const mes = meses[d.getMonth()];
        const ano = d.getFullYear();
        const hora = String(d.getHours()).padStart(2, '0');
        const min = String(d.getMinutes()).padStart(2, '0');
        return `${dia} ${mes} ${ano} <span class="text-gray-600 ml-1">${hora}:${min}</span>`;
    }

    function formatCurrency(val, tipo) {
        const sign = tipo === 'Entrada' ? '+' : '-';
        const colorClass = tipo === 'Entrada' ? 'text-emerald-500' : 'text-red-500';
        const formatted = new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(val);
        return `<span class="${colorClass} font-semibold text-base val-field" data-raw="${val}">${sign} ${formatted}</span>`;
    }

    function getBadge(tipo) {
        if (tipo === 'Entrada') {
            return `<span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 group-hover:bg-emerald-500/20 transition-colors">
                        <i class="fas fa-arrow-up text-[10px]"></i> Entrada
                    </span>`;
        } else {
            return `<span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-medium bg-red-500/10 text-red-500 border border-red-500/20 group-hover:bg-red-500/20 transition-colors">
                        <i class="fas fa-arrow-down text-[10px]"></i> Saída
                    </span>`;
        }
    }

    // Renderiza e filtra as linhas baseado no array "dataList" e "cols"
    function filterAndRenderTable() {
        const searchInput = document.getElementById('searchInput') ? document.getElementById('searchInput').value.toLowerCase() : '';
        
        let filteredData = dataList.filter(item => {
            const desc = (item.descricao || '').toLowerCase();
            const val = (item.valor || '').toString().toLowerCase();
            
            const matchesSearch = desc.includes(searchInput) || val.includes(searchInput);
            const matchesTipo = (currentFiltroTipo === 'Todos' || item.tipo === currentFiltroTipo);
            
            return matchesSearch && matchesTipo;
        });

        // Ordenação por valor
        if (currentSortValor) {
            filteredData.sort((a, b) => {
                return currentSortValor === 'asc' ? a.valor - b.valor : b.valor - a.valor;
            });
        }

        // Lógica de Paginação
        const totalItems = filteredData.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage) || 1;
        
        // Garante que a página atual não ultrapasse o limite caso o filtro diminua os resultados
        if (currentPage > totalPages) {
            currentPage = 1;
        }

        const startIndex = (currentPage - 1) * itemsPerPage;
        const paginatedData = filteredData.slice(startIndex, startIndex + itemsPerPage);

        const tbody = document.getElementById('table-body');
        let html = '';

        paginatedData.forEach(item => {
            html += `<tr class="hover:bg-[#141414] transition-colors duration-200 group cursor-pointer" data-tipo="${item.tipo}" data-valor="${item.valor}">`;
            
            cols.forEach(col => {
                if (col === 'tipo') {
                    html += `<td class="px-6 py-4">${getBadge(item.tipo)}</td>`;
                } else if (col === 'descricao') {
                    html += `<td class="px-6 py-4 font-medium text-gray-300 group-hover:text-white transition-colors desc-field">${item.descricao}</td>`;
                } else if (col === 'data') {
                    html += `<td class="px-6 py-4 text-gray-500">${formatDateTime(item.data)}</td>`;
                } else if (col === 'valor') {
                    html += `<td class="px-6 py-4 text-right">${formatCurrency(item.valor, item.tipo)}</td>`;
                }
            });
            html += `</tr>`;
        });

        tbody.innerHTML = html;
        
        // Atualiza textos e estado dos botões
        const endItem = Math.min(startIndex + itemsPerPage, totalItems);
        document.getElementById('table-footer-text').innerHTML = 
            `Mostrando <span class="text-white font-medium">${totalItems === 0 ? 0 : startIndex + 1}</span> a <span class="text-white font-medium">${endItem}</span> de <span class="text-white font-medium">${totalItems}</span> resultados`;

        document.getElementById('btn-prev').disabled = currentPage === 1;
        document.getElementById('btn-next').disabled = currentPage >= totalPages;
    }

    // Funções de navegação de página
    function prevPage() {
        if (currentPage > 1) {
            currentPage--;
            filterAndRenderTable();
        }
    }

    function nextPage() {
        // Assume que a verificação de limite máximo é feita no botão disabled
        currentPage++;
        filterAndRenderTable();
    }

    // Atualiza campo de busca
    function filterTable() {
        currentPage = 1; // Reseta para primeira página
        filterAndRenderTable();
    }

    // Controle dos Menus Suspensos de Filtro
    function toggleFilter(dropdownId) {
        document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
            if (el.id !== dropdownId) el.classList.add('hidden');
        });
        document.getElementById(dropdownId).classList.toggle('hidden');
    }

    function applyFilterTipo(tipo) {
        currentFiltroTipo = tipo;
        currentPage = 1; // Reseta para primeira página
        document.getElementById('label-tipo').innerText = tipo === 'Todos' ? 'Tipo' : tipo;
        document.getElementById('dropdown-tipo').classList.add('hidden');
        filterAndRenderTable();
    }

    function applySortValor(order) {
        currentSortValor = order;
        currentPage = 1; // Reseta para primeira página
        document.getElementById('dropdown-valor').classList.add('hidden');
        filterAndRenderTable();
    }

    document.addEventListener('click', function(event) {
        const isClickInside = event.target.closest('.group');
        if (!isClickInside) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(el => el.classList.add('hidden'));
        }
    });

    // Funções do Modal de Nova Movimentação
    function openModalMovimentacao(tipo) {
        // Fechar dropdowns abertos
        document.querySelectorAll('[id^="dropdown-"]').forEach(el => el.classList.add('hidden'));

        const modal = document.getElementById('modal-movimentacao');
        const title = document.getElementById('modal-title');
        const btnSave = document.getElementById('btn-save-mov');
        const inputTipo = document.getElementById('mov-tipo');
        
        // Reset inputs
        document.getElementById('mov-desc').value = '';
        document.getElementById('mov-valor').value = '';
        
        // Set current datetime
        const now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        document.getElementById('mov-data').value = now.toISOString().slice(0,16);

        inputTipo.value = tipo;

        if (tipo === 'Entrada') {
            title.innerHTML = '<i class="fas fa-arrow-up text-emerald-500"></i> Nova Entrada';
            btnSave.className = 'px-6 py-2 rounded-xl text-white font-semibold shadow-lg transition-all bg-emerald-500 hover:bg-emerald-600 shadow-emerald-500/20';
        } else {
            title.innerHTML = '<i class="fas fa-arrow-down text-red-500"></i> Nova Saída';
            btnSave.className = 'px-6 py-2 rounded-xl text-white font-semibold shadow-lg transition-all bg-red-500 hover:bg-red-600 shadow-red-500/20';
        }

        modal.classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    function saveMovimentacao() {
        const tipo = document.getElementById('mov-tipo').value;
        const desc = document.getElementById('mov-desc').value;
        const valor = parseFloat(document.getElementById('mov-valor').value);
        let data = document.getElementById('mov-data').value;
        
        if (!desc || isNaN(valor)) {
            alert('Preencha a descrição e o valor!');
            return;
        }

        // Transforma '2026-05-19T14:30' em '2026-05-19 14:30:00'
        data = data.replace('T', ' ') + ':00';

        // Add to dataList (simulating a database insert at the top)
        dataList.unshift({
            tipo: tipo,
            descricao: desc,
            data: data,
            valor: valor
        });

        closeModal('modal-movimentacao');
        
        // Retorna para a página 1 e renderiza
        currentPage = 1;
        filterAndRenderTable();
    }

    // Inicia a renderização ao carregar a página
    initTable();
</script>