@extends('admin.base')


@section('content')
@section('css')




@endsection
<div class="row mb-3 float-right">
    <div class="col-12">
        <a href="{{route('post-add')}}" class="btn btn-outline-success">Add</a>
    </div>
</div>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Image</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $key=>$post)
         <tr id="{{$post->id}}">
            <td>{{$key}}</td>
            <td>{{$post->title}}</td>
             <td>{{$post->description}}</td>
             <td><image src="{{$post->url}}" width="20%" /></td>
            <td>
                <a href="" class="btn btn-outline-success">Show</a>
                <a href="post-edit/{{$post->id}}" class="btn btn-outline-primary">Edit</a>
                <button class="btn btn-outline-danger btn_del" >DELETE</button>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>



@section('js')
    <script>
        $(".btn_del").on("click", function () {
            var id = $(this).parents().eq(1).attr("id");
            var _this = $(this);

            $.ajax({
                type: "POST",
                url: "/post-delete",
                data : {
                    id: id,
                    _token: _token,
                },
                success: function (response) {
                    _this.parents().eq(1).remove();
                },
                error: function (response) {
                    console.log(response);
                    alert("Error")
                },


            });


        })


    </script>



@endsection

@endsection