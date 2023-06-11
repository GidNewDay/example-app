@extends('layouts.app')

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('assets/images/bg_6.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Home</a></span> <span>Cart</span></p>
                    <h1 class="mb-0 bread">My Cart</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $subtotal = 0 @endphp
                            @if(session('cart'))
                            @foreach((array) session('cart') as $id => $item)
                                @php $subtotal += $item['price'] * $item['quantity'] @endphp
                                <tr class="text-center" data-id="{{$id}}">
                                    <td class="product-remove">
                                        <a class="product_remove" href="#"><span class="ion-ios-close"></span></a>
                                    </td>

                                    <td class="image-prod">
                                        <div class="img" style="background-image:url({{ $item['image'] }});"></div>
                                    </td>

                                    <td class="product-name">
                                        <h3>{{$item['product_name']}}</h3>
                                        <p>{{$item['description']}}</p>
                                    </td>

                                    <td class="price">${{$item['price']}}</td>

                                    <td class="quantity">
                                        <div class="input-group mb-3">
                                            <input type="number" name="quantity" class="quantity1 form-control input-number cart_update"
                                                   value="{{$item['quantity']}}" data-price="{{$item['price']}}" data-quantity-id="{{$id}}" min="1" max="100">
                                        </div>
                                    </td>

                                    <td class="total">
                                        $<span class="data-id-{{$id}}">
                                            {{$item['price'] * $item['quantity']}}
                                        </span>
                                    </td>
                                </tr><!-- END TR-->
                            @endforeach
                            @endif
                            @php
                                $discount = 3;
                                $total = $subtotal - $discount;
                            @endphp
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Cart Totals</h3>
                        <p class="d-flex">
                            <span>Subtotal</span>
                            <span>${{$subtotal}}</span>
                        </p>
                        <p class="d-flex">
                            <span>Delivery</span>
                            <span>$0.00</span>
                        </p>
                        <p class="d-flex">
                            <span>Discount</span>
                            <span>${{$discount}}</span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span class="summa">${{$total}}</span>
                        </p>
                    </div>
                    <p class="text-center"><a href="/checkout" class="btn btn-primary py-3 px-4">Proceed to Checkout</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $('.cart_update').change(function (e){
            e.preventDefault();

            let ele = $(this);
            $.ajax({
                url: "{{ route('update_cart') }}",
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id"),
                    quantity: ele.parents("tr").find(".quantity1").val()
                },
                success: function (response) {
                    window.location.reload();
                }
            })
        })

        $(".product_remove").on("click",function (e) {
            e.preventDefault();

            let ele = $(this);
            if (confirm("Вы действительно хотите удалить этот товар из корзины?")) {
                $.ajax({
                    url: "{{ route('remove_from_cart') }}",
                    method: "DELETE",
                    data: {
                        _token: '{{csrf_token()}}',
                        id: ele.parents("tr").attr("data-id")
                    },
                    success: function (response){
                        window.location.reload();
                    }
                })
            }
        })
    </script>
@endsection
