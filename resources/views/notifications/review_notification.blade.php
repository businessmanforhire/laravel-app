    @forelse($review as $rev)
        <a href="{{route('review.index')}}">
            <div class="media">
                <div class="media-left align-self-center"><i class="ft ft-star icon-bg-circle bg-warning mr-0"></i></div>
                <div class="media-body">
                    <p class="notification-text font-small-3 text-muted">{{$rev->mobile_user->name}}</p><small>
                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">{{$rev->created_at->diffForHumans()}}</time></small>
                </div>
            </div>
        </a>
    @empty
        <a href="{{route('review.index')}}">
            <div class="media">
                <div class="media-left align-self-center"></div>
                <div class="media-body ">
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <img class="center" alt="turbo" src="{{URL::asset('images/nodata.png')}}" style="width:130px;height: 180px">
                    </div>
                </div>
            </div>
        </a>
    @endforelse

