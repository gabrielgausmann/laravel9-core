<?php

namespace App\View\Components\Forms\Admin;

use Illuminate\View\Component;

class Perfil extends Component
{
    /**
     * @var metodo
     * Qual método iremos utilizar? Create, Edit ou View?
     * 
     * @var perfil
     * Qual perfil iremos carregar? (Opcional)
     * 
     * @var perms
     * Permissões do perfil, se houver perfil carregado
     * 
     * @var usuarios
     * Usuários do perfil, se houver perfil carregado
     */
    public $metodo;
    public $perfil;
    public $perms;
    public $usuarios;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($metodo = null, $perfil = null, $perms = null, $usuarios = null)
    {
        $this->metodo = $metodo;
        $this->perfil = $perfil;
        $this->perms = $perms;
        $this->usuarios = $usuarios;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.admin.perfil');
    }
}
