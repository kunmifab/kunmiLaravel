<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="text-center mt-2">
        <h1>All Products</h1>
    </div>
    <br>
    <div class="container">
        <table class="table table-border">


            <thead>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><a href="{{ route('show_product', ['slug'=> $product->slug]) }}">{{$product->name}}</a></td>
                    <td><img src="{{asset('images/'.$product->image_path)}}" alt="{{$product->name}}" width="50px" height="50px"></td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>
                        <a href="{{ route('edit_product', ['id' => $product->id])}}" class="btn border">Edit</a>
                        <button class="btn border" onclick="deleteProduct(this)" data-id="{{ $product->id }}" class="delete-btn" id="product-btn-{{ $product->id }}">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <form action="" method="POST" id="deleteForm">
            @csrf
            @method('DELETE')
        </form>
    <script>

        const deleteProduct = (e) => {
            const isConfirmed = confirm('Are you sure you want to delete this post?');
            if( !isConfirmed ){
                return;
            }else{
                 const id = e.getAttribute('data-id');
                const deleteForm = document.getElementById('deleteForm');

                deleteForm.setAttribute('action', `/products/${id}`);
                deleteForm.submit();
                deleteForm.setAttribute('action', '');
            }
        }

    </script>
</body>
</html>
