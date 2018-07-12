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
                            <img src="..." class="rounded float-left" alt="Picture">
                        </div>
                        <div id="middlecol" class="col-8">
                            <a href="#"><h3>{{$d->article_name}}</h3></a>
                            <a href="#">{{$d->category}}</a>
                            <p>{{str_limit($d->article_body, 200)}}</p>
                            <a class="btn btn-secondary" href="#" role="button">Learn more</a>
                        </div>
                    </div>

                    <hr>
                    @endforeach
                    {{ $data->links() }}
                </div>

                <div class="col-4 offset-1">
                    <div class="jumbotron">
                        <h4>Best articles:</h4>
                        <hr>
                        <ul class="list-group list-group-flush">
                            @foreach($likes as $l)

                            <li class="list-group-item">
                                <a id="my_nav_text" href="#">{{$l->article_name}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="jumbotron">
                        <h4>Archive:</h4>
                        <hr>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a id="my_nav_text" href="#">Date 1</a>
                            </li>
                            <li class="list-group-item">
                                <a id="my_nav_text" href="#">Date 2</a>
                            </li>
                            <li class="list-group-item">
                                <a id="my_nav_text" href="#">Date 3</a>
                            </li>
                            <li class="list-group-item">
                                <a id="my_nav_text" href="#">Date 4</a>
                            </li>
                            <li class="list-group-item">
                                <a id="my_nav_text" href="#">Date 5</a>
                            </li>
                        </ul>
                    </div>
                </div>
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
                        <a id="my_nav_text" href="#">ABOUT US</a>
                    </div>
                    <div id="my_nav_col" class="col">
                        <a id="my_nav_text" href="#">STATISTIC</a>
                    </div>
                    <div id="my_nav_col" class="col">
                        <a id="my_nav_text" href="#">TERMS OF USE</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection