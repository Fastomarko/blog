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
                            <img src="{{asset("img/".$article->photo[0]->photo_link)}}" class="rounded float-left" alt="Picture">
                        </div>
                        <div id="middlecol" class="col-8">
                            <a href="#"><h3>{{$article->article_name}}</h3></a>
                            <a href="#">{{$article->category->category}}</a>
                            <p>{!! $article->article_body !!}</p>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col">
                            <form action="{{ url("article/".$article->id."/insert_like") }}" method="post">
                                {{ csrf_field() }}
                                <div class="container">
                                    <button type="submit" name="submit" class="btn btn-primary">
                                        Likes <div class="badge badge-light">{{$like}}</div>
                                    </button>
                                </div>
                            </form>
                        </div>
                        @if(auth()->user()!=null)
                            @if ((auth()->user()->id)==$article->user_id)
                        <div class="col">
                            <a class="btn btn-secondary" href="{{ url("article/".$article->id."/edit") }}" role="button">Редактировать</a>
                        </div>

                        <div class="col">
                            <form action="{{url('article/'.$article->id)}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="submit" name="submit" class="btn btn-secondary" value="Удалить"/>
                            </form>
                        </div>
                            @endif
                        @endif
                    </div>
                    <hr>

                    <!--Добавление комментариев-->
                    @if (Auth::check())
                    <form action="{{ url("article/".$article->id."/insert_comment") }}" method="post">
                        {{ csrf_field() }}
                        <div class="container">
                            <p>Добавить комментарий:</p>
                            <textarea class="form-control" name="comment_text" rows="3" required></textarea>
                            <br>
                            <input type="submit" name="submit" class="btn btn-dark" value="Добавить комментарий"/>
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

                                    <div class="col">
                                        <p><strong>{{$c->user->name}}</strong></p>
                                    </div>

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