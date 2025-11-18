@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Editar proyecto</h1>

    <livewire:proyecto-edit :proyecto-id="$proyecto->id" />
@endsection
