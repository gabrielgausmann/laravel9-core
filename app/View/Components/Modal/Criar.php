<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;

class Criar extends Component
{

    /**
     * @var $objeto
     * Objeto que estamos criando a partir desse modal. Exemplo: "Marca"
     * 
     * @var $form
     * Componente de formulário a ser invocado para criação do objeto
     * 
     * @var $modalId
     * Identificador do modal
     */
    public $objeto;
    public $form;
    public $modalId;


    /**
     * Create a new component instance.
     *
     * @return void
     */
   public function __construct($objeto, $form, $modalId)
    {
        $this->objeto = $objeto;
        $this->form = $form;
        $this->modalId = $modalId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal.criar');
    }
}