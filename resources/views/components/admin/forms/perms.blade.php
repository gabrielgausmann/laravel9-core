{{-- Habilita o formulário apenas para $type CREATE e EDIT --}}
@if(!is_null($type))
    <form action="{{ ($type == 'edit') ? route('admin.permissoes.update', $permissao->id) : route('admin.permissoes.store') }}" method="post">
    @csrf

    @if($type == 'edit') @method('PUT') @endif

@endif

    {{-- Identificação do formulário --}}
    <div class="card-header pb-1">
        <div class="row">
            <div class="col-8">
                <h3 class="pt-1">
                    <i class="bi bi-toggles me-3"></i> 
                    <span class="text-secondary">Permissão |</span>

                    @if(!is_null($type))
                        @if($type == 'edit') 
                            Editar {{ $permissao->name }} 
                        @else 
                            Criar 
                        @endif
                    @else
                        {{ $permissao->name }}
                    @endif

                </h3>
            </div>

            <div class="col-4 text-end">

                {{-- EDIT --}}
                @if(!is_null($type))

                    {{-- 
                        EDIT | Habilita exclusão caso tenha essa permissão.
                        Não permite excluir as permissões 'admin' e 'dev'
                    --}}
                    @if(($type == 'edit') && $permissao->id > 2)
                        @can('admin')
                            <a class="btn btn-danger" type="button" data-toggle="tooltip" title="Apagar {{ $permissao->name }}" data-bs-toggle="modal" data-bs-target="#confirmarExclusao">
                                <span class="d-xs-block d-lg-none">
                                    <i class="bi bi-trash-fill"></i>
                                </span>                    
                                <span class="d-none d-lg-block">
                                    <i class="bi bi-trash-fill me-1"></i>
                                    Excluir permissão
                                </span>
                            </a>

                            <x-modal.confirmar-exclusao o="permissoes" :n="$permissao->name" :id="$permissao->id" />

                        @endcan
                    @endif

                {{-- SHOW || Habilita edição caso tenha essa permissão --}}
                @else
                    @can('admin')

                        <div class="d-xs-block d-lg-none">
                            <a href="{{ route('admin.permissoes.edit', $permissao->id) }}" class="btn btn-secondary">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </div>

                        <div class="d-none d-lg-block">
                            <a href="{{ route('admin.permissoes.edit', $permissao->id) }}" class="btn btn-secondary">
                                <i class="bi bi-pencil-square"></i>
                                Editar permissão
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
                <h5>Permissão</h5>
                <p class="text-secondary d-none d-md-block">
                    <span class="badge bg-danger me-1">Atenção</span>
                    Permissões são utilizadas como parte do pacote
                    Spatie/Laravel-permission utilizando-se <kbd>&commat;can(@if(is_null($type) || $type=='edit'){{ $permissao->name }}@endif)</kbd> ou 
                    <kbd>$middleware["can:@if(is_null($type) || $type=='edit'){{ $permissao->name }}@endif"]</kbd> diretamente no código da aplicação
                </p>

                @if(!is_null($type))
                    <p class="text-secondary">
                        <span class="badge bg-danger me-1">Atenção</span>
                        Utilize essa interface apenas se você sabe o que está fazendo!
                    </p>
                @endif
            </div>
            
            
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">

                {{-- Nome --}}
                <div class="row pb-4">
                    <div class="col">

                        <label for="nomeDoPerfil" class="d-block fw-bold @if($type == 'edit') text-danger @endif">
                            Nome da permissão
                        </label>

                        {{-- EDIT / CREATE || Campo de formulário Nome --}}
                        @if(!is_null($type))

                            <input type="text" name="name" class="form-control" id="nomeDoPerfil" aria-describedby="dicaPermissao" @if($type == 'edit') value="{{ $permissao->name }}" @if($permissao->id <= 2) disabled="disabled" @endif @endif />
                            
                            @if($type == 'create')
                            <small id="dicaPermissao" class="form-text text-muted">
                                <strong>Obrigatório</strong>. Utilizar notação kebab-case.
                            </small>
                            @else
                            <small id="dicaPermissao" class="form-text">
                                <span class="badge bg-danger">ATENÇÃO</span> Alterar o nome da permissão apenas se você sabe o que está fazendo! Você precisará alterar o código diretamente!
                            </small>
                            @endif
                        
                        {{-- SHOW || Exibe Nome --}}
                        @else
                            {{ $permissao->name }}
                        @endif

                    </div>
                </div>

                {{-- Descrição --}}
                <div class="row pb-4">
                    <div class="col">

                        <label for="descricaoDaPermissao" class="d-block">
                            Descrição da permissão
                        </label>

                        {{-- EDIT / CREATE || Campo de formulário Descrição --}}
                        @if(!is_null($type))

                            <textarea rows="2" name="description" class="form-control" id="descricaoDaPermissao" aria-describedby="dicaDescricaoPermissao">@if($type == 'edit'){{ $permissao->description }}@endif</textarea>
                            
                            <small id="dicaDescricaoPermissao" class="form-text text-muted"> 
                                <strong>Opcional</strong>. Você pode incluir uma breve descrição sobre o que essa permissão faz.
                            </small>

                        {{-- SHOW || Exibe descrição --}}
                        @else
                            <p class="text-muted">
                                @if(!is_null($permissao->description)) {{ $permissao->description }} @else Nenhuma descrição fornecida. @endif
                            </p>
                        @endif
                    </div>
                </div>
                
            </div>
        </div>

        <hr />

        {{-- Atribuir aos perfis --}}
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <h5>Perfis</h5>
                <p class="text-secondary">
                    @if(!is_null($type))
                        <span class="badge bg-danger me-1">Atenção</span>
                        Perfis para os quais você quer atribuir essa permissão
                    @else
                        Perfis que possuem essa permissão
                    @endif
                </p> 
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="row table-responsive">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-lg-4">Perfil</small></th>
                                <th class="col-lg-8">Descrição do perfil</small></th>
                            </tr>
                        </thead>
                        <tbody>
    
                            @if(!is_null($type))
    
                                @foreach($perfis as $p)
                                <tr>
                                    <td>
                                        <div class="form-check form-switch">
                                            @can('admin')
                                            
                                                <input class="form-check-input" type="checkbox" role="switch" name="perfis[]" value="{{ $p->id }}" id="{{ $p->id }}" 
                                                    @if($type == 'edit') 
                                                        {{ ($permissao->hasAllRoles($p) ? 'checked="checked"' : "") }} 
                                                        @if(($permissao->id == 1) && ($p->id ==1)) disabled="disabled" @endif
                                                    @else 
                                                        @if($p->id <= 2) {{ 'checked="checked"' }} @endif @endif
                                                >
                                                
                                                <label class="form-check-label d-block ms-2" for="{{ $p->id }}" role="button">{{ $p->name }}</label>
                                            
                                            @else
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
    
                                @foreach($perfis as $p)
    
                                    @if($p->hasAllPermissions($permissao->name))
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
    </div>

    {{-- Pé do cartão --}}
    <div class="card-footer">

        <div class="row">
            <div class="col-8 {{ (!is_null($type) ? "mt-2" : "mt-1") }}">
                <a class="text-muted text-decoration-none" href="{{ route('admin.permissoes.index') }}">
                    <i class="bi bi-arrow-return-left"></i>
                    <span class="ms-2">Voltar sem alterar nada</span>
                </a>
            </div>

            <div class="col-4 text-end">
                @if(!is_null($type))
                    <button type="submit" class="btn btn-primary" data-toggle="tooltip" title="{{ ($type == 'edit') ? "Editar" : "Salvar" }} permissões">
                        <span class="d-xs-block d-lg-none">
                            <i class="bi {{ ($type == 'edit') ? "bi-pencil-square" : "bi-save" }}"></i>
                        </span>                    
                        <span class="d-none d-lg-block">
                            <i class="bi {{ ($type == 'edit') ? "bi-pencil-square" : "bi-save" }} me-1"></i>
                            {{ ($type == 'edit') ? "Editar" : "Salvar" }} permissões
                        </span>                   
                    </button>
                @endif
            </div>
        </div>

    </div>

@if(!is_null($type))
    </form>
@endif