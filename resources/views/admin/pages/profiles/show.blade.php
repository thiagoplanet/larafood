@extends('adminlte::page')

@section('title',"Detalhes do profile {$profile->name}")

@section('content_header')
    <h1>Detalhes do perfil <b>{{ $profile->name }}</b></h1>
@endsection

@section('content')
        <div class="card">

            <div class="card-body">
                <ul>
                    <li>
                        <strong>Nome: </strong> {{ $profile->name }}
                    </li>
                    <li>
                        <strong>Descrição: </strong> {{ $profile->description }}
                    </li>
                </ul>

                @include('admin.includes.alerts')

                <form action="{{ route('profiles.destroy',$profile->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i>Deletar perfil</button>
                </form>

            </div>

        </div>
@endsection
