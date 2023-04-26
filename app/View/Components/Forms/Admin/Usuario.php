<?php

namespace App\View\Components\Forms\Admin;

use Illuminate\View\Component;

class Usuario extends Component
{

    /**
     * @var metodo
     * Qual método iremos utilizar? Create, Edit ou View?
     * 
     * @var usuario
     * Qual usuário estamos carregando? (Opcional)
     * 
     * @var perfis
     * Quais os perfis vinculados, se houver usuário carregado?
     * 
     * @var perms
     * Quais as permissões do usuário, se houver usuário vinculado?
     */
    public $metodo;
    public $usuario;
    public $perfis;
    public $perms;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($metodo = null, $usuario = null, $perfis = null, $perms = null)
    {
        $this->metodo = $metodo;
        $this->usuario = $usuario;
        $this->perfis = $perfis;
        $this->perms = $perms;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.admin.usuario');
    }
}
