@extends('layout')

@section('content')
    <content>
        <form action="{{url('article/'.$article->id)}}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="container">
                <label>Выберите категорию:</label>
                <select class="custom-select form-control" name="category">
                    @foreach($category as $c)
                        @if(($c->id)==($article->category_id))
                        <option selected value="{{$c->id}}">{{$c->category}}</OPTION>
                        @else
                        <option value="{{$c->id}}">{{$c->category}}</OPTION>
                        @endif
                    @endforeach
                </select>
                <br>
                <br>
                <input type="text" class="form-control" name="article_name" placeholder="Название статьи" value="{{$article->article_name}}" required>
                <br>
                <textarea class="form-control" name="article_body" rows="10" placeholder="Текст статьи" required>{{ $article->article_body }}</textarea>
                <br>
                <input type="submit" name="submit" class="btn btn-dark" value="Применить"/>
            </div>
        </form>
    </content>

    <br>

    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection