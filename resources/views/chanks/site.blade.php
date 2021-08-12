@extends('layouts.app')

@section('content')
      <main class="flex-grow-1">
       <div class="jumbotron jumbotron-fluid bg-dark">
        <div class="container-lg">
            <div class="row">
                <div class="col-12 col-md-10 col-lg-8 mx-auto text-white">
                    <h1 class="display-3">Сайт</h1>
                   <p> {{$url[0]->name}}</p>
                </div>
            </div>
        </div>
    </div>
   </main>
@endsection