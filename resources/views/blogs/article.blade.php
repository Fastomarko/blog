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
                            <img src="{{asset("img/".$article[0]->photo[0]->photo_link)}}" class="rounded float-left" alt="Picture">
                        </div>
                        <div id="middlecol" class="col-8">
                            <a href="#"><h3>{{$article[0]->article_name}}</h3></a>
                            <a href="#">{{$article[0]->category->category}}</a>
                            <p>{{$article[0]->article_body}}</p>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col">
                            <form action="insert_like" method="post">
                                {{ csrf_field() }}
                                <div class="container">
                                    <button type="submit" name="submit" class="btn btn-primary">
                                        Likes <span class="badge badge-light">{{$like}}</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        @if ((auth()->user()->id)==$article[0]->user_id)
                        <div class="col">
                            <a class="btn btn-secondary" href="{{ url("article/".$article[0]->id."/update") }}" role="button">Update</a>
                        </div>

                        <div class="col">
                            <a class="btn btn-secondary" href="{{ url("article/".$article[0]->id."/delete") }}" role="button">Delete</a>
                        </div>
                        @endif
                    </div>
                    <hr>

                    <!--Добавление комментариев-->
                    @if (Auth::check())
                    <form action="insert_comment" method="post">
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
                            @foreach($comment as $c)
                            <div class="container">
                                <hr>
                                <div class="row">
                                    <!--ебани влево-->
                                    <div class="col">
                                        <p><strong>{{$c->user->name}}</strong></p>
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
                            @foreach($bestArticles as $b)
                            <li class="list-group-item">
                                <a id="my_nav_text" href="{{ url("article/".$b->id) }}">{{$b->article_name}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="jumbotron">
                        <h4>Archive:</h4>
                        <hr>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a id="my_nav_text" href="#">2018</a>
                            </li>
                            <li class="list-group-item">
                                <a id="my_nav_text" href="#">2017</a>
                            </li>
                            <li class="list-group-item">
                                <a id="my_nav_text" href="#">2016</a>
                            </li>
                            <li class="list-group-item">
                                <a id="my_nav_text" href="#">2015</a>
                            </li>
                            <li class="list-group-item">
                                <a id="my_nav_text" href="#">2014</a>
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
                        <a id="my_nav_text" href="{{ url('/about_us') }}">ABOUT US</a>
                    </div>
                    <div id="my_nav_col" class="col">
                        <a id="my_nav_text" href="{{ url('/terms_of_use') }}">TERMS OF USE</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection