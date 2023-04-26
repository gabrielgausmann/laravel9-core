<?php

namespace App\View\Components\Forms\Admin;

use Illuminate\View\Component;

class Perfil extends Component
{

    /**
     * @var metodo
     * 
     * 
     */
    public $metodo;     // Antiga TYPE
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
