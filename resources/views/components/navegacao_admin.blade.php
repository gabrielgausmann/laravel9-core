<nav class="navbar-dark bg-dark shadow-lg p-1 min-vh-100 pt-4 d-none d-sm-block">
    <ul class="nav nav-pills nav-flush flex-sm-column flex-row">

        @can('admin')
        {{-- <li class="nav-item">
            <a href="{{ route('admin') }}" class="nav-link {{ request()->routeIs('admin') ? 'active' : 'text-white' }}" title="Início" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Início">
                <i class="bi bi-gear-fill fs-4"></i>
                <span class="nav-label ms-2 d-none">Administração</span>
            </a>
        </li> --}}

        <li class="nav-item">
            <a href="{{ route('usuarios.index') }}" class="nav-link {{ request()->routeIs('usuarios.*') ? 'active' : 'text-white' }}" title="Usuários" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Usuários">
                <i class="bi bi-people-fill fs-4"></i>
                <span class="nav-label ms-2 d-none">Usuários</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('perfis.index') }}" class="nav-link {{ request()->routeIs('perfis.*') ? 'active' : 'text-white' }}" title="Perfis" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Perfis">
                <i class="bi bi-person-badge fs-4"></i>
                <span class="nav-label ms-2 d-none">Perfis e permissões</span>
            </a>
        </li>
        @endcan

        @can('dev')
        <li class="nav-item">
            <a href="{{ route('permissoes.index') }}" class="nav-link text-white {{ request()->routeIs('permissoes.*') ? 'active' : '' }}" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="permissoes">
                <i class="bi bi-toggles fs-4"></i>
                <span class="nav-label ms-2 d-none">permissoes</span>
            </a>
        </li>
        @endcan
    </ul>
</nav>

<script>
    $('#nav-admin').hover(function() {
        $('#nav-admin').toggleClass('collapsed');
    });
</script>