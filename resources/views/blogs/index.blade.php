@extends('layout')

@section('content')
    <content>
        <div class="container">
            <div id="my_nav_col">
                <h1 class="display-3" ><strong>BLOG WAY</strong></h1>
                <h2>Just read...</h2>
            </div>

            <div class="row">
                <div class="col-7">

                    @foreach($data as $d)

                    <div class="row">
                        <div id="middlecol" class="col-4">
                            <img src="{{asset("img/".$d->photo[0]->photo_link)}}" class="rounded float-left" alt="Picture">
                        </div>
                        <div id="middlecol" class="col-8">
                            <a href="{{ url("article/".$d->id) }}"><h3>{{$d->article_name}}</h3></a>
                            <a href="#">{{$d->category->category}}</a>
                            <p>{!! str_limit($d->article_body, 200) !!}</p>
                            <a class="btn btn-secondary" href="{{ url("article/".$d->id) }}" role="button">Подробнее</a>
                        </div>
                    </div>

                    <hr>
                    @endforeach
                    {{ $data->links() }}
                </div>

                @include('partials.bestArticlesAndArchive');
            </div>
        </div>
    </content>
@endsection
@section('footer')
    <footer>
        <div id="my_nav" class="container-fluid">
            <div class="container">
                <div class="row">
                    <div id="my_nav_col" class="col">
                        <a id="my_nav_text" href="{{ url('/about_us') }}">О НАС</a>
                    </div>
                    <div id="my_nav_col" class="col">
                        <a id="my_nav_text" href="{{ url('/terms_of_use') }}">ПРАВИЛА ПОЛЬЗОВАНИЯ</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection