@extends('layout')

@section('content')
    <content>
        <form action="{{url('article')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="container">
                <label>Выберите категорию:</label>
                <select class="custom-select form-control" name="category">
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