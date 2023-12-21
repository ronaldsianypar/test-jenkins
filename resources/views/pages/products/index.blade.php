<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Product List</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        <style>
            .product-image{
                height: 50%;
                object-fit: cover;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Product List</h1>

            <div class="row">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($products['products'] as $key)
                        <div class="col">
                            <div class="card h-100">
                                <img src="{{ $key['thumbnail'] }}" class="card-img-top product-image" alt="Image {{ $key['title'] }}">
                                <div class="card-body">
                                    <hr>
                                    <h5 class="card-title">{{ $loop->iteration }}. {{ $key['title'] }}</h5>
                                    <p class="card-text">{{ $key['description'] }}</p>
                                    <p class="card-text">Price: ${{ $key['price'] }}</p>
                                    <p class="card-text">Discount: {{ $key['discountPercentage'] }}%</p>
                                    <p class="card-text">Rating: {{ $key['rating'] }}</p>
                                    <p class="card-text">Stock: {{ $key['stock'] }}</p>
                                    <p class="card-text">Brand: {{ $key['brand'] }}</p>
                                    <p class="card-text">Category: {{ $key['category'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>