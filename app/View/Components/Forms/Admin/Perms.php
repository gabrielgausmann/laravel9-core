<?php

namespace App\View\Components\Forms\Admin;

use Illuminate\View\Component;

class Perms extends Component
{

    /**
     * @var metodo
     * Qual método iremos utilizar? Create, Edit ou View?
     * 
     * @var permissao
     * Qual permissão iremos carregar? (Opcional)
     * 
     * @var perfis
     * Perfis da permissão, se houver permissão carregada
     */
    public $metodo;
    public $permissao;
    public $perfis;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($metodo = null, $permissao = null, $perfis = null)
    {
        $this->metodo = $metodo;
        $this->permissao = $permissao;
        $this->perfis = $perfis;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.admin.perms');
    }
}
