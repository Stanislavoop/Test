@extends('layouts.main')

@section('title', $item->title)

@section('content')
    <?php

    //dd($item->images);
    ?>
    <div class="product">
        @if(is_array($item->images))
            <div class="image"><img src="/images/{{$item->images[0]->img}}" height="140px" width="200px"></div>
        @else
            <div class="image"><img src="" height="140px" width="200px"></div>
        @endif
        <div class="content">
            <div class="name mar-top" data-id="{{$item->id}}">{{$item->title}}</div>
            <div class="cost mar-top">${{$item->cost}}</div>
            @if($item->in_stock)
                <div class="stock mar-top">В наличии</div>
            @else
                <div class="stock mar-top">Нет в наличии</div>
            @endif
            <div class="descr mar-top">{{$item->description}}</div>
        </div>
{{--        <div class="col-md-6">
            <p>Цена: {{ number_format($item->cost, 2, '.', '') }}</p>
            <!--Добавления товара в корзину-->
            <form action="{{ route('basketAdd', ['id' => $item->id]) }}"
                  method="post" class="form-inline">
                @csrf
                <label for="input-quantity">Количество</label>
                <input type="text" name="quantity" id="input-quantity" value="1"
                       class="form-control mx-2 w-25">
                <button type="submit" class="btn btn-success">Добавить в корзину</button>
            </form>
        </div>--}}
        <a class="mar-top cart-button">Add to cart</a>
    </div>

@endsection

@section('custom_js')
    <script>//add to basket
        $(document).ready(function (){
            $(document).on('click', '.cart-button', function (e){
                e.preventDefault();
                addToCart();
            });
            function addToCart(){
                let id = $('.product .name').data('id');
                let count = 1;
                $.ajax({
                    url: "{{route('basketAdd', ['id' => $item->id])}}",
                    type: "POST",
                    data: {
                        id: id,
                        count: count
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (data) => {
                        if(data === "true"){
                            alert('Товар добавлен в корзину');
                        }else{
                            alert('Ошибка');
                        }
                    },
                });
            }
        });
    </script>
@endsection
