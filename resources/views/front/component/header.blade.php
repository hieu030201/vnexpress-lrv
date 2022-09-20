<header class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg">
                        <!-- Logo -->
                        <a class="navbar-brand" href="index.html"><img src="img/core-img/logo.png" alt="Logo"></a>
                        <!-- Navbar Toggler -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#worldNav" aria-controls="worldNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <!-- Navbar -->
                        <div class="collapse navbar-collapse" id="worldNav">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="index.html">Home</a>
                                        <a class="dropdown-item" href="catagory.html">Catagory</a>
                                        <a class="dropdown-item" href="single-blog.html">Single Blog</a>
                                        <a class="dropdown-item" href="regular-page.html">Regular Page</a>
                                        <a class="dropdown-item" href="contact.html">Contact</a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Gadgets</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Lifestyle</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Video</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Contact</a>
                                </li>
                            </ul>
                            <!-- Search Form  -->
                            <div id="search-wrapper">
                                <form action="#">
                                    <input type="text" name="search-input" class="input-search-ajax" id="search" placeholder="Search something..." style="color: black;">
                                    <div id="close-icon"></div>
                                    <input class="d-none" type="submit" value="" >
                                    <div class="search-ajax-result" style="position:absolute; padding-top:20px;background-color:aliceblue;">
                                     
                                    </div>
                                
                                </form>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
</header>
<script>
    $(document).ready(function(){
        var _csrf = '{{csrf_token()}}';
        $('.input-search-ajax').keyup(function(){
            let query = $(this).val();
            if(query != '')
            {
                $.ajax({
                    url: "{{route('search-post')}}",
                    type:"POST",
                    data: {
                        query: query,
                        _token: _csrf,
                    },
                    success: function(data){
                        $('.search-ajax-result').fadeIn();
                        $('.search-ajax-result').html(data);
                    }
                });
            }else{
                $('.search-ajax-result').html('');
                $('.search-ajax-result').hide();
            }
        });  
    });
</script>