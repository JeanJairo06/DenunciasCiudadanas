@extends('layout.app')

@section('title', isset($denuncia) && $denuncia ? 'Editar denuncia' : 'Registrar denuncia')

@section('content')
    @if(isset($denuncia) && $denuncia)
        @livewire('denuncia-form', ['denuncia' => $denuncia], key($denuncia->id))
    @else
        @livewire('denuncia-form', ['denuncia' => null], key('create'))
    @endif
@endsection