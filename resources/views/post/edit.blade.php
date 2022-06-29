<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$post->title}} - Edit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-1">
        <h2 class="text-center">Edit</h2>
        <form action="{{route('post.update', ['post' => $post->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title:</label>
                <input name="title" id="title" type="text" class="form-control" value="{{$post->title}}" >
            </div>
            @error('title')
            <span style="color: red">{{ $message }}
            @enderror

            <div class="form-group">
                <label for="body">Body:</label>
                <textarea name="body" class="form-control" id="body" cols="30" rows="10">{{$post->body}}</textarea>
            </div>
            @error('body')
            <span style="color: red">{{ $message }}
            @enderror

            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" name="category_slug" id="category">
                    @foreach ($categories as $category)

                    <option @if ($category->slug == $post->category->slug)
                        {{'selected'}}
                    @endif value="{{$category->slug}}">{{$category->name}}</option>

                    @endforeach
                </select>
            </div>
            @error('category')
            <span style="color: red">{{ $message }}
            @enderror

            <div class="form-group">
                <label for="tag">Tag:</label>
                <select name="tags[]" id="tag" multiple class="form-control">
                    @foreach ($tags as $tag)

                    <option @if ($post->tags->contains($tag)){{'selected'}} @endif value="{{$tag->id}}">{{$tag->name}}</option>

                    @endforeach
                </select>
            </div>
            @error('category')
            <span style="color: red">{{ $message }}
            @enderror
            <div class="form-group">
                <label for="image">Image:</label>
                <input name="image" id="image" type="file"  class="form-control" accept="image.jpg,image.jpeg,image.png">
            </div>
            @error('image')
            <span style="color: red">{{ $message }}
            @enderror

            <div>
                <button>Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
