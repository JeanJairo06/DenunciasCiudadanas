@extends('layout.app')

@section('title', $mode === 'edit' ? 'Editar denuncia' : 'Registrar denuncia')

@section('content')
    <div class="max-w-5xl mx-auto">
        @livewire('denuncia-form', ['denuncia' => $denuncia])
    </div>
@endsection
