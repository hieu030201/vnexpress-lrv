@foreach($comments as $comment)
    <div class="comment-content">
        <!-- Comment Meta -->
        <div class="comment-meta d-flex align-items-center justify-content-between">
            <p><a href="#" class="post-author">{{$comment->user_name}}</a> on <a href="#" class="post-date">{{$comment->created_at}}</a></p>
            @if(Auth::check())
            <a href="#" class="comment-reply btn world-btn">Trả lời</a>
            @else
                <a href="/login"><button type="button" class="btn btn-danger" data-toggle="modal">Vui lòng đăng nhập để comment</button><a>
            @endif
        </div>
        <p>{{$comment->content}}</p>
    </div>
@endforeach