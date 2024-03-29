<nav class="navbar-dark bg-dark px-1 vh-100 pt-5">
    <div class="pt-4">
        <ul class="nav nav-pills nav-flush flex-sm-column flex-row">

            @can('admin')

                <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link {{ request()->routeIs('admin.index') ? 'active' : 'text-white' }}">
                        <i class="bi bi-gear-fill fs-4"></i>
                        <span class="nav-label ms-2">Configurações</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.usuarios.index') }}" class="nav-link {{ request()->routeIs('admin.usuarios.*') ? 'active' : 'text-white' }}">
                        <i class="bi bi-people-fill fs-4"></i>
                        <span class="nav-label ms-2">Usuários</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.perfis.index') }}" class="nav-link {{ request()->routeIs('admin.perfis.*') ? 'active' : 'text-white' }}">
                        <i class="bi bi-person-badge fs-4"></i>
                        <span class="nav-label ms-2">Perfis</span>
                    </a>
                </li>
                @endcan

                @can('dev')
                <li class="nav-item">
                    <a href="{{ route('admin.permissoes.index') }}" class="nav-link text-white {{ request()->routeIs('admin.permissoes.*') ? 'active' : '' }}">
                        <i class="bi bi-toggles fs-4"></i>
                        <span class="nav-label ms-2">Permissões</span>
                    </a>
                </li>
                
            @endcan
        </ul>
    </div>
</nav>