@extends('layouts.app')

@section('content')
      <main class="flex-grow-1">
       <div class="jumbotron jumbotron-fluid bg-dark">
        <div class="container-lg">
            <div class="row">
                <div class="col-12 col-md-10 col-lg-8 mx-auto text-white">
                    <h1 class="display-3">Станицы</h1>
                    @foreach($urls as $url)
                    <p><a href="{{route('urls.site', $url->id)}}"> {{$url->name}}</a></p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
   </main>
@endsection