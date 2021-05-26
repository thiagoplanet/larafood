@extends('adminlte::page')

@section('title','Cadastrar novo perfil')

@section('content_header')
    <h1>Cadastrar novo perfil</h1>
@endsection

@section('content')
        <div class="card">

            <div class="card-body">
               <form action="{{ route('permissions.store') }}" class="form" method="POST">
                @csrf

               @include('admin.pages.permissions._partials.form')

               </form>

            </div>

        </div>
@endsection
