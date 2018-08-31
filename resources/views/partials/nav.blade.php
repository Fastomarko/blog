<header>
    <div id="my_nav" class="container-fluid">
        <div class="container">
            <div class="row">
                <div id="my_nav_col" class="col">
                    <a id="my_nav_text" href="{{ url('/home') }}">HOME</a>
                </div>

                <div id="my_nav_col" class="col">
                    <a id="my_nav_text" class="dropdown-toggle" href="#" id="navbarDropdownCategories" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        КАТЕГОРИИ
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownCategories">
                        @foreach($Categories as $c)
                            <a class="dropdown-item" href="{{ url("categories/".$c->id) }}">{{$c->category}}</a>
                        @endforeach
                    </div>
                </div>


                @guest
                    <div id="my_nav_col" class="col offset-6">
                        <a id="my_nav_text" href="{{ route('login') }}">ВХОД</a>
                    </div>
                    <div id="my_nav_col" class="col">
                        <a id="my_nav_text" href="{{ route('register') }}">РЕГИСТРАЦИЯ</a>
                    </div>
                @else
                    <div id="my_nav_col" class="col offset-4">
                        <a id="my_nav_text" href="{{ URL('article/create') }}">ДОБАВИТЬ СТАТЬЮ</a>
                    </div>
                    <div id="my_nav_col" class="col">
                        <a id="my_nav_text" class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Выход') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
    <br>
</header>