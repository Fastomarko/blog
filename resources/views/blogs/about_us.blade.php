@extends('layout')

@section('content')
    <content>
        <div class="container">
            <div id="my_nav_col">
                <h1 class="display-3" ><strong>BLOG WAY</strong></h1>
                <h2>Just read...</h2>
            </div>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h1>О блоге</h1>
                                <p>
                                    Блог (англ. blog, от web log — интернет-журнал событий, интернет-дневник, онлайн-дневник) — веб-сайт, основное содержимое которого — регулярно добавляемые записи, содержащие текст, изображения или мультимедиа.<br><br>

                                    Людей, ведущих блог, называют бло́герами. Совокупность всех блогов Сети принято называть блогосферой.<br><br>

                                    Для блогов характерна возможность публикации отзывов (комментариев) посетителями. Она делает блоги средой сетевого общения, имеющей ряд преимуществ перед электронной почтой, группами новостей и чатами.<br><br>

                                    Первым блогом считается страница Тима Бернерса-Ли, где он, начиная с 1992 г., публиковал новости. Более широкое распространение блоги получили с 1996 г. В августе 1999 г. компьютерная компания Pyra Labs из Сан-Франциско открыла сайт Blogger.com, который стал первой бесплатной блоговой службой.<br><br>

                                    В настоящее время особенность блогов заключается не только в структуре записей, но и в простоте добавления новых записей. Пользователь просто обращается к веб-серверу, проходит процесс идентификации пользователя, после чего он добавляет новую запись к своей коллекции. Сервер представляет информацию как последовательность сообщений, помещая в самом верху самые свежие сообщения. Структура коллекции напоминает привычную последовательную структуру дневника или журнала.
                                </p>
                            </div>
                            <div class="col-4">
                                <p>
                                <h2>Свяжитесь с нами!</h2><br>
                                    У нас есть офисы в России, Израиле и США. Не стесняйтесь обращаться к нам с любыми вопросами или проблемами. Наши дружественные
                                    и информированный персонал рад помочь!<br><br>
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3168.6674560284932!2d-122.10435098505666!3d37.42133427982535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fba1237d1e225%3A0x40af1137a5083863!2zODI1IFNhbiBBbnRvbmlvIFJkLCBQYWxvIEFsdG8sIENBIDk0MzAzLCDQodCo0JA!5e0!3m2!1sru!2sru!4v1531987389704" width="350" height="300" frameborder="0" style="border:0" allowfullscreen></iframe><br><br>
                                    Blogway, LLC<br>
                                    8225 San Antonio Rd.<br>
                                    Palo Alto, CA 94303.<br>

                                    Telephone: +1 123 212 1233<br>
                                    E-mail: info@info.com <br>
                                    ------------------------------<br>
                                    Blogway LTD <br>
                                    Habanim 142 Hod Hasharon <br>
                                    Israel<br>

                                    Telephone: +123123123123<br>
                                </p>
                            </div>
                        </div>
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