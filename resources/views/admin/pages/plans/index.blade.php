@extends('adminlte::page')

@section('title','Planos')

@section('content_header')
<ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.index') }}">Planos</a></li>
    </ol>
    <h1>Planos <a href="{{ route('plans.create') }}" class="btn btn-dark"> <i class="fas fa-plus-square"></i> ADD</a></h1>

@endsection

@section('content')
        <div class="card">
            <div class="card-header">
                <form action="{{ route('plans.search') }}" method="post">
                    @csrf
                    <input type="text" name="filter" placeholder="Nome" class="form-control col-10" value="">
                    <button type="submit" class="btn btn-dark">Filtrar</button>
                </form>
            </div>
            @include('admin.includes.alerts')

            <div class="card-body">
                 <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th width="290">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plans as $plan)
                            <tr>
                                <td>{{ $plan->name }}</td>
                                <td> R$ {{ number_format($plan->price,2,',','.') }}</td>
                                <td>
                                    <a href="{{ route('details.plan.index',$plan->url) }}" class="btn btn-primary">Detalhes</a>
                                    <a href="{{ route('plans.edit',$plan->url) }}" class="btn btn-info">Edit</a>
                                    <a href=" {{ route('plans.show',$plan->url) }}"  class="btn btn-warning">Ver</a>
                                    <a href=" {{ route('plans.profiles',$plan->id) }}"  class="btn btn-warning"><i class="fas fa-address-book"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
              </table>
              <div class="card footer">
                  @if (isset($filters))
                      {!! $plans->appends($filters)->links() !!}
                  @else
                    {!! $plans->links() !!}
                  @endif
              </div>

            </div>



        </div>
@endsection
