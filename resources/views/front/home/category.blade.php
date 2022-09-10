<div class="world-catagory-area">
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="title">Don’t Miss</li>

    @foreach($categories as $category)
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" role="tab" aria-controls="world-tab-1" aria-selected="true" data-id="{{$category->id}}">{{$category->name}}</a>
    </li>
    @endforeach

    <div class="tab-content" id="myTabContent">

    <div id="list-post" class="tab-pane fade show active" id="world-tab-10" role="tabpanel" aria-labelledby="tab10">
        <div class="row">
            <div class="col-12 col-md-6">

            </div>
        </div>
    </div>
</ul>
</div>
<script>
$(document).ready(function(){
    $(".nav-link").click(function(){
        $.get("/getPostByCategory/"+$(this).data("id"),function(data){
            $("#list-post").html(data);
        })
    });
});
</script>



