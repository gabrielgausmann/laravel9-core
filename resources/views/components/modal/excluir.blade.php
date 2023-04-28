{{-- Modal Excluir --}}
<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="excluirLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header text-bg-danger">
                <h5 class="modal-title" id="excluirLabel">
                    <i class="bi bi-trash-fill me-2"></i>
                    Excluir {{ $objeto }}
                </h5>
                <button type="button" class="btn btn-sm btn-danger" title="Fechar sem excluir" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <div class="modal-body text-start">
                    Você irá <strong>excluir</strong>:
                    <span class="d-block fs-5"> {{ $descricao }}</span>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-arrow-return-left me-2"></i>
                    Não excluir
                </button>

                <form method="POST" action="{{ route($objeto . '.destroy', $instancia) }}">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash-fill me-2"></i>
                            Excluir
                        </button>
                </form>

            </div>
        </div>
    </div>
</div>