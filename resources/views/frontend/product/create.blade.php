@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('product.index') }}" class="btn btn-success">Back</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Create Product</h2>
        </div>
        <div class="card-body">
            @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            @endif

            <form method="post" action="{{ route('frontend.product.save') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="productName" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="productName" name="productName" required>
                </div>

                <div class="mb-3">
                    <label for="productDescription" class="form-label">Product Description</label>
                    <textarea class="form-control" id="productDescription" name="productDescription" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="productCode" class="form-label">Product Code</label>
                    <input type="text" class="form-control" id="productCode" name="productCode" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" class="form-control" id="price" name="price" required>
                </div>

                <div class="mb-3">
                    <label for="productImage" class="form-label">Product Image</label>
                    <input type="file" class="form-control" id="productImage" name="productImage" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
