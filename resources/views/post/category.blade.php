<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$category->name}} Category - Posts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="text-center mt-2">
        <h1>All Posts Under The {{$category->name}} Category</h1>
    </div>
    <br>
    <div class="container">

        <table class="table table-border">


            <thead>
                <tr>
                    <th>SN</th>
                    <th>Post Title</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><a href="{{route('post.show', ['post'=> $post->id])}}">{{$post->title}}</a></td>
                    </tr>
                @endforeach


            </tbody>
        </table>

    </div>

</body>
</html>
