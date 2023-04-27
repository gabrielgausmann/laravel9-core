<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Token CSRF --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> @if(request()->is(['admin*'])) ADM | @endif {{ config('app.name') }} </title>

        {{-- Fontes --}}
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/fontawesome.min.css" integrity="sha512-RvQxwf+3zJuNwl4e0sZjQeX7kUa3o82bDETpgVCH2RiwYSZVDdFJ7N/woNigN/ldyOOoKw8584jM4plQdt8bhA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/solid.min.css" integrity="sha512-uj2QCZdpo8PSbRGL/g5mXek6HM/APd7k/B5Hx/rkVFPNOxAQMXD+t+bG4Zv8OAdUpydZTU3UHmyjjiHv2Ww0PA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
       
        @vite(['resources/sass/app.scss', 'resources/css/app.css'])

        {{-- JQuery --}}
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        
    </head>

    <body>


        <div class="container-fluid vh-100">
            <div class="row bg-light">
                @auth <x-nav.main /> @endauth
            </div>

            <div class="row">
                @can('admin')
                    @if(request()->is(['admin*']))
                        <div class="d-none d-lg-block col-lg-2 overflow-auto ps-0">
                            <x-nav.admin />
                        </div>
                    @endif
                @endcan

                <div class="{{ (request()->is(['admin*']) ? "col-lg-10" : "col-lg-12") }} pt-5">
                    <div class="pt-4">
                        @yield('content')
                    </div>
                </div>

            </div>
        </div>


        {{-- Área de exibição das Toasts --}}
        <div class="toast-container position-fixed bottom-0 end-0 p-3">

            {{-- Mensagens de notificação --}}
            @if(session('message'))
                <x-toaster style="{{ session('style') }}" message="{{ session('message') }}" />
            @endif

            {{-- Mensagens de erros de validação --}}
            @if (count($errors) > 0)
                @foreach ($errors->all() as $e)
                    <x-toaster style="warning" message="{{ $e }}" />
                @endforeach
            @endif

        </div>

    </body>

    {{-- Scripts --}}
    
    {{-- Data Tables --}}
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script> --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css"/> --}}

    {{-- Bootstrap 5.2.2 --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- Pace --}}
    <script data-pace-options='{ "eventLag": false }' src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>

    {{-- JQuery Mask --}}
    {{-- <script src="{{ asset('jquery.mask.plugin/jquery.mask.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('jquery.mask.plugin/jquery.mask.custom.js') }}"></script> --}}
    
    
    {{-- 
        FIXME: Mover para o custom.js (quando funcionar)
    --}}
    <script>
        // TOASTER
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function(toastEl) {
            return new bootstrap.Toast(toastEl)
        })
        toastList.forEach(toast => toast.show());

        // TOOLTIPS
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // // DATA TABLES
        // $(document).ready( function () {
        //     $('.datatable').DataTable({
        //         order: [[ 2, 'desc' ], [ 0, 'asc' ]],
        //         "pageLength": 25,
        //         "language": {
        //             "sEmptyTable": "Nenhum registro encontrado",
        //             "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        //             "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
        //             "sInfoFiltered": "(Filtrados de _MAX_ registros)",
        //             "sInfoPostFix": "",
        //             "sInfoThousands": ".",
        //             "sLengthMenu": "_MENU_ resultados por página",
        //             "sLoadingRecords": "Carregando...",
        //             "sProcessing": "Processando...",
        //             "sZeroRecords": "Nenhum registro encontrado",
        //             "sSearch": "Pesquisar na tabela ",
        //             "oPaginate": {
        //                 "sNext": '<i class="bi bi-chevron-right"></i>',
        //                 "sPrevious": '<i class="bi bi-chevron-left"></i>',
        //                 "sFirst": "Primeiro",
        //                 "sLast": "Último"
        //             },
        //             "oAria": {
        //                 "sSortAscending": ": Ordenar colunas de forma ascendente",
        //                 "sSortDescending": ": Ordenar colunas de forma descendente"
        //             },
        //         }
        //     });
        // });
    </script>

    @yield('scripts')
</html>