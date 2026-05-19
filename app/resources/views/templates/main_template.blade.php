@include('templates.header')

<div class="flex min-h-screen">
    @include('templates.sidebar')
    
    <!-- CONTEÚDO -->
    <main class="flex-1 p-6">
        
        @include('templates.tabs')
    </main>
</div>
    
@include('templates.footer')
