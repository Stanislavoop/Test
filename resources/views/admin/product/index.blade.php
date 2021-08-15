@extends('layouts.admin_lay')

@section('title', 'Все товары')

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
                                Название
                            </th>
                            <th style="width: 50%">
                                Описание
                            </th>
                            <th>
                                В наличии
                            </th>
                            <th style="width: 8%" class="text-center">
                                Стоимость
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>
                                {{$product->id}}
                            </td>
                            <td>
                                <a>
                                    {{$product->title}}
                                </a>
                                <br/>
                                <small>
                                    {{$product->created_at}}
                                </small>
                            </td>
                            <td>
                                {{$product->description}}
                            </td>
                            <td class="project_progress">
                                {{$product->in_stock}}
                            </td>
                            <td class="project-state">
                                {{$product->cost}}
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
