<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div id="my_nav" class="container-fluid">
            <div class="container">
                <div class="row">
                    <div id="my_nav_col" class="col">
                        <a id="my_nav_text" href="{{ url('/home') }}">HOME</a>
                    </div>

                    <div id="my_nav_col" class="col">
                        <a id="my_nav_text" class="dropdown-toggle" href="#" id="navbarDropdownCategories" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            CATEGORIES
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownCategories">
                            <a class="dropdown-item" href="#">LIFE STYLE</a>
                            <a class="dropdown-item" href="#">NATURE</a>
                            <a class="dropdown-item" href="#">SCIENCE AND TECHNOLOGY</a>
                            <a class="dropdown-item" href="#">SPORTS</a>
                        </div>
                    </div>


                    @guest
                    <div id="my_nav_col" class="col offset-6">
                        <a id="my_nav_text" href="{{ route('login') }}">LOGIN</a>
                    </div>
                    <div id="my_nav_col" class="col">
                            <a id="my_nav_text" href="{{ route('register') }}">REGISTER</a>
                        </div>
                    @else
                        <div id="my_nav_col" class="col offset-6">
                            <a id="my_nav_text" href="{{ URL('article/create') }}">INSERT ARTICLE</a>
                        </div>
                        <div id="my_nav_col" class="col">
                            <a id="my_nav_text" class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
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
    @yield('content')
    @yield('footer')
</body>
</html>