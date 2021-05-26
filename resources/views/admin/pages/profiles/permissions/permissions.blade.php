@extends('adminlte::page')

@section('title','Permissoes do perfil')

@section('content_header')
<ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.index') }}">Perfis</a></li>
    </ol>
    <h1>Permissoes do perfil  {{ $profile->name }}
        <a href="{{ route('profiles.permissions.available',$profile->id) }}" class="btn btn-dark"> <i class="fas fa-plus-square"></i> ADD nova permissão</a></h1>

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
                        @foreach ($permissions as $permisson)
                            <tr>
                                <td>{{ $permisson->name }}</td>
                                <td>
                                    <a href="{{ route('profiles.permissions.detach',[$profile->id,$permisson->id]) }}" class="btn btn-danger">Desvincular</a>
                                </td>
                            </tr>
                        @endforeach
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
