@extends('adminlte::page')

@section('title', 'Permissoes disponiveis para o perfil')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.index') }}">Perfis</a></li>
    </ol>
    <h1>Permissoes disponiveis para o perfil {{ $profile->name }}</h1>

@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('profiles.permissions.available',$profile->id) }}" method="post">
                @csrf
                <input type="text" name="filter" placeholder="Filtro" class="form-control col-10" value="">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>

        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width='50'>#</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('profiles.permissions.attache', $profile->id) }}" method="post">
                        @csrf
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                                </td>
                                <td>
                                    {{ $permission->name }}
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan='500'>
                                @include('admin.includes.alerts')
                                <button type="submit" class="btn btn-info">Vincular</button>
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
            <div class="card footer">
                @if (isset($filters))
                    {!! $permissions->appends($filters)->links() !!}
                @else
                    {!! $permissions->links() !!}
                @endif
            </div>

        </div>



    </div>
@endsection
