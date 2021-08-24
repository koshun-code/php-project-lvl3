@extends('layouts.app')

@section('content')
<main class="flex-grow-1">
       
    <div class="container-lg">
        <h1 class="mt-5 mb-3">Сайты</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Последняя проверка</th>
                    <th>Код ответа</th>
                </tr>
                @foreach($urls as $url)
                <tr>
                        <td>{{$url->id}}</td>
                        <td><a href="{{route('urls.site', ['id' => $url->id])}}">{{$url->name}}</a></td>
                        <td>{{$url->updated_at}}</td>
                        <td>200</td>
                </tr>
                @endforeach
                </tbody></table>
        @if (count($urls) < 15)
        @else
            <nav>
            <ul class="pagination">
                    
                <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                    <span class="page-link" aria-hidden="true">‹</span>
                </li>
                <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                <li class="page-item"><a class="page-link" href="https://php-l3-page-analyzer.herokuapp.com/urls?page=2">2</a></li>
                <li class="page-item"><a class="page-link" href="https://php-l3-page-analyzer.herokuapp.com/urls?page=3">3</a></li>
                <li class="page-item"><a class="page-link" href="https://php-l3-page-analyzer.herokuapp.com/urls?page=4">4</a></li>
                <li class="page-item"><a class="page-link" href="https://php-l3-page-analyzer.herokuapp.com/urls?page=5">5</a></li>
                <li class="page-item"><a class="page-link" href="https://php-l3-page-analyzer.herokuapp.com/urls?page=6">6</a></li>
                <li class="page-item"><a class="page-link" href="https://php-l3-page-analyzer.herokuapp.com/urls?page=7">7</a></li>
                <li class="page-item"><a class="page-link" href="https://php-l3-page-analyzer.herokuapp.com/urls?page=8">8</a></li>
                <li class="page-item"><a class="page-link" href="https://php-l3-page-analyzer.herokuapp.com/urls?page=9">9</a></li>
                <li class="page-item"><a class="page-link" href="https://php-l3-page-analyzer.herokuapp.com/urls?page=10">10</a></li>                                                 
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                <li class="page-item"><a class="page-link" href="https://php-l3-page-analyzer.herokuapp.com/urls?page=13">13</a></li>
                <li class="page-item">
                    <a class="page-link" href="https://php-l3-page-analyzer.herokuapp.com/urls?page=2" rel="next" aria-label="Next »">›</a>
                </li>
            </ul>
            </nav>
        @endif
        </div>
    </div>
</main>
@endsection
