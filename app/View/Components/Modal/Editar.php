<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;

class Editar extends Component
{

    /**
     * @var objeto
     * Objeto que estamos criando a partir desse modal. Exemplo: "Marca"
     * 
     * @var instancia
     * Qual o identificador da instância do objeto estamos requerendo?
     * 
     * @var form
     * Componente de formulário a ser invocado para criação do objeto
     * 
     * @var modalId
     * Identificador do modal
     */
    public $objeto;
    public $instancia;
    public $form;
    public $modalId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($objeto, $instancia, $form, $modalId)
    {
        $this->objeto = $objeto;
        $this->instancia = $instancia;
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
        return view('components.modal.editar');
    }
}
