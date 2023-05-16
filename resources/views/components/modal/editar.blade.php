{{-- Modal Editar --}}
<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header text-bg-secondary">
                <h5 class="modal-title" id="editarLabel">
                    <i class="bi bi-pencil-fill me-2"></i>
                    Editar {{ $objeto }}
                </h5>
                <button type="button" class="btn btn-sm btn-secondary" title="Fechar" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body text-start">
                <x-dynamic-component :component="$form" metodo="edit" :instancia="$instancia" />
            </div>
        </div>
    </div>
</div>