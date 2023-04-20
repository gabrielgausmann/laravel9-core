@extends('layouts.app')

@section('content')
    <div class="row pb-3">
        <h4 class="text-primary">Administração do sistema</h4>
    </div>
    
    <div class="row row-cols-1 @can('dev') row-cols-md-3 @else row-cols-md-2  @endcan }} g-3 pb-3">
        
        {{-- Card usuários --}}
        <div class="col">
            <div class="card h-100">
                <h4 class="card-header"><i class="bi bi-people-fill pe-3"></i>Usuários</h4>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="py-1"><a href="{{ route('usuarios.index') }}">Listar usuários existentes</a></li>
                        <li class="py-1"><a href="{{ route('usuarios.create') }}">Criar um novo usuário</a></li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Card perfis --}}
        <div class="col">
            <div class="card h-100">
                <h4 class="card-header"><i class="bi bi-person-badge pe-3"></i>Perfis e permissões</h4>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="py-1"><a href="{{ route('perfis.index') }}">Listar os perfis existentes</a></li>
                        <li class="py-1"><a href="{{ route('perfis.create') }}">Criar um novo perfil</a></li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Card permissoes --}}
        @can('dev')
        <div class="col">
            <div class="card h-100">
                <h4 class="card-header bg-danger text-white"><i class="bi bi-toggles pe-3"></i>Regras de permissão</h4>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="py-1"><a href="{{ route('permissoes.index') }}">Listar permissões existentes</a></li>
                        <li class="py-1"><a href="{{ route('permissoes.create') }}">Criar uma nova permissão</a></li>
                    </ul>

                    <p class="text-secondary">Apenas para desenvolvedores, manipula as regras permissões de acesso à plataforma.</p>
                
                </div>
            </div>
        </div>
        @endcan
    </div>
@endsection