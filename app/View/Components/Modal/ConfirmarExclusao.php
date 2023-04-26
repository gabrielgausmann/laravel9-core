<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;

class ConfirmarExclusao extends Component
{
    // Objeto, nome e id
    public $o;
    public $n;
    public $id;
    public $modalId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($o, $n, $id, $modalId)
    {
        $this->o = $o;
        $this->n = $n;
        $this->id = $id;
        $this->modalId = $modalId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal.confirmar-exclusao');
    }
}
