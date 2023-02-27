@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="aiz-titlebar mt-2 mb-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{ translate('Products') }}</h1>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header row gutters-5 align-right">
            <div class="w-100 input-group input-group-sm d-flex align-items-center justify-content-between">
                <h5 class="mb-md-0 h6 pr-5">{{ translate('All Products') }}</h5>
                <a class="btn btn-primary d-flex justify-content-center align-items-center mr-2 p-0" style="width: 167px; height: 42px;" href="{{ route('seller.products.bulk') }}">Create a Bulk Order </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <label for="product">Choose Product</label>
            </div>
            <div class="w-100 d-flex justify-content-between">
                <select name="products-val" id="products-select" class="form-control" style="max-width: 350px;">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}"> {{ $product->name }} </option>
                    @endforeach
                </select>

                <a href="/seller/product/{{ $products[0]->id }}/cart" id="order-product-btn" style="width: 167px; height: 42px;" class="btn btn-info d-flex justify-content-center align-items-center p-0">Place the Order</a>
            </div>

            <div class="d-flex align-items-start mt-4" style="max-width: 750px;">
                <div>
                    <img src="{{ static_asset('products/images/') . '/' . $products[0]->thumbnail_img }}" id="main_img" width="235px" height="200px" class="" />
                </div>
                <div class="pr-2 pl-2 pb-2 pt-0">
                    <p class="font-weight-bold" name="product_name" id="product_name">{{ $products[0]->name }}</p>
                    <p class="font-weight-bold">Description</p>
                    <p class="font-weight-lighter" id="shade_desc">{{ strip_tags($products[0]->description) }}</p>
                    <p class="font-weight-bold">Category</p>
                    <p class="font-weight-lighter" id="shade_category">
                        @if ($products[0]->category_id != null)
                            {{ $products[0]->category->parentCategory->name }} -- {{ $products[0]->category->name }}
                        @endif
                    </p>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">
        const products = @json($products);
        const static_asses_prefix = `{{ static_asset('products/images/') }}`;

        $(document).ready(function() {
            let id = $("#products-select").val();
            $("#order-product-btn").attr("href", `/seller/product/${id}/cart`);
        })

        $("#products-select").change(function() {
            let id = $(this).val();
            const product = products.find(v => {
                return v.id == id;
            });

            if (product) {
                $("#product_name").text(product.name);
                $("#shade_desc").text(product.desc);
                $("#main_img").attr("src", `${static_asses_prefix}/${product.thumbnail_img}`);
                $("#shade_category").text(`${product.category.parentCategory.name} -- ${product.category.name}`);
            }

            $("#order-product-btn").attr("href", `/seller/product/${product.id}/cart`);

        });
    </script>
@endsection
