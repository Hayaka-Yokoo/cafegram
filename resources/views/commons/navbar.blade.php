<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<header class="mb-4">
        <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #8b4513;">
        {{-- トップページへのリンク --}}
        <a class="style1" href="/">Cafegram</a>
        
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if(Auth::check())
                {{-- ユーザ一覧ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('users.index', 'Users', [], ['class' => 'nav-link']) !!}</li>
                {{-- 投稿ページへのリンク --}}
                    {!! link_to_route('cafeposts.create', '＋投稿する', [], ['class' => 'nav-link']) !!}
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        {{-- ユーザ詳細のページへのリンク --}}
                        <li class="dropdown-item">
                            {!! link_to_route('users.show', 'マイページ', ['user' => Auth::id()]) !!}
                        </li>
                        <li class="dropdown-item">
                               <p>{!! link_to_route('users.favorites', '行きたいリスト', ['id' => Auth::id()]) !!}</p>
                        </li>
                        <li class="dropdown-divider"></li>
                        {{-- ログアウトへのリンク --}}
                        <li class="dropdown-item">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
                    </ul>
                </li>
                @else
                    {{-- ユーザ登録ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('signup.get', '新規登録', [], ['class' => 'nav-link']) !!}</li>
                    {{-- ログインページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>