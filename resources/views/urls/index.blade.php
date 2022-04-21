@extends('layouts.app')

@section('title', 'Список добавленных сайтов')

@section('content')
    <div class="container-lg site-list">
        <h1 class="mt-5 mb-3">Список сайтов</h1>

        @if (!empty($urls->isNotEmpty()))

            <div class="table-responsive">

                <table class="table table-bordered table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Последняя проверка</th>
                        <th>Код ответа</th>
                    </tr>

                    @foreach ($urls as $url)
                        <tr>
                            <td>{{ $url->id }}</td>
                            <td><a href="{{ route('urls.show', $url->id) }}">{{ $url->name }}</a></td>
                            <td>{{ $url->created_at ?? '-' }}</td>
                            <td>{{ $url->status_code ?? '-' }}</td>
                        </tr>
                    @endforeach

                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $urls->links() }}
            </div>
        @else
            <div class="mt-3">
                <div class="alert alert-info">Нет добавленных сайтов.</div>
            </div>
        @endif
    </div>

@endsection
