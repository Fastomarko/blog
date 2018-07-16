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

                    <div class="row">
                        <div id="middlecol" class="col-4">
                            <img src="..." class="rounded float-left" alt="Picture">
                        </div>
                        <div id="middlecol" class="col-8">
                            <a href="#"><h3>{{$article->article_name}}</h3></a>
                            <a href="#">{{$article->id_category}}</a>
                            <p>{{$article->article_body}}</p>
                        </div>
                    </div>

                    <hr>
                    <!--Добавление комментариев-->
                    @if (Auth::check())
                    <form action="insert_comment" method="get">
                        {{ csrf_field() }}
                        <div class="container">
                            <p>Add a comment:</p>
                            <textarea class="form-control" name="comment_text" rows="3" required></textarea>
                            <br>
                            <input type="submit" name="submit" class="btn btn-dark" value="Add a comment:"/>
                        </div>
                    </form>
                    @endif
                    <!--Тут комменты и т.д.-->
                    <div class="row">
                        <div class="col">
                            <br>
                            <p>Комментарии:</p>
                            <!--этот блок под ajax-->
                            @foreach($comments as $c)
                            <div class="container">
                                <hr>
                                <div class="row">
                                    <!--ебани влево-->
                                    <div class="col">
                                        <p><strong>{{$c->id_user}}</strong></p>
                                    </div>
                                    <!--ебани вправо-->
                                    <div class="col">
                                        <p>{{$c->updated_at}}</p>
                                    </div>
                                </div>
                                <p>{{$c->comment_text}}</p>
                                <hr>
                            </div>
                            @endforeach
                            <!--этот блок под ajax-->
                        </div>
                    </div>
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