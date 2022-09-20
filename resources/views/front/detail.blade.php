@extends('front.layout.master')

@section('content')
<div class="main-content-wrapper section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <!-- ============= Post Content Area ============= -->
                <div class="col-12 col-lg-8">
                        <div class="single-blog-content mb-100">
                            <!-- Post Meta -->
                            <div class="post-meta">
                                <p><a href="#" class="post-author">{{$data->user_name}}</a> on <a href="#" class="post-date">{{$data->created_at}}</a></p>
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <h2>{{$data->name}}</h2>
                                <h6>{!!$data->description!!}</h6>
                                <div class="post-meta second-part">
                                    <p><a href="#" class="post-author">{{$data->user_name}}</a> on <a href="#" class="post-date">{{$data->created_at}}</a></p>
                                </div>
                            </div>
                    </div>
                </div>

                <!-- ========== Sidebar Area ========== -->
                <div class="col-12 col-md-8 col-lg-4">
                    <div class="post-sidebar-area mb-100">
                        <!-- Widget Area -->
                        <div class="sidebar-widget-area">
                            <h5 class="title">About World</h5>
                            <div class="widget-content">
                                <p>The mango is perfect in that it is always yellow and if it’s not, I don’t want to hear about it. The mango’s only flaw, and it’s a minor one, is the effort it sometimes takes to undress the mango, carve it up in a way that makes sense, and find its way to the mouth.</p>
                            </div>
                        </div>
                        <!-- Widget Area -->
                        <div class="sidebar-widget-area">
                            <h5 class="title">Top Stories</h5>
                            <div class="widget-content">
                                <!-- Single Blog Post -->
                                <div class="single-blog-post post-style-2 d-flex align-items-center widget-post">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <img src="{{asset('/img/blog-img/b11.jpg')}}" alt="">
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <a href="#" class="headline">
                                            <h5 class="mb-0">How Did van Gogh’s Turbulent Mind Depict One of the Most</h5>
                                        </a>
                                    </div>
                                </div>
                                <!-- Single Blog Post -->
                                <div class="single-blog-post post-style-2 d-flex align-items-center widget-post">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <img src="{{asset('/img/blog-img/b13.jpg')}}" alt="">
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <a href="#" class="headline">
                                            <h5 class="mb-0">How Did van Gogh’s Turbulent Mind Depict One of the Most</h5>
                                        </a>
                                    </div>
                                </div>
                                <!-- Single Blog Post -->
                                <div class="single-blog-post post-style-2 d-flex align-items-center widget-post">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <img src="{{asset('/img/blog-img/b14.jpg')}}" alt="">
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <a href="#" class="headline">
                                            <h5 class="mb-0">How Did van Gogh’s Turbulent Mind Depict One of the Most</h5>
                                        </a>
                                    </div>
                                </div>
                                <!-- Single Blog Post -->
                                <div class="single-blog-post post-style-2 d-flex align-items-center widget-post">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <img src="{{asset('/img/blog-img/b10.jpg')}}" alt="">
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <a href="#" class="headline">
                                            <h5 class="mb-0">How Did van Gogh’s Turbulent Mind Depict One of the Most</h5>
                                        </a>
                                    </div>
                                </div>
                                <!-- Single Blog Post -->
                                <div class="single-blog-post post-style-2 d-flex align-items-center widget-post">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <img src="{{asset('/img/blog-img/b12.jpg')}}" alt="">
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <a href="#" class="headline">
                                            <h5 class="mb-0">How Did van Gogh’s Turbulent Mind Depict One of the Most</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Widget Area -->
                        <div class="sidebar-widget-area">
                            <h5 class="title">Stay Connected</h5>
                            <div class="widget-content">
                                <div class="social-area d-flex justify-content-between">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-vimeo"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-google"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- Widget Area -->
                        <div class="sidebar-widget-area">
                            <h5 class="title">Today’s Pick</h5>
                            <div class="widget-content">
                                <!-- Single Blog Post -->
                                <div class="single-blog-post todays-pick">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <img src="{{asset('/img/blog-img/b22.jpg')}}" alt="">
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content px-0 pb-0">
                                        <a href="#" class="headline">
                                            <h5>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============== Related Post ============== -->
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Single Blog Post -->
                    <div class="single-blog-post">
                        <!-- Post Thumbnail -->
                        <div class="post-thumbnail">
                            <img src="{{asset('/img/blog-img/b1.jpg')}}" alt="">
                            <!-- Catagory -->
                            <div class="post-cta"><a href="#">travel</a></div>
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">
                            <a href="#" class="headline">
                                <h5>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</h5>
                            </a>
                            <p>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in...</p>
                            <!-- Post Meta -->
                            <div class="post-meta">
                                <p><a href="#" class="post-author">Katy Liu</a> on <a href="#" class="post-date">Sep 29, 2017 at 9:48 am</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Single Blog Post -->
                    <div class="single-blog-post">
                        <!-- Post Thumbnail -->
                        <div class="post-thumbnail">
                            <img src="{{asset('/img/blog-img/b2.jpg')}}" alt="">
                            <!-- Catagory -->
                            <div class="post-cta"><a href="#">travel</a></div>
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">
                            <a href="#" class="headline">
                                <h5>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</h5>
                            </a>
                            <p>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in...</p>
                            <!-- Post Meta -->
                            <div class="post-meta">
                                <p><a href="#" class="post-author">Katy Liu</a> on <a href="#" class="post-date">Sep 29, 2017 at 9:48 am</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Single Blog Post -->
                    <div class="single-blog-post">
                        <!-- Post Thumbnail -->
                        <div class="post-thumbnail">
                            <img src="{{asset('/img/blog-img/b7.jpg')}}" alt="">
                            <!-- Catagory -->
                            <div class="post-cta"><a href="#">travel</a></div>
                            <!-- Video Button -->
                            <a href="https://www.youtube.com/watch?v=IhnqEwFSJRg" class="video-btn"><i class="fa fa-play"></i></a>
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">
                            <a href="#" class="headline">
                                <h5>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</h5>
                            </a>
                            <p>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in...</p>
                            <!-- Post Meta -->
                            <div class="post-meta">
                                <p><a href="#" class="post-author">Katy Liu</a> on <a href="#" class="post-date">Sep 29, 2017 at 9:48 am</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="post-a-comment-area mt-70">
                        @if(Auth::check())
                        <h5>Get in Touch</h5>
                        <!-- Contact Form -->
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group">
                                        <textarea name="content" id="message" required></textarea>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Enter your comment</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" onclick="reloadPage();" id="btn-comment" class="btn world-btn">Post comment</button>
                                </div>
                            </div>
                        </form>
                        @else
                            <a href="/login"><button type="button"  class="btn btn-danger" data-toggle="modal">Vui lòng đăng nhập để comment</button><a>
                        @endif
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <!-- Comment Area Start -->
                    <div class="comment_area clearfix mt-70">
                   
                       @include('front.component.comment',['comments'=>$data->comments])
                    
                    </div>
                </div>
            

        </div>
    </div>
</div>
<script>
var _csrf = '{{csrf_token()}}';
let _commentUrl = '{{route("comment", $data->id)}}';
    $('#btn-comment').click(function(ev){
        ev.preventDefault();
        let content = $('#message').val();
       
        $.ajax({
        url: _commentUrl,
        type:'POST',
        data: {
            content: content,
            _token: _csrf
        },
        success: function(res){
            if(res.error){
                $('#comment-error').html(res.error);
            }else{
                $('#comment-error').html('');
                $('#message').val('');
                $('#comment').html(res);
            }
        }
        }); 
    });
    function reloadPage(){
        location.reload(true);
    }
$(document).on('click','.comment-reply',function(ev){
    ev.preventDefault()
    var id = $(this).data('id');
    var comment_reply_id = '#content-reply-'+id;
    var form_reply = '.form-reply-'+id;
    var contentReply = $(comment_reply_id).val();
    $('.formReply').slideUp();
    $(form_reply).slideDown();
});
$(document).on('click','.btn-send-comment-reply',function(ev){
    ev.preventDefault()
    var id = $(this).data('id');
    var comment_reply_id = '#content-reply-'+id;
    var contentReply = $(comment_reply_id).val();
    var form_reply = '.form-reply-'+id;

    $.ajax({
        url: _commentUrl,
        type:'POST',
        data: {
            content: contentReply,
            parent_id:id,
            _token: _csrf
        },
        success: function(res){
            if(res.error){
                $('#comment-error').html(res.error);
            }else{
                $('#comment-error').html('');
                $('#message').val('');
                $('#comment').html(res);
            }
        }
        }); 
});

$(document).on('click', '.delete-form', function(){
    if(confirm('Xóa comment ?'))
    {
        var thisClicked = $(this);
        var comment_id = thisClicked.val();
        $.ajax({
            type: "POST",
            url: "/delete-comment",
            data:{
                'comment_id':comment_id,
                _token: _csrf
            },
            success: function(res){
                if(res.status == 200){
                    thisClicked.closest('.comment-content').remove();
                }else{
                    alert(res.message);
                }
            }
        });
    }
});
</script>
@endsection