@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Danh muc quan li </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {!! Form::open(['route' => 'category.store','method' => 'POST']) !!}
                    <div class="form-group">
                        {!! Form::label('title','Title', []) !!}
                        {!! Form::text('title',null, ['class' => 'mb-3 form-control' , 'placeholder' => 'nhap vao du
                        lieu' ,'id' =>'title']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description','Description', []) !!}
                        {!! Form::textarea('description',null, ['class' => 'mb-3 form-control' , 'placeholder' => 'nhap
                        vao du lieu' ,'id' =>'description']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Active','Active', []) !!}
                        {!! Form::select('status', ['1' => 'hien thi' , '0' => 'khong hien thi'], null, ['class' =>
                        'mb-3 form-control']) !!}
                    </div>
                    {!! Form::submit("them du lieu", ['class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>


            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Active\Inactive</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $key => $cate)
                    <tr>
                        <th scope="row">{{$key}}</th>
                        <td>{{$cate -> title}}</td>
                        <td>{{$cate -> description}}</td>
                        <td>
                            @if($cate -> status)
                            Hien thi
                            @else
                            Khong hien thi
                            @endif

                        </td>
                        <td>

                            {!! Form::open(['method' => 'DELETE','route' => ['category.destroy',$cate ->id],'onsubmit'
                            => 'return confirm("Xoa hay khong ?")']) !!}
                            {!! Form::submit("Xoa", ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection