@extends('layout.layout')

@section('page_title', $article->title)

@section('content')

<!-- Menu -->
<section id="menu">

    <!-- Search -->
    <section>
        <form class="search" method="get" action="#">
            <input type="text" name="query" placeholder="Search" />
        </form>
    </section>

    <!-- Links -->
    <section>
        <ul class="links">
            <li>
                <a href="#">
                    <h3>Lorem ipsum</h3>
                    <p>Feugiat tempus veroeros dolor</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <h3>Dolor sit amet</h3>
                    <p>Sed vitae justo condimentum</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <h3>Feugiat veroeros</h3>
                    <p>Phasellus sed ultricies mi congue</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <h3>Etiam sed consequat</h3>
                    <p>Porta lectus amet ultricies</p>
                </a>
            </li>
        </ul>
    </section>

    <!-- Actions -->
    <section>
        <ul class="actions stacked">
            <li><a href="{{ route('signin') }}" class="button large fit">Log In</a></li>
        </ul>
    </section>

</section>

<!-- Main -->
<div id="main">

    <!-- Post -->
    <article class="post">
        <header>
            <div class="title">
                <h2><a href="{{ route('article.single', $article) }}">{{ $article->title }}</a></h2>
                <p>{{ $article->short_text }}</p>
            </div>
            <div class="meta">
                <time class="published" datetime="2015-11-01">
                    {{ $article->created_at->format('M d, Y') }}
                </time>
                <a href="#" class="author"><span class="name">{{ $article->author()->username }}</span>
                    <img src="{{ $article->author()->image_path }}"
                         alt="{{ $article->title }}" />
                </a>
            </div>
        </header>
        <a href="{{ route('article.single', $article) }}" class="image featured">
            <img src="{{ $article->image_url }}"
                 alt="{{ $article->title }}" />
        </a>
        <p>{{ $article->content}}</p>
        <footer>
            <ul class="actions">
            </ul>
            <ul class="stats">
                <li><a href="#" class="icon solid fa-eye">
                        {{ $article->view_count }}
                    </a>
                </li>
                <li>
                    <a href="#" class="icon solid fa-comment">128</a>
                </li>
            </ul>
        </footer>
    </article>

    @auth()
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('article.delete', $article) }}">
                Удалить статью
            </a>
        @endif
    @endauth

    <div class="comments">
        @auth()
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <form method="post" action="{{ route('comment.store') }}" class="form-comment">
            @csrf
            <div class="form-group">
                <label for="">Ваш комментарий:</label>
                <textarea name="text" cols="20" rows="3"></textarea>
            </div>

            <input type="hidden" name="article_id" value="{{ $article->id }}">

            <button>Add comment</button>
        </form>
        @endauth

        @foreach($article->comments() as $comment)
                <ul class="list">
                    <li>
                        <h3 class="author">
                            {{ $comment->user()->username }}

                        </h3>
                        <p class="text">
                            {{ $comment->text }}
                        </p>
                        <time>
                            {{ $comment->created_at->format('M d, Y') }}
                        </time>
                    </li>
                </ul>
            @endforeach


        <style>
            .list{
                list-style: none;
                display: flex;
                flex-direction: column;
                gap: 16px;
            }

            .list li{
                padding: 24px;
                background: #fff;
                display: flex;
                flex-direction: column;
            }
        </style>

    </div>

</div>

<!-- Footer -->
<section id="footer">
    <ul class="icons">
        <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
        <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
        <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
        <li><a href="#" class="icon solid fa-rss"><span class="label">RSS</span></a></li>
        <li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
    </ul>
    <p class="copyright">&copy; Untitled. Design: <a href="http://html5up.net">HTML5 UP</a>. Images: <a href="http://unsplash.com">Unsplash</a>.</p>
</section>

@endsection
