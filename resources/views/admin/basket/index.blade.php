@extends('layouts.admin_lay')

@section('title', 'Корзины пользователей')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Все товары</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="card">

                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th style="width: 1%">
                                ID
                            </th>
                            <th style="width: 20%">
                                ID пользователя
                            </th>
                            <th style="width: 50%">
                                Список товаров
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($baskets as $basket)
                            <tr>
                                <td>
                                    {{$basket->id}}
                                </td>
                                <td>
                                    @if($basket->user_id)
                                        {{$basket->user_id}}
                                    @else
                                        Неавторизованный пользователь
                                    @endif
                                </td>
                                <td>
                                    <ul>
                                        @foreach($basket->products as $prod)
                                            <li>
                                            Название: {{$prod->title}}
                                            Стоимость: {{$prod->cost}}
                                            Колличество в корзине: {{$prod->pivot->quantity}}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

