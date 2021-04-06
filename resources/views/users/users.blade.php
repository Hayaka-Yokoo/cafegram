@if(count($users) > 0)
    <ul class="list-unstyled">
        @foreach($users as $user)
        <div class="card-8 style3">
            <li class="media">
                {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                <img class="mr-2 rounded" src="{{ Gravatar::get($user->email, ['size' => 50]) }}" alt="">
                <div class="media-body">
                    <div class="d-flex flex-row" style="margin: 10px;">
                        {{-- ユーザ名 --}}
                        {{ $user->name }}
                        <div class="right">
                        {{-- フォロー／アンフォローボタン --}}
                        @include('user_follow.follow_button')
                        </div>
                    </div>
                    <div class="d-flex flex-row">
                        {{-- フォロワー --}}
                        <a class="btn-circle" style="margin-right: 10px;"><p style="font-size: 10px;">Followers {{ $user->followers()->count() }}</p></a>
                        {{-- フォロー中 --}}
                        <a class="btn-circle" style="margin: 0 10px"><p style="font-size: 10px;">Followings {{ $user->followings()->count() }}</p></a>
                        {{-- ユーザ詳細ページへのリンク --}}
                        <a href="{{ route('users.show', ['user' => $user->id]) }}" class="btn-circle-flat" style="margin-left: 10px;"><p style="font-size: 10px;">Viewprofile</p></a>
                        
                    </div>
                </div>
            </li>
        </div>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $users->links() }}
@endif