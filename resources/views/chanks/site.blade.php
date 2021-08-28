@extends('layouts.app')

@section('content')
<main class="flex-grow-1">
  
<div class="container-lg">
        <h1 class="mt-5 mb-3">Сайт: {{$url->name}}</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <tbody><tr>
                    <td>ID</td>
                    <td>{{$url->id}}</td>
                </tr>
                <tr>
                    <td>Имя</td>
                    <td>{{$url->name}}</td>
                </tr>
                <tr>
                    <td>Дата создания</td>
                    <td>{{$url->created_at}}</td>
                </tr>
                <tr>
                    <td>Дата обновления</td>
                    <td>{{$url->updated_at}}</td>
                </tr>
            </tbody></table>
        </div>
        <h2 class="mt-5 mb-3">Проверки</h2>
        {{Form::open(['url' => route('urls.check', ['id' => $url->id]), 'method' => 'POST', ])}}
        {{Form::submit('Запустить проверку', ["class" => "btn btn-primary mb-4"])}}
        {{Form::close()}}
        @if (count($checkedUrl) > 0)
            <table class="table table-bordered table-hover text-nowrap">
                <tbody><tr>
                    <th>ID</th>
                    <th>Код ответа</th>
                    <th>h1</th>
                    <th>keywords</th>
                    <th>description</th>
                    <th>Дата создания</th>
                </tr>
                @foreach($checkedUrl as $checkUrl)
                <tr>
                        <td>{{$checkUrl->id}}</td>
                        <td>{{$checkUrl->status_code}}</td>
                        <td>{{Str::limit($checkUrl->h1, 30, ' ...') }}</td>
                        <td>{{Str::limit($checkUrl->keywords, 40, ' ...')}}</td>
                        <td>{{Str::limit($checkUrl->description, 40, ' ...')}}</td>
                        <td>{{$checkUrl->updated_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
</div>
             
</main>
@endsection