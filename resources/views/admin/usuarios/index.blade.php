@extends('layouts.app')

@section('content')
    <div class="row row-cols-1 pb-3">
        <div class="col">
            <div class="card">

                <div class="card-header pb-1">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="pt-1"><i class="bi bi-people-fill me-3"></i> Usuários</h3>
                        </div>
                        <div class="col-4 text-end">
                            <a class="btn btn-primary" href="{{ route('usuarios.create') }}">
                                <span class="d-lg-none">
                                    <i class="bi bi-plus-lg"></i>
                                </span>
                                <span class="d-none d-lg-block">
                                    <i class="bi bi-plus-lg me-1"></i>
                                    Novo usuário
                                </span>
                            </a>
                        </div>
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
                        <tbody>
                            @foreach ($usuarios as $u)
                            <tr>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>
                                    @if(!empty($u->getRoleNames()))
                                        @foreach($u->getRoleNames() as $perfil)
                                        <label class="badge bg-success px-2 py-1">
                                            <i class="fas fa-check mr-1"></i>
                                            {{ $perfil }}
                                        </label>
                                        @endforeach
                                    @endif
                                </td>
                                <td class="text-center">{{ date('d/m/Y', strtotime($u->created_at)) }}</td>
                                <td class="text-center">

                                    <div class="btn-group" role="group">
                                        <a class="btn btn-sm btn-primary" href="{{ route('usuarios.show', $u->id) }}" data-bs-toggle="tooltip" title="Detalhar {{ $u->name }}">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        @can('admin')
                                            <a class="btn btn-sm btn-secondary" href="{{ route('usuarios.edit', $u->id) }}" data-bs-toggle="tooltip" title="Editar {{ $u->name }}">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                        @endcan
                                    </div>
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-8 mt-1">
                            <a class="text-muted pt-2 text-decoration-none" href="{{ route('admin') }}">
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
@endsection