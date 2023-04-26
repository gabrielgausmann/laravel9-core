@extends('layouts.app')
@section('content')

<div class="row row-cols-1 pb-3">
    <div class="col">
        <div class="card">
            <x-forms.admin.perfil :perfil="$perfil" :perms="$perms" :usuarios="$usuarios" />
        </div>
    </div>
</div>

@endsection

{{-- TODO: Criar uma página para edição dos perfis através do clique no usuário --}}
{{-- <a class="btn btn-secondary" href="{{ route('admin.perfis.edit_permissoes', $perfil->id) }}" data-toggle="tooltip" title="Alterar as permissões do perfil">
    <i class="fas fa-toggle-on mx-1"></i>
</a> --}}
{{-- <p class="lead">
    <i class="fa fa-info-circle text-primary" data-toggle="tooltip" title="Informação"></i>
    Você pode clicar nos nomes de usuário para alterar seus perfis.
</p> --}}

{{-- <a class="badge badge-success p-2" href="{{ route('admin.usuarios.edit_perfil', $u->id) }}">
        <i class="fa fa-user mr-2"></i>
        {{ $u->name }}
    </a> --}}
