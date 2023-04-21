@extends('layouts.app')

@section('content')

    <div class="row row-cols-1 pb-3">
        <div class="col">
            <div class="card">

                <div class="card-header pb-1">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="pt-1">
                                <i class="bi bi-gear-fill me-3"></i> 
                                Configuração do sistema
                            </h3>
                        </div>
                        <div class="col-4 text-end"></div>
                    </div>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="col-3">Nome</th>
                                <th class="col-3">E-mail</th>
                                <th class="col-3">Perfis de usuário</th>
                                <th class="col-2 text-center">Criado em</th>
                                <th class="col-1 text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-8 mt-1">
                            <a class="text-muted pt-2 text-decoration-none" href="{{ route('admin.index') }}">
                                <i class="bi bi-arrow-return-left"></i>
                                <span class="ms-2">Voltar à página anterior</span>
                            </a>
                        </div>

                        <div class="col-4 text-end"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



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
                        <li class="py-1"><a href="{{ route('admin.usuarios.index') }}">Listar usuários existentes</a></li>
                        <li class="py-1"><a href="{{ route('admin.usuarios.create') }}">Criar um novo usuário</a></li>
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
                        <li class="py-1"><a href="{{ route('admin.perfis.index') }}">Listar os perfis existentes</a></li>
                        <li class="py-1"><a href="{{ route('admin.perfis.create') }}">Criar um novo perfil</a></li>
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
                        <li class="py-1"><a href="{{ route('admin.permissoes.index') }}">Listar permissões existentes</a></li>
                        <li class="py-1"><a href="{{ route('admin.permissoes.create') }}">Criar uma nova permissão</a></li>
                    </ul>

                    <p class="text-secondary">Apenas para desenvolvedores, manipula as regras permissões de acesso à plataforma.</p>
                
                </div>
            </div>
        </div>
        @endcan
    </div>
@endsection