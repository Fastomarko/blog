<div class="col-4 offset-1">
    <div class="jumbotron">
        <h4>Популярные статьи:</h4>
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
        <h4>Архив:</h4>
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