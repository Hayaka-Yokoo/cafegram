<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@if (count($cafeposts) > 0)
    <ul class="list-unstyled">
        <div class="card-columns">
        @foreach($cafeposts as $cafepost)
            <div class="card text-center border-dark mb-3" style="width: 18rem;">
                <div class="card-header bg-transparent border-dark">
                    {{ $cafepost->store_name }}
                </div>
                <img class="card-img-top" src="{{ Storage::disk('s3')->url($cafepost->img) }}" alt="">
                <div class="card-body">
                    <h5 class="card-title">{{ $cafepost->title }}</h5>
                    <p class="card-text">{{ $cafepost->comment }}</p>
                    <p class="card-text"><small class="text-muted">
                        @foreach($cafeCategory as $item)
                            @if($item->cafepost_id == $cafepost->id)
                                #{{ $disCategory[$item->category_id]->category_name }}
                            @endif
                        @endforeach
                    </small></p>
                    {{-- カフェ詳細ページへ --}}
                    <a href="{{ route('cafeposts.show', ['cafepost' => $cafepost->id]) }}" class="nav-link {{ Request::routeIs('cafeposts.show') ? 'active' : '' }}">
                        もっと見る
                    </a>
                </div>
            </div>
        @endforeach
        </div>
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $cafeposts->links() }}
@endif