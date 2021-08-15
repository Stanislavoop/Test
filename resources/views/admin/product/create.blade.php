@extends('layouts.admin_lay')

@section('title', 'Создать товар')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить категорию</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    <h4><i class="icon fa fa-check"></i>{{session('success')}}</h4>
                </div>
            @endif
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <!-- form start -->
                        <form action="{{route('productAdmin.store')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Название</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Ввести название" required>
                                </div>
                                <div class="form-group">
                                    <label for="cost">Стоимость</label>
                                    <input type="number" class="form-control" name="cost" id="cost" placeholder="Ввести стоимость" required>
                                </div>
                                <div class="form-group">
                                    <label for="stock">В наличии</label>
                                    <input type="text" class="form-control" name="stock" id="stock" placeholder="Ввести наличие">
                                </div>
                                <div class="form-group">
                                    <label for="description">Описание товара</label>
                                    <input type="text" class="form-control" name="description" id="description" placeholder="Ввести описание товара" required>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
