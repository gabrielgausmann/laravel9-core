<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;

class Excluir extends Component
{

    /**
     * @var objeto
     * Qual objeto iremos excluir?
     * 
     * @var descricao
     * Breve descrição ou nome do objeto para orientar o usuário
     * 
     * @var instancia
     * Qual a instância do objeto que queremos excluir?
     * 
     * @var modalId
     * Qual o Id do Modal. Útil para exlusão rápida em uma lista
     */
    public $objeto;
    public $descricao;
    public $instancia;
    public $modalId;
    
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($objeto, $descricao, $instancia, $modalId)
    {
        $this->objeto = $objeto;
        $this->descricao = $descricao;
        $this->instancia = $instancia;
        $this->modalId = $modalId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal.excluir');
    }
}
