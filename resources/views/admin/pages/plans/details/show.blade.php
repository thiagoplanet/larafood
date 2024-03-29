@extends('adminlte::page')

@section('title',"Detalhes do {$plan->name}")

@section('content_header')
<ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show',$plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('details.plan.index',$plan->url) }}">Detalhes</a></li>
        <li class="breadcrumb-item"><a href="{{ route('details.plan.edit',[$plan->url,$detail->id]) }}"  class="active">Detalhes</a></li>
    </ol>
    <h1> Editar o Detalh {{$plan->name}} </h1>

@endsection

@section('content')
        <div class="card">
            <div class="card-body">

                <ul>
                    <li>
                        <strong>Nome: </strong>{{ $detail->name }}
                    </li>
                </ul>
            </div>
            <div class="card-footer">
                <form action="{{ route('details.plan.destroy',[$plan->url,$detail->id]) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Deletar o detalhe {{ $detail->name }}</button>
                </form>
            </div>


        </div>
@endsection
