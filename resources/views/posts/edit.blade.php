@extends('admin.base')

@section('content')
    <div class="form-group">
        <label>Image</label>
        <input type="file" name="image" class="form-control" id="image">
        <image src="{{$image->url}}" width="20%" />
        <p class="text-danger">
        </p>
    </div>
    <div class="form-group">
        <label>Title</label>
        <input type="text" value="{{$posts->title}}" name="title" class="form-control" id="title" placeholder="Enter title">
        <p class="text-danger">
        </p>
    </div>
    <div class="form-group mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" placeholder="Description" id="description" cols="10"
                  rows="3">{{$posts->description}}</textarea>

    </div>

    <button type="submit" id="btn" class="btn btn-primary">Submit</button>

    @jquery
    @toastr_js
    @toastr_render
@endsection
@section('js')
    <script>
        $(document).ready(function () {


            $("#btn").on("click", function () {


                var formData = new FormData();
                formData.append("_token", _token);
                formData.append("title", $('#title').val());
                formData.append("id",{{$id}});
                formData.append("description", $('#description').val());
                formData.append("image", $("#image")[0].files[0])

                $.ajax({
                    type: "POST",
                    url: "/post-update",
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function (response) {
                        console.log(response);
                        alert("Update")
                        window.location.href = "/posts";

                    },
                    error: function (response) {
                        console.log(response);
                        alert("Error")
                    },
                });


            });


        });
    </script>


@endsection