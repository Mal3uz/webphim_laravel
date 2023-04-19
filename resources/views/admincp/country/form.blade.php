@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Danh muc quoc gia </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    
                    @if(!isset($country))
                    {!! Form::open(['route' => 'country.store','method' => 'POST']) !!}
                    @else
                     {!! Form::open(['route' => ['country.update',$country -> id],'method' => 'PUT']) !!}
                    @endif
                    <div class="form-group">
                        {!! Form::label('title','Title', []) !!}
                        {!! Form::text('title',isset($country) ? $country -> title : '', ['class' => 'mb-3 form-control' , 'placeholder' => 'nhap vao du lieu' ,'id' =>'slug','onkeyup' =>'ChangeToSlug()']) !!}
                    </div>

                     <div class="form-group">
                        {!! Form::label('slug','Slug', []) !!}
                        {!! Form::text('slug',isset($country) ? $country -> slug : '', ['class' => 'mb-3 form-control' , 'placeholder' => 'nhap vao du lieu' ,'id' =>'convert_slug']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('description','Description', []) !!}
                        {!! Form::textarea('description',isset($country) ? $country -> description : '', ['class' => 'mb-3 form-control' , 'placeholder' => 'nhap vao du lieu' ,'id' =>'description']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Active','Active', []) !!}
                        {!! Form::select('status', ['1' => 'hien thi' , '0' => 'khong hien thi'],isset($country) ? $country -> status : '', ['class' =>
                        'mb-3 form-control']) !!}
                    </div>
                    @if(!isset($country))
                    {!! Form::submit("them du lieu", ['class' => 'btn btn-success']) !!}
                    @else
                    {!! Form::submit("cap nhat", ['class' => 'btn btn-success']) !!}
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>


            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
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
                         <td>{{$cate -> slug}}</td>
                        <td>{{$cate -> description}}</td>
                        <td>
                            @if($cate -> status)
                            Hien thi
                            @else
                            Khong hien thi
                            @endif

                        </td>
                        <td>

                            {!! Form::open(['method' => 'DELETE','route' => ['country.destroy',$cate ->id],'onsubmit'
                            => 'return confirm("Xoa hay khong ?")']) !!}
                            {!! Form::submit("Xoa", ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                             <a href="{{route('country.edit',$cate -> id)}} " class="btn btn-warning">Sua</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection