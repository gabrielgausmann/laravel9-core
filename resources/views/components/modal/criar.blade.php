{{-- Modal Criar --}}
<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="criarNovoLabel" aria-hidden="true" {{ $attributes }}>
    
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header text-bg-primary">
                <h5 class="modal-title" id="criarNovoLabel">
                    <i class="bi bi-plus-lg me-2"></i>
                    Criar {{ $objeto }}
                </h5>
                <button type="button" class="btn btn-sm btn-primary" title="Fechar" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <div class="modal-body text-start">
                <x-dynamic-component :component="$form" metodo="create" />
            </div>
        </div>
    </div>
</div>