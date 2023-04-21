<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Lado esquerdo do menu de navegação -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Início</a>
                </li>
            </ul>


            <!-- Lado direito do menu de navegação -->
            <ul class="navbar-nav ms-auto">

                <!-- Sistema de busca -->
                <!-- TODO Sistema de busca -->
                <form class="d-flex d-none" role="search">
                    <div class="input-group me-2">
                        <input class="form-control" type="search" placeholder="Pesquisar" aria-label="Pesquisar" aria-describedby="btn-pesquisa">
                        <button class="btn btn-primary" type="submit" id="btn-pesquisa"><i class="bi-search"></i></button>
                    </div>
                </form>
                
                <!-- Apenas se está logado -->
                @auth

                    <!-- Usuários administradores -->
                    @can('admin')
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('admin.index') }}">
                                <span class="nav-label me-2 d-md-none">Configurações</span>
                                <i class="bi {{ (request()->routeIs('admin.*') ? "bi-gear-fill" : "bi-gear") }} fs-5"></i>
                            </a>
                        </li>
                    </ul>
                    @endcan

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span>{{ Auth::user()->name }}</span>
                            <i class="bi-person-circle fs-5 ms-2"></i>
                        </a>
                        
                        <div class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="navbarDropdown">
                                
                            <!-- Alterar as próprias informações -->
                            <a class="dropdown-item" href="{{ route('self.index') }}">Minhas informações</a>
                            
                            <hr class="dropdown-divider">

                            <!-- Fazer logout -->
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-power fs-5 me-2"></i>
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>