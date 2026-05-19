<nav class="bg-[#0A0A0A] border-r border-[#1f1f1f] w-54 flex flex-col justify-between min-h-screen font-base relative shadow-2xl">
    
    <!-- Efeito de brilho de fundo (Glass/Glow) -->
    <div class="absolute top-0 left-0 w-full h-40 bg-orange-500/5 blur-[80px] pointer-events-none"></div>

    <!-- Logo -->
    <div class="pt-8 pb-4 px-6 relative z-10 flex flex-col items-center border-b border-[#1f1f1f]/50 mb-4">
        <img src="{{ asset('assets/logo-orange-full.png') }}" alt="Logo" class="w-10/12 mx-auto cursor-pointer object-contain hover:scale-105 transition-transform duration-300 drop-shadow-[0_0_10px_rgba(249,115,22,0.2)]" onclick="window.location.href='/catalogo'">
    </div>

    <!-- Links do Menu -->
    <div class="flex flex-col flex-1 px-4 gap-1 overflow-y-auto scrollbar-thin scrollbar-thumb-[#2a2a2a] scrollbar-track-transparent z-10 pb-6">
        
        <p class="text-[10px] uppercase tracking-[0.2em] text-gray-600 font-semibold px-4 mb-2 mt-2">Menu Principal</p>

        <!-- Geral -->
        <a href="{{ url('/dashboard') }}" class="group flex items-center w-full px-3 py-3 rounded-xl transition-all duration-300 hover:bg-[#141414] hover:border hover:border-[#2a2a2a] border border-transparent">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-9 h-9 rounded-lg bg-[#1a1a1a] text-gray-400 group-hover:text-orange-500 group-hover:bg-orange-500/10 transition-all duration-300 group-hover:scale-110">
                    <i class="fas fa-home"></i>
                </div>
                <span class="text-sm font-medium text-gray-400 group-hover:text-gray-100 transition-colors">Geral</span>
            </div>
        </a>

        <!-- Reservas -->
        <a href="{{ url('/categorias') }}" class="group flex items-center w-full px-3 py-3 rounded-xl transition-all duration-300 hover:bg-[#141414] hover:border hover:border-[#2a2a2a] border border-transparent">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-9 h-9 rounded-lg bg-[#1a1a1a] text-gray-400 group-hover:text-orange-500 group-hover:bg-orange-500/10 transition-all duration-300 group-hover:scale-110">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <span class="text-sm font-medium text-gray-400 group-hover:text-gray-100 transition-colors">Reservas</span>
            </div>
        </a>

        <!-- Caixa -->
        <a href="{{ url('/produtos') }}" class="group flex items-center w-full px-3 py-3 rounded-xl transition-all duration-300 hover:bg-[#141414] hover:border hover:border-[#2a2a2a] border border-transparent">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-9 h-9 rounded-lg bg-[#1a1a1a] text-gray-400 group-hover:text-orange-500 group-hover:bg-orange-500/10 transition-all duration-300 group-hover:scale-110">
                    <i class="fas fa-cash-register"></i>
                </div>
                <span class="text-sm font-medium text-gray-400 group-hover:text-gray-100 transition-colors">Caixa</span>
            </div>
        </a>

        <!-- Produtos -->
        <a href="{{ url('/financeiro') }}" class="group flex items-center w-full px-3 py-3 rounded-xl transition-all duration-300 hover:bg-[#141414] hover:border hover:border-[#2a2a2a] border border-transparent">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-9 h-9 rounded-lg bg-[#1a1a1a] text-gray-400 group-hover:text-orange-500 group-hover:bg-orange-500/10 transition-all duration-300 group-hover:scale-110">
                    <i class="fas fa-box-open"></i>
                </div>
                <span class="text-sm font-medium text-gray-400 group-hover:text-gray-100 transition-colors">Produtos</span>
            </div>
        </a>

        <!-- Movimentações (Item Ativo) -->
        <a href="#" class="group flex items-center w-full px-3 py-3 rounded-xl transition-all duration-300 bg-gradient-to-r from-orange-500 to-orange-400 shadow-[0_4px_20px_rgba(249,115,22,0.25)] border border-orange-400/50 my-1 relative overflow-hidden">
            <!-- Efeito de brilho no hover do item ativo -->
            <div class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700 ease-out"></div>
            
            <div class="flex items-center gap-4 relative z-10">
                <div class="flex items-center justify-center w-9 h-9 rounded-lg bg-white/20 text-white shadow-inner transition-all duration-300">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <span class="text-sm font-semibold text-white tracking-wide">Movimentações</span>
            </div>
        </a>

        <!-- Vendas com Dropdown -->
        <div class="relative group mt-1">
            <button onclick="
                const drop = document.getElementById('vendas-dropdown');
                const icon = document.getElementById('vendas-icon');
                drop.classList.toggle('hidden');
                setTimeout(() => { drop.classList.toggle('opacity-0'); drop.classList.toggle('-translate-y-2'); }, 10);
                icon.classList.toggle('rotate-180');
            " class="flex items-center justify-between w-full px-3 py-3 rounded-xl transition-all duration-300 hover:bg-[#141414] hover:border hover:border-[#2a2a2a] border border-transparent">
                
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-center w-9 h-9 rounded-lg bg-[#1a1a1a] text-gray-400 group-hover:text-orange-500 group-hover:bg-orange-500/10 transition-all duration-300 group-hover:scale-110">
                        <i class="fas fa-tags"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-400 group-hover:text-gray-100 transition-colors">Vendas</span>
                </div>
                
                <i id="vendas-icon" class="fas fa-chevron-down text-xs text-gray-600 transition-transform duration-300"></i>
            </button>

            <!-- Dropdown Menu -->
            <div id="vendas-dropdown" class="hidden opacity-0 -translate-y-2 transition-all duration-300 ease-in-out ml-7 pl-4 border-l border-[#1f1f1f] py-1 mt-1 flex flex-col gap-1">
                <a href="{{ url('/vendas/analise') }}" class="group/sub flex items-center gap-2.5 w-full py-2 px-3 rounded-lg hover:bg-[#141414] hover:border hover:border-[#2a2a2a] border border-transparent text-gray-400 hover:text-orange-500 text-xs font-medium transition-all duration-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#2a2a2a] group-hover/sub:bg-orange-500 transition-all duration-300 group-hover/sub:scale-125"></span>
                    <span>Análise</span>
                </a>
                <a href="{{ url('/vendas/nova') }}" class="group/sub flex items-center gap-2.5 w-full py-2 px-3 rounded-lg hover:bg-[#141414] hover:border hover:border-[#2a2a2a] border border-transparent text-gray-400 hover:text-orange-500 text-xs font-medium transition-all duration-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#2a2a2a] group-hover/sub:bg-orange-500 transition-all duration-300 group-hover/sub:scale-125"></span>
                    <span>Nova Venda</span>
                </a>
            </div>
        </div>

    </div>

    <!-- Botão Sair -->
    <div class="p-5 relative z-10 border-t border-[#1f1f1f]/80 bg-gradient-to-t from-[#050505] to-transparent">
        <a href="{{ url('/') }}" class="group flex items-center justify-center gap-3 w-full px-4 py-3.5 rounded-xl bg-[#141414] border border-[#2a2a2a] text-gray-400 hover:text-red-500 hover:border-red-500/40 hover:bg-red-500/10 transition-all duration-300 hover:shadow-[0_0_20px_rgba(239,68,68,0.15)]">
            <i class="fas fa-sign-out-alt group-hover:-translate-x-1 transition-transform duration-300"></i>
            <span class="font-medium text-sm tracking-wide">Sair do Sistema</span>
        </a>
    </div>

</nav>