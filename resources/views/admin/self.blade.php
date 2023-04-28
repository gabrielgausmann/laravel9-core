@extends('layouts.app')
@section('content')

<div class="row row-cols-1 pb-3">
    <div class="col">
        <form action="{{ route('self.update', $usuario->id) }}" method="post">
        @csrf
        @method('PUT') 
        
            <div class="card">
            
                <div class="card-header pb-1">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="pt-1">
                                <i class="bi bi-person-circle me-3"></i> 
                                <span class="text-secondary">Editar |</span>
                                {{ $usuario->name }} 
                            </h3>
                        </div>
            
                        <div class="col-4 text-end">
                            @if(Auth::user()->id > 1)
                            <a class="btn btn-danger" type="button" data-toggle="tooltip" title="Apagar {{ $usuario->name }}" data-bs-toggle="modal" data-bs-target="#confirmarExclusao">
                                <span class="d-xs-block d-lg-none">
                                    <i class="bi bi-trash-fill"></i>
                                </span>                    
                                <span class="d-none d-lg-block">
                                    <i class="bi bi-trash-fill me-1"></i>
                                    Excluir meu usuário
                                </span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                
                {{-- Informações pessoais --}}
                <div class="card-body">
                    <div class="row pb-3">
            
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                            <h5>Suas informações</h5>
                            <p class="text-secondary">
                                <i class="fas fa-lock text-primary pr-2"></i>
                                {{-- <span class="badge bg-primary me-1">LGPD</span> --}}
                                Informações criptografadas
                                {{-- 
                                    FIXME: Incluir criptografia de dados
                                --}}
                            </p> 
                        </div>
                        
                        
                        <div class="col-12 col-sm-12 col-md-9 col-lg-9">
            
                            {{-- Nome --}}
                            <div class="row pb-4">
                                <div class="col">
                                    <label for="nome" class="d-block fw-bold">
                                        Nome
                                    </label>
            
                                    <input type="text" name="name" class="form-control" id="nome" aria-describedby="dicaNome" value="{{ $usuario->name }}"/>
                                    <small id="dicaNome" class="form-text text-muted"><strong>Obrigatório</strong>. Utilize seu nome completo, sem abreviaturas</small>
            
                                </div>
                            </div>
            
                            <div class="row pb-4">
            
                                {{-- E-mail --}}
                                <div class="col-lg-6">
                                    <label for="email" class="d-block fw-bold">
                                        E-mail
                                    </label>
            
                                    <input type="email" name="email" class="form-control" id="email" aria-describedby="dicaEmail" value="{{ $usuario->email }}" disabled="disabled" />
                                    <small id="dicaEmail" class="form-text text-muted">Você não pode alterar o e-mail cadastrado.</small>
                                </div>
            
                                {{-- Senha --}}
                                <div class="col-lg-6">
                                    <label for="password" class="d-block fw-bold">
                                        Senha
                                    </label>
            
                                    <input type="password" name="password" class="form-control" id="password" aria-describedby="dicaPassword" disabled="disabled" />
                                    
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="alterarSenha" name="alterarSenha">
                                        <label class="form-check-label d-block" for="alterarSenha">
                                          Alterar senha
                                        </label>
                                      </div>
                                    <small id="dicaPassword" class="form-text text-muted d-none"><strong>Obrigatório</strong>. Utilize uma senha forte - use letras maiúsculas, minúsculas e caracteres especiais (#, @, $, ...)</small>
                                </div>

                                {{-- <div class="col-lg-6">
                                    <label for="password" class="d-block fw-bold">
                                        Senha
                                    </label>
            
                                    <input type="password" name="password" class="form-control" id="password" aria-describedby="dicaPassword" />
                                    <small id="dicaPassword" class="form-text text-muted"><strong>Obrigatório</strong>. Utilize uma senha forte - use letras maiúsculas, minúsculas e caracteres especiais (#, @, $, ...)</small>
                                </div> --}}

                                
                            </div>
            
                        </div>
                    </div>
            
                    <hr />
            
                    {{-- Perfis --}}
                    <div class="row">
            
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                            <h5>Perfis</h5>
                            <p class="text-secondary">
                                <span class="badge bg-primary me-1">Info</span>
                                Perfis definem o que você pode executar na plataforma
                            </p> 
                        </div>
                        
                        
                        <div class="col-12 col-sm-12 col-md-9 col-lg-9">
            
                            <div class="row table-responsive">
            
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="col-4">Perfil</small></th>
                                            <th class="col-8">Descrição do perfil</small></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    @foreach($perfis as $p)
                                        @if($usuario->hasAllRoles($p->name))
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
                                        
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
            
                {{-- Pé do cartão --}}
                <div class="card-footer">
            
                    <div class="row">
            
                        <div class="col-8 mt-2">
                            <a class="text-muted text-decoration-none" href="{{ route('home') }}">
                                <i class="bi bi-arrow-return-left"></i>
                                <span class="ms-2">Voltar sem editar informações</span>
                            </a>
                        </div>
            
                        <div class="col-4 text-end">
                            <button type="submit" class="btn btn-primary" data-toggle="tooltip" title="Editar informações">
                                <span class="d-xs-block d-lg-none">
                                    <i class="bi bi-pencil-square"></i>
                                </span>                    
                                <span class="d-none d-lg-block">
                                    <i class="bi bi-pencil-square me-1"></i>
                                    Editar informações
                                </span>                   
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<x-modal.excluir objeto="self" :descricao="$usuario->name" :instancia="$usuario->id" modalId="confirmarExclusao" />

@endsection

@section('scripts')
    <script>
        $("#alterarSenha").click(function() {
            $("#password").prop('disabled', (i, v) => !v);
        })
    </script>
@endsection