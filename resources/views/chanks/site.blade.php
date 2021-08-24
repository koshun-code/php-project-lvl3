@extends('layouts.app')

@section('content')
<main class="flex-grow-1">
  
<div class="container-lg">
        <h1 class="mt-5 mb-3">Сайт: {{$url[0]->name}}</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <tbody><tr>
                    <td>ID</td>
                    <td>{{$url[0]->id}}</td>
                </tr>
                <tr>
                    <td>Имя</td>
                    <td>{{$url[0]->name}}</td>
                </tr>
                <tr>
                    <td>Дата создания</td>
                    <td>{{$url[0]->created_at}}</td>
                </tr>
                <tr>
                    <td>Дата обновления</td>
                    <td>{{$url[0]->updated_at}}</td>
                </tr>
            </tbody></table>
        </div>
       <!-- <h2 class="mt-5 mb-3">Проверки</h2>
        <form method="post" action="https://php-l3-page-analyzer.herokuapp.com/urls/1/checks">
            <input type="hidden" name="_token" value="4M6aTTYPEaZE1TOvblHLsVZW9ahUPnx3AMZiHpRd">            <input type="submit" class="btn btn-primary" value="Запустить проверку">
        </form>
            <table class="table table-bordered table-hover text-nowrap">
                <tbody><tr>
                    <th>ID</th>
                    <th>Код ответа</th>
                    <th>h1</th>
                    <th>keywords</th>
                    <th>description</th>
                    <th>Дата создания</th>
                </tr>
                                    <tr>
                        <td>614</td>
                        <td>200</td>
                        <td>All-in-one...</td>
                        <td></td>
                        <td>A new tool that blends your ev...</td>
                        <td>2021-08-20 20:54:37</td>
                    </tr>
                </tbody>
            </table>-->
</div>
             
</main>
@endsection