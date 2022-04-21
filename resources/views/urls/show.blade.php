@extends('layouts.app')

@section('title', "Анализ сайта - {$url->name}")

@section('content')
    <div class="container">
        <h1 class="mt-5 mb-3">
            Сайт: {{ $url->name }}
        </h1>
        <table class="table table-bordered table-hovered">
            <tr>
                <td>ID</td>
                <td>{{ $url->id }}</td>
            </tr>
            <tr>
                <td>Имя</td>
                <td>{{ $url->name }}</td>
            </tr>
            <tr>
                <td>Дата создания</td>
                <td>{{ $url->created_at }}</td>
            </tr>
        </table>
        <h2 class="mt-5 mb-3">Проверки</h2>
        {{ Form::open(['url' => route('url_checks.store', $url->id)]) }}
        {{ Form::submit('Запустить проверку', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}

        @if ($checks->isNotEmpty())
            <table class="table table-bordered table-hover text-nowrap mt-3">
                <tr>
                    <th>ID</th>
                    <th>Код ответа</th>
                    <th>h1</th>
                    <th>keywords</th>
                    <th>description</th>
                    <th>Дата создания</th>
                </tr>
                @foreach ($checks as $check)
                    <tr>
                        <td>{{ $check->id }}</td>
                        <td>{{ $check->status_code }}</td>
                        <td>{{ Str::limit($check->h1, 25) }}</td>
                        <td>{{ Str::limit($check->keywords, 25) }}</td>
                        <td>{{ Str::limit($check->description, 25) }}</td>
                        <td>{{ $check->created_at }}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <div class="mt-3">
                <div class="alert alert-info">На данный момент нет ни одной проверки</div>
            </div>
        @endif
        <div class="mt-3 d-flex">
            {{ $checks->links() }}
        </div>
    </div>
@endsection
