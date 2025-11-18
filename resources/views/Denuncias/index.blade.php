@extends('layout.app')

@section('title', 'Listado de denuncias')

@section('content')
    @livewire('denuncias-muni')

        @if(Session('error') || Session('success'))
    @include('layout.confirm')
    @endif
@endsection
