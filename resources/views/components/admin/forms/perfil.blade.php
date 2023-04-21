{{-- Habilita o formulário apenas para $type CREATE e EDIT --}}
@if(!is_null($type))
    <form action="{{ ($type == 'edit') ? route('admin.perfis.update', $perfil->id) : route('admin.perfis.store') }}" method="post">
    @csrf

    @if($type == 'edit') @method('PUT') @endif

@endif

    {{-- Identificação do formulário --}}
    <div class="card-header pb-1">
        <div class="row">
            <div class="col-8">
                <h3 class="pt-1">
                    <i class="bi bi-person-badge me-3"></i> 
                    <span class="text-secondary">Perfil |</span>

                    @if(!is_null($type))
                        @if($type == 'edit') 
                            Editar {{ $perfil->name }} 
                        @else 
                            Criar 
                        @endif
                    @else
                        {{ $perfil->name }}
                    @endif

                </h3>
            </div>

            <div class="col-4 text-end">

                {{-- EDIT --}}
                @if(!is_null($type))

                    {{-- 
                        EDIT | Habilita exclusão caso tenha essa permissão.
                        Não permite excluir os perfis 'Administrador' e 'Desenvolvedor(a)'
                    --}}
                    @if(($type == 'edit') && $perfil->id > 2)
                        @can('admin')
                            <a class="btn btn-danger" type="button" data-toggle="tooltip" title="Apagar {{ $perfil->name }}" data-bs-toggle="modal" data-bs-target="#confirmarExclusao">
                                <span class="d-xs-block d-lg-none">
                                    <i class="bi bi-trash-fill"></i>
                                </span>                    
                                <span class="d-none d-lg-block">
                                    <i class="bi bi-trash-fill me-1"></i>
                                    Excluir perfil
                                </span>
                            </a>

                            <x-modal.confirmar-exclusao o="perfis" :n="$perfil->name" :id="$perfil->id" />

                        @endcan
                    @endif

                {{-- SHOW --}}
                @else
                    @can('admin')

                        <div class="d-xs-block d-lg-none">
                            <a href="{{ route('admin.perfis.edit', $perfil->id) }}" class="btn btn-secondary">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </div>

                        <div class="d-none d-lg-block">
                            <a href="{{ route('admin.perfis.edit', $perfil->id) }}" class="btn btn-secondary">
                                <i class="bi bi-pencil-square"></i>
                                Editar perfil
                            </a>
                        </div>

                    @endcan
                @endif

            </div>
        </div>
    </div>

    {{-- Área principal --}}
    <div class="card-body">

        <div class="row pb-3">

            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <h5>Perfil</h5>
                <p class="text-secondary">
                    O perfil dos usuários define suas permissões
                </p> 
            </div>
            
            
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                {{-- Nome --}}
                <div class="row pb-4">
                    <div class="col">

                        <label for="nomeDoPerfil" class="d-block fw-bold">
                            Nome do perfil
                        </label>

                        {{-- EDIT / CREATE || Campo de formulário Nome --}}
                        @if(!is_null($type))

                            <input type="text" name="name" class="form-control" id="nomeDoPerfil" aria-describedby="dicaPerfil" @if($type == 'edit') value="{{ $perfil->name }}" @endif />
                            
                            <small id="dicaPerfil" class="form-text text-muted"> 
                                <strong>Obrigatório</strong>. Você pode utilizar o cargo como base para o perfil de usuários, por exemplo.
                            </small>

                        {{-- SHOW --}}
                        @else
                            {{ $perfil->name }}
                        @endif

                    </div>
                </div>

                {{-- Descrição --}}
                <div class="row pb-4">
                    <div class="col">

                        <label for="descricaoDoPerfil" class="d-block">
                            Descrição do perfil
                        </label>
                        
                        
                        {{-- EDIT / CREATE || Campo de formulário Descrição --}}
                        @if(!is_null($type))

                            <textarea rows="2" name="description" class="form-control" id="descricaoDoPerfil" aria-describedby="dicaDescricaoPerfil">@if($type == 'edit'){{$perfil->description}}@endif</textarea>
                            
                            <small id="dicaDescricaoPerfil" class="form-text text-muted"> 
                                <strong>Opcional</strong>. Você pode incluir uma descrição sobre esse perfil.
                            </small>

                        {{-- SHOW || Exibe descrição --}}
                        @else

                            @if(!is_null($perfil->description)) 
                                {{ $perfil->description }} 
                            @else 
                                <p class="text-muted">    
                                    Nenhuma descrição fornecida. 
                                </p>
                            @endif

                        @endif

                    </div>
                </div>
                
            </div>
        </div>

        <hr />

        {{-- Permissões --}}
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <h5>Permissões</h5>
                <p class="text-secondary">
                    <span class="badge bg-danger me-1">Atenção</span>
                    São as ações que esse perfil pode executar
                </p> 
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="row table-responsive">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-lg-4">Permissão para</small></th>
                                <th class="col-lg-8">Descrição da permissão</small></th>
                            </tr>
                        </thead>
                        <tbody>
    
                            @if(!is_null($type))
    
                                @foreach($perms as $p)
                                    <tr>
                                        <td>
                                            <div class="form-check form-switch">
                                                @can('admin')

                                                    <input class="form-check-input" type="checkbox" role="switch" name="perms[]" value="{{ $p->id }}" id="{{ $p->id }}" 
                                                        @if($type == 'edit') 
                                                            {{ ($perfil->hasAllPermissions($p) ? 'checked="checked"' : "") }} 
                                                            @if(($perfil->id == 1) && ($p->id == 1)) disabled="disabled" @endif
                                                        @endif
                                                    >
                                                    
                                                    <label class="form-check-label d-block ms-2" for="{{ $p->id }}" role="button">{{ $p->name }}</label>
                                                @endcan
                                                
                                                @cannot('admin')
                                                    {{ $p->name }}
                                                @endcan
                                            </div>
                                        </td>
    
                                        <td>
                                            @if(!is_null($p->description))
                                                {{ $p->description }}
                                            @else
                                                <span class="text-secondary">Nenhuma descrição fornecida.</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
    
                            {{-- SHOW --}}
                            @else
    
                                @foreach($perms as $p)
    
                                    @if($p->hasAllRoles($perfil->name))
                                        <tr>
                                            <td>
                                                {{ $p->name }}
                                            </td>
    
                                            <td>
                                                @if(!is_null($p->description))
                                                    {{ $p->description }}
                                                @else
                                                    <span class="text-secondary">Nenhuma descrição fornecida.</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
    
                                @endforeach
    
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>

        </div>

        @if(!is_null($usuarios))
            <hr />

            {{-- Usuários --}}
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-3">
                    <h5>Usuários</h5>
                    <p class="text-secondary">
                        <span class="badge bg-danger me-1">Atenção</span>
                        Usuários que possuem esse perfil e essas permissões
                    </p> 
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-9">
                    
                    <div class="row table-responsive">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="col-lg-6">Nome</small></th>
                                    <th class="col-lg-6">E-mail</small></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($usuarios as $u)
                                <tr>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->email }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        @endif

    </div>

    {{-- Pé do cartão --}}
    <div class="card-footer">

        <div class="row">
            <div class="col-8 {{ (!is_null($type) ? "mt-2" : "mt-1") }}">
                <a class="text-muted text-decoration-none" href="{{ route('admin.perfis.index') }}">
                    <i class="bi bi-arrow-return-left"></i>
                    <span class="ms-2">Voltar sem alterar nada</span>
                </a>
            </div>

            <div class="col-4 text-end">
                @if(isset($type))
                    <button type="submit" class="btn btn-primary" data-toggle="tooltip" title="{{ ($type == 'edit') ? "Editar" : "Salvar" }} perfil">
                        <span class="d-xs-block d-lg-none">
                            <i class="bi {{ ($type == 'edit') ? "bi-pencil-square" : "bi-save" }}"></i>
                        </span>                    
                        <span class="d-none d-lg-block">
                            <i class="bi {{ ($type == 'edit') ? "bi-pencil-square" : "bi-save" }} me-1"></i>
                            {{ ($type == 'edit') ? "Editar" : "Salvar" }} perfil
                        </span>                   
                    </button>
                @endif
            </div>
        </div>

    </div>

@if(!is_null($type))
    </form>
@endif