@extends('layouts.admin')
@section('content')

<div class="row row-cols-1 pb-3">
    <div class="col">
        <div class="card">
            <x-forms.admin.perfil metodo="create" :perms="$perms" />
        </div>
    </div>
</div>

@endsection