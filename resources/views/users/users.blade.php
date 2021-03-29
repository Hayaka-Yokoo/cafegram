@if(count($users) > 0)
    <ul class="list-unstyled">
        @foreach($users as $user)
            <li class="media">
                {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                <img class="mr-2 rounded" src="{{ Gravatar::get($user->email, ['size' => 50]) }}" alt="">
                <div class="media-body">
                    <div class="d-flex flex-row">
                        {{-- ユーザ名 --}}
                        {{ $user->name }}
                        {{-- フォロー／アンフォローボタン --}}
                        @include('user_follow.follow_button')
                    </div>
                    <div class="d-flex flex-row">
                        {{-- フォロワー --}}
                        <a href="{{ route('users.followers', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.followers') ? 'active' : '' }}">
                            Followers
                            <span class="badge badge-secondary">{{ $user->followers_count }}</span>
                        </a>
                        {{-- フォロー中 --}}
                        <a href="{{ route('users.followings', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.followings') ? 'active' : '' }}">
                            Followings
                            <span class="badge badge-secondary">{{ $user->followings_count }}</span>
                        </a>
                        {{-- 行きたいリスト --}}
                        {{-- ユーザ詳細ページへのリンク --}}
                        <p>{!! link_to_route('users.show', 'View profile', ['user' => $user->id]) !!}</p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $users->links() }}
@endif