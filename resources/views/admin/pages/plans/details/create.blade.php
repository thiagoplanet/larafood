@extends('adminlte::page')

@section('title',"Adicionar Detalhe no plano {$plan->name}")

@section('content_header')
<ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show',$plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('details.plan.index',$plan->url) }}">Detalhes</a></li>
        <li class="breadcrumb-item"><a href="{{ route('details.plan.create',$plan->url) }}"  class="active">Novo</a></li>
    </ol>
    <h1>Detalhes do Plano {{ $plan->name}} </h1>

@endsection

@section('content')
        <div class="card">
            <div class="card-body">

                <form action="{{ route('details.plan.store',$plan->url) }}" method="post">
                    @include('admin.pages.plans.details._partials.form')
                </form>

            </div>



        </div>
@endsection
