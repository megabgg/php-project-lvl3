@extends('layouts.app')

@section('title', 'Главная - Добавить сайт')

@section('content')
    <div class="container-lg pt-5">
        <div class="row">
            <div class="jumbotron jumbotron-fluid">
                <div class="col-12 col-md-10 col-lg-8 mx-auto">
                    <h1 class="display-3">Анализатор страниц</h1>
                    <p class="lead">Проверка доступности, а также основных мета-параметров.</p>
                    {{ Form::open(['url' => route('urls.store'), 'class' => 'd-flex justify-content-center']) }}
                    {{ Form::text('url[name]', '', ['class' => 'form-control form-control-lg', 'placeholder' => 'https://example.com']) }}
                    {{ Form::submit('Проверить', ['class' => 'btn btn-primary btn-lg text-white ml-3 px-3 text-uppercase rounded-right']) }}
                    {{ Form::close() }}
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger mt-5" role="alert">
                        <ul class="m-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
