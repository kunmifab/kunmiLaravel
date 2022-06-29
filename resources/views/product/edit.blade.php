<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Product - {{$product->name}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-1">
        <h2 class="text-center">Edit Database For {{$product->name}}</h2>
        <form action="{{ route('update_product', ['id'=>$product->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="name">Name:</label>
                <input name="name" id="name" type="text" class="form-control" value="{{$product->name}}">
            </div>
            @error('name')
            <span style="color: red">{{ $message }}
            @enderror
            <div class="form-group">
                <label for="price">Price:</label>
                <input name="price" id="price" type="text" class="form-control" value="{{$product->price}}">
            </div>
            @error('price')
            <span style="color: red">{{ $message }}
            @enderror
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{$product->description}}</textarea>
            </div>
            @error('description')
            <span style="color: red">{{ $message }}
            @enderror
            <div class="form-group">
                <label for="image">Image:</label>
                <input name="image" id="image" type="file"  class="form-control" accept="image.jpg,image.jpeg,image.png">
            </div>
            @error('image')
            <span style="color: red">{{ $message }}
            @enderror
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input name="quantity" id="quantity" type="text" class="form-control" value="{{$product->quantity}}">
            </div>
            @error('quantity')
            <span style="color: red">{{ $message }}
            @enderror
            <div>
                <button>Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
