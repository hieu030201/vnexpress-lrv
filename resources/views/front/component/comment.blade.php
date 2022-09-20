@foreach($comments as $comment)
@if($comment->parent_id == 0)

    <div class="comment-content">
        <!-- Comment Meta -->
        <div class="comment-meta d-flex align-items-center justify-content-between">
            <p><a href="#" class="post-author">{{$comment->user_name}}</a> on <a href="#" class="post-date">{{$comment->created_at}}</a></p>
            @if(Auth::check())
            <a href="#" class="comment-reply btn world-btn" data-id="{{$comment->id}}">Trả lời</a>
            @else
                <a href="/login"><button type="button" class="btn btn-danger" data-toggle="modal">Vui lòng đăng nhập để comment</button><a>
            @endif
        </div>
        <p>{{$comment->content}}</p>
        <form action="" method="POST" style="display:none" class="formReply form-reply-{{$comment->id}}">
            <div class="form-group">
                <label for="">Nội dung bình luận</label>
                <textarea id="content-reply-{{$comment->id}}" class="form-control" rows="3" required="required" placeholder="Nhập nội dung"></textarea>
            </div>
            <button type="submit" onclick="reloadPage();" data-id="{{$comment->id}}" class="btn btn-primary btn-send-comment-reply">Trả lời</button>
        </form>
        @if(Auth::check() && Auth::id() == $comment->user_id)
            <button type="button" value="{{$comment->id}}" class="delete-form btn world-btn">Delete</button>
        @endif
    </div>
@endif
    @foreach($comment->comment_child as $child)
    <ol class="children">
    <li class="single_comment_area">
        <!-- Comment Content -->
        <div class="comment-content">
            <!-- Comment Meta -->
            <div class="comment-meta d-flex align-items-center justify-content-between">
                <p><a href="#" class="post-author">{{$child->user_name}}</a> on <a href="#" class="post-date">{{$child->created_at}}</a></p>
            </div>
            <p>{{$child->content}}</p>
            @if(Auth::check() && Auth::id() == $child->user_id)
                <button type="button" value="{{$child->id}}" class="delete-form btn world-btn">Delete</button>
            @endif
        </div>
        
    </li>
    </ol>
    @endforeach

@endforeach