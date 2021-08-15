@extends('layouts.main')

@section('title', $cat->title)

@section('content')
    <body>
    <h1>{{$cat->title}}</h1>
    <img src="/images/{{$cat->img}}" alt="" width="900px" height="600px">
    <p>Showing {{$cat->products->count()}} results</p>
    <ul class="sort_check">
        <li class="sort" data-order="def">Default</li>
        <li class="sort" data-order="price-low">Price Low-Hight</li>
        <li class="sort" data-order="price-hight">Price Hight-Low</li>
        <li class="sort" data-order="nameAZ">Name A-Z</li>
        <li class="sort" data-order="nameZA">Name Z-A</li>
    </ul>
    <div class="products">
        <div class="container">
            @foreach($products as $product)
                <?php
                // Выбираем первую картику товара, если нет то no.png
                $image = '';
                if(count($product->images) > 0){
                    $image = $product->images[0]['img'];
                }else{
                    $image = 'no.png';
                }
                ?>
                <div class="product">
                    <a href="{{route('showCategory', $product->category['code'])}}">category -> {{$product->category['title']}}</a>
                    <div class="image"><img src="/images/{{$image}}" height="140px" width="200px"></div>
                    <div class="content">
                        <div class="name"><a href="{{route('getProduct', [$product->category['code'], $product->id])}}">{{$product->title}}</a></div>
                        <div class="cost">${{$product->cost}}</div>
                    </div>
                </div>
            @endforeach
        </div>
        <h3>PAGINATION:</h3>
        {{$products->appends(request()->query())->links('pagination.index')}}
    </div>
    </body>
@endsection

@section('custom_js')
    <script>
        $(document).ready(function (){
            $('.sort').on('click', function (){
                let order = $(this).data('order');

                $.ajax({
                    url: "{{route('showCategory', $cat->code)}}",
                    type: "GET",
                    data: {
                        order: order,
                        pdge: {{isset($_GET['page']) ? $_GET['page'] : 1}}
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (data) => {
                        let posParam = location.pathname.indexOf('?');
                        let url = location.pathname.substring(posParam, location.pathname.length);
                        let newUrl = url + '?';
                        newUrl += 'orderBy=' + order + '&page={{isset($_GET['page']) ? $_GET['page'] : 1}}';
                        history.pushState({}, '', newUrl);

                        $('.products .container').html(data);
                    },
                });
            });
        });
    </script>
@endsection
