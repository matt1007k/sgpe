@extends('layouts.client')
@section('title', 'Editar usuario')

@section('content')
<div class="container">
    <div class="content mt-0">
        <div class="flex align-center">
            <a href="{{ route('users.index') }}">
                <i class="material-icons-two-tone">keyboard_arrow_left</i>
            </a>
            <h2>Editar usuario</h2>
       </div>
    </div>    
    <div class="content">
        <div class="card grid">
            <div class="cols-4 sm:cols-8 md:cols-6">
                <h3 class="mb-1">Datos del usuario</h3>
                <p class="text-light-blue">Esta es la información para el contacto y verificación de los datos. </p>

                @if($user->file)
                    <h4 class="mt-2">Archivo Adjunto</h4>
                    <div id="preview-file"></div>
                @else
                    <div class="mt-2"></div>
                    <x-not-data color="info">
                        El usuario no tiene un archivo adjunto.
                    </x-not-data>
                @endif
            </div>
            <div class="cols-4 sm:cols-8 md:cols-6">
                <x-form method="put" :action="route('users.update', $user)">
                    @include('admin.users.partials.form', ['btnText' => 'Editar'])
                </x-form>
            </div>
        </div>
    </div>
</div>    
@endsection

@push('css')
<style>
.pdfobject-container { 
    height: 30rem; 
    border: 1rem solid rgba(0,0,0,.1); 
}
</style>
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.1/pdfobject.min.js" integrity="sha512-9DzkyDvuMQGyhz667AePDOK/90NyKn5uPuCtbBnoCUiN2MLxnLru0KqwYBl5vQBehDaGeGVGd/8gjGkfHZPQ4Q==" crossorigin="anonymous"></script> 
<script>
    @if($user->file)
        PDFObject.embed('{{ asset($user->pathFile()) }}', "#preview-file");
    @endif
</script>
@endpush

