@extends('adminlte::page')

@section('title','Detalhes do plano')

@section('content_header')
<ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show',$plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('details.plan.index',$plan->url) }}"  class="active">Detalhes</a></li>
    </ol>
    <h1>Detalhes do Plano {{ $plan->name}}  <a href="{{ route('details.plan.create',$plan->url) }}" class="btn btn-dark"> <i class="fas fa-plus-square"></i> ADD</a></h1>

@endsection

@section('content')
        <div class="card">
            <div class="card-body">
                 <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th width="150">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $detail)
                            <tr>
                                <td>{{ $detail->name }}</td>
                                <td>
                                    <a href="{{ route('details.plan.edit',[$plan->url, $detail->id]) }}" class="btn btn-info">Edit</a>
                                    <a href=" {{ route('details.plan.show',[$plan->url, $detail->id]) }}"  class="btn btn-warning">Ver</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
              </table>


            </div>



        </div>
@endsection
