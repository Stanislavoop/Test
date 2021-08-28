@extends('layouts.main')

@section('title', 'Корзина')

@section('content')
    <h1>Ваша корзина</h1>
    @if (count($products))
        @php
            $basketCost = 0;
        @endphp
        <table class="table table-bordered">
            <tr>
                <th>№</th>
                <th>Наименование</th>
                <th>Цена</th>
                <th>Кол-во</th>
                <th>Стоимость</th>
            </tr>
            @foreach($products as $product)
                @php
                    $itemPrice = $product->cost;
                    $itemQuantity =  $product->pivot->quantity;
                    $itemCost = $itemPrice * $itemQuantity;
                    $basketCost = $basketCost + $itemCost;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('getProduct', [$product->catCode, $product->id]) }}">{{ $product->title }}</a>
                    </td>
                    <td>{{ number_format($itemPrice, 1, '.', '') }}</td>
                    <td>
                        <i class="fas fa-minus-square"></i>
                        <span class="mx-1">{{ $itemQuantity }}</span>
                        <i class="fas fa-plus-square"></i>
                    </td>
                    <td>{{ number_format($itemCost, 1, '.', '') }}</td>
                </tr>
            @endforeach
            <tr>
                <th colspan="4" class="text-right">Итого</th>
                <th>{{ number_format($basketCost, 1, '.', '') }}</th>
            </tr>
        </table>
        @if($text)
            <p>{{$text}}</p>
        @endif
    @else
        <p>Ваша корзина пуста</p>
    @endif
@endsection
