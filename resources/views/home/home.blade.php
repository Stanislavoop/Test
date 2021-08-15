@extends('layouts.main')

@section('title', 'Home')

@section('content')
<body>
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
    </div>
</body>
@endsection
