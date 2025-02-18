@extends("layouts.app")

@section("content")
<div class="container">

    @if(Session::has("success"))
    <div class="alert alert-success">
        {{ Session::get("success") }}
    </div>
    @endif

    <form method="post" action="{{ route("product.index") }}" enctype="multipart/form-data">
    @csrf

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('frontend.product.create') }}" class="btn btn-success">Create</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">SN</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Description</th>
                    <th scope="col">Product Code</th>
                    <th scope="col">Price</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Creator Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $i = 0;
                @endphp

                @foreach ($products as $product)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->product_code }}</td>
                    <td>{{ $product->price }}</td>
                    <td><img src="{{ asset($product->image) }}" width="80"></td>


                    <td>{{ $product->user ? $product->user->name : $creatorName }}</td>
                    <td>
                        <a href="{{ route('frontend.product.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('frontend.product.delete', $product->id) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>
@endsection
