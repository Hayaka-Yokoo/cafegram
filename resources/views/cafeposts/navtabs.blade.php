{{-- タイトル --}}
    <div class="text-center">
        <div class="text-center style2 style3">
            <h1>Cafegram</h1>
        </div>
    </div>
        <div class="flexbox">
            <div class="text-center">
            {{-- 投稿ページへのリンク　--}}
                <a href="{{ route('cafeposts.create')}}" class=""><button class="Button-style">+投稿する</button></a>
            {{-- マイページへのリンク --}}
                <a href="{{ route('users.show', ['user' => Auth::id()]) }}" class=""><button class="Button-style">マイページ</button></a>
            {{-- 行きたいリストへのリンク --}}
                <a href="{{ route('users.favorites', ['id' => Auth::id()]) }}" class=""><button class="Button-style">行きたいリスト</button></a>
        
            {{-- カテゴリ検索 --}}
                <a href="{{ route('categories.search') }}" class=""><button class="Button-style"><i class="fas fa-search"></i>カテゴリ検索</button></a>
            </div>
        </div>
            <ul class="nav nav-tabs nav-fill">
                <li class="nav-item">
                    <a href="{{ route('cafeposts.index') }}" class="nav-link {{ Request::routeIs('cafeposts.index') ? 'active' : '' }}" style="color: #cd853f;">
                        タイムライン
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cafeposts.popular') }}" class="nav-link {{ Request::routeIs('cafeposts.popular') ? 'active' : '' }}" style="color: #cd853f;">
                        人気
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cafeposts.post') }}" class="nav-link {{ Request::routeIs('cafeposts.post') ? 'active' : '' }}" style="color: #cd853f;">
                        すべての投稿
                    </a>
                </li>
            </ul>
