@extends('layouts.app')

@section('content')
      <main class="flex-grow-1">
       <div class="jumbotron jumbotron-fluid bg-dark">
        <div class="container-lg">
            <div class="row">
                <div class="col-12 col-md-10 col-lg-8 mx-auto text-white">
                    <h1 class="display-3">Анализатор страниц</h1>
                    <p class="lead">Бесплатно проверяйте сайты на SEO пригодность</p>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-block">

                            <!---<button type="button" class="close" data-dismiss="alert">×</button>   --> 

                            <strong>Некорректный URL </strong>

                        </div>
                    @endif

                    {{Form::open(['url' => route('urls.store'), 'method' => 'POST', 'class' => 'd-flex justify-content-center'])}}

                    {{Form::text('url[name]', '', ['class' =>'form-control form-control-lg', 'placeholder' => 'https://www.example.com'])}}

                    {{Form::submit('Проверить', ['class' => 'btn btn-lg btn-primary ml-3 px-5 text-uppercase'])}}
                    {{Form::close()}}

                </div>
            </div>
        </div>
    </div>
   </main>
@endsection
