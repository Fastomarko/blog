@extends('layout')

@section('content')
    <content>
        <form action="insert_article" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="container">
                <select class="custom-select form-control" name="category">
                    <option selected value="no">КАТЕГОРИИ</option>
                    @foreach($category as $c)
                    <option value="{{$c->id}}">{{$c->category}}</OPTION>
                        @endforeach
                </select>
                <br>
                <br>
                <input type="text" class="form-control" name="article_name" placeholder="Название статьи" required>
                <br>
                <textarea class="form-control" name="article_body" rows="10" placeholder="Текст статьи" required></textarea>
                <br>
                    <label for="img">Выберите фото</label>
                <br>
                    <input id="img" type="file" multiple name="file[]">
                <br>
                <br>
                <input type="submit" name="submit" class="btn btn-dark" value="Добавить"/>
            </div>
        </form>
    </content>
@endsection