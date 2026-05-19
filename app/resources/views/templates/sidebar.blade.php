<nav class="w-72 bg-white border-r border-gray-200 md:flex flex-col">
    
    <div class="p-4 border-b border-gray-200">
        <h2 class="text-lg font-bold text-gray-800">Menu</h2>
    </div>

    <nav class="flex-1 overflow-y-auto p-4">
        <a href="{{ url('/home') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 hover:text-gray-800 rounded-lg transition">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
        <a href="{{ url('/categorias') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 hover:text-gray-800 rounded-lg transition">
            <i class="fas fa-tags"></i>
            <span>Categorias</span>
        </a>
        <a href="{{ url('/produtos') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 hover:text-gray-800 rounded-lg transition">
            <i class="fas fa-box"></i>
            <span>Produtos</span>
        </a>
        <a href="{{ url('/orcamentos') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 hover:text-gray-800 rounded-lg transition">
            <i class="fas fa-file-invoice"></i>
            <span>Orçamentos</span>
        </a>
    </nav>

</nav>