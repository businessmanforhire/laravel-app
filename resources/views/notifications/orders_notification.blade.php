@if(count($orders)>0)
    @forelse($orders as $order)
        <a href="{{route('orders.index')}}">
            <div class="media">
                <div class="media-left align-self-center"><i class="ft ft-list icon-bg-circle bg-cyan mr-0"></i></div>
                <div class="media-body">
                    <h6 class="media-heading">You have new order!</h6>
                    <p class="notification-text font-small-3 text-muted">{{$order->mobile_users->name}}</p><small>
                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">{{$order->created_at->diffForHumans()}}</time></small>
                </div>
            </div>
        </a>
    @empty
    @endforelse
@endif