<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<header>
    <div class="menu-block">
        <ul class="menu">
            @foreach($categories as $cat)
            <li class="cat_menu_item"><a href="{{route('showCategory', $cat->code)}}">{{$cat->title}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="basket"><a href="{{route('cartBasket')}}"><span>Cart</span> (0)</a></div>
</header>
@yield('content')
<footer></footer>
@yield('custom_js')
</html>
