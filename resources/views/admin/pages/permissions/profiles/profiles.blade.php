@extends('adminlte::page')

@section('title','Perfis da permissão')

@section('content_header')
<ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('permissions.index') }}">Permissões</a></li>
    </ol>
    <h1>Perfis da permissão  {{ $permission->name }} </h1>

@endsection

@section('content')
        <div class="card">

            @include('admin.includes.alerts')

            <div class="card-body">
                 <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th width="50">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profiles as $profile)
                            <tr>
                                <td>{{ $profile->name }}</td>
                                <td>
                                    <a href="{{ route('profiles.permissions.detach',[$profile->id,$permission->id]) }}" class="btn btn-danger">Desvincular</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
              </table>
              <div class="card footer">
                  @if (isset($filters))
                      {!! $profiles->appends($filters)->links() !!}
                  @else
                    {!! $profiles->links() !!}
                  @endif
              </div>

            </div>



        </div>
@endsection
