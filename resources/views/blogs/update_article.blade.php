@extends('layout')

@section('content')
    <content>
        <form action="update_article" method="post">
            {{ csrf_field() }}
            <div class="container">
                <select class="custom-select form-control" name="category">
                    <option selected value="no">CATEGORY</option>
                    @foreach($category as $c)
                    <option value="{{$c->id}}">{{$c->category}}</OPTION>
                        @endforeach
                </select>
                <br>
                <br>
                <input type="text" class="form-control" name="article_name" placeholder="Article name" value="{{$article[0]->article_name}}" required>
                <br>
                <textarea class="form-control" name="article_body" rows="10" placeholder="Article body" required>{{$article[0]->article_body}}</textarea>
                <br>
                <input type="submit" name="submit" class="btn btn-dark" value="Apply"/>
            </div>
        </form>
    </content>
@endsection