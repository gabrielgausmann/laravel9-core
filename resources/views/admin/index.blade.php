@extends('layouts.admin')

@section('content')
    <div class="row pb-2">
        <h3 class="text-danger">Administração do sistema</h3>
        <p class="lead">
            Utilize a barra lateral ou as opções abaixo para administrar a plataforma.
        </p>
    </div>
    
    <div class="row row-cols-1 row-cols-md-2 g-4 pb-3">
        
        {{-- Card usuários --}}
        <div class="col">
            <div class="card h-100">
                <h4 class="card-header"><i class="bi bi-people-fill pe-3"></i>Usuários</h4>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="py-1"><a href="{{ route('usuarios.index') }}">Listar usuários existentes</a></li>
                        <li class="py-1"><a href="{{ route('usuarios.create') }}">Criar um novo usuário</a></li>
                        <hr />
                        <li class="py-1"><a href="#" class="text-primary">Ajuda: Criei um usuário, e agora?</a> <span class="badge bg-warning text-dark">Em breve</span></li>
                        <li class="py-1"><a href="#" class="text-primary">Ajuda: Preciso mesmo excluir um usuário?</a> <span class="badge bg-warning text-dark">Em breve</span></li>
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

                        <hr />
                        
                        <li class="py-1"><a href="#" class="text-primary">Ajuda: O que é um perfil? Quando devo criar um?</a> <span class="badge bg-warning text-dark">Em breve</span></li>
                        <li class="py-1"><a href="#" class="text-primary">Ajuda: Como funcionam as permissões?</a> <span class="badge bg-warning text-dark">Em breve</span></li>
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
                    <p class="text-secondary">Apenas para desenvolvedores, manipula as regras permissões de acesso à plataforma.</p>
                    <ul class="list-unstyled">
                        <li class="py-1"><a href="{{ route('permissoes.index') }}">Listar permissões existentes</a></li>
                        <li class="py-1"><a href="{{ route('permissoes.create') }}">Criar uma nova permissão</a></li>
                    </ul>
                </div>
            </div>
        </div>
        @endcan
    </div>
@endsection