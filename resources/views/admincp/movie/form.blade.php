@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quan li phim </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    
                    @if(!isset($movie))
                    {!! Form::open(['route' => 'movie.store','method' => 'POST','enctype' => 'multipart/form-data']) !!}
                    @else
                     {!! Form::open(['route' => ['movie.update',$movie -> id],'method' => 'PUT','enctype' => 'multipart/form-data']) !!}
                    @endif
                    <div class="form-group">
                        {!! Form::label('title','Title', []) !!}
                        {!! Form::text('title',isset($movie) ? $movie -> title : '', ['class' => 'mb-3 form-control' , 'placeholder' => 'nhap vao du lieu' ,'id' =>'slug','onkeyup' =>'ChangeToSlug()']) !!}
                    </div>

                     <div class="form-group">
                        {!! Form::label('slug','Slug', []) !!}
                        {!! Form::text('slug',isset($movie) ? $movie -> slug : '', ['class' => 'mb-3 form-control' , 'placeholder' => 'nhap vao du lieu' ,'id' =>'convert_slug']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('description','Description', []) !!}
                        {!! Form::textarea('description',isset($movie) ? $movie -> description : '', ['class' => 'mb-3 form-control' , 'placeholder' => 'nhap vao du lieu' ,'id' =>'description']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Active','Active', []) !!}
                        {!! Form::select('status', ['1' => 'hien thi' , '0' => 'khong hien thi'],isset($movie) ? $movie -> status : '', ['class' =>
                        'mb-3 form-control']) !!}
                    </div>
                     <div class="form-group">
                        {!! Form::label('Category','Category', []) !!}
                        {!! Form::select('category_id',$category,isset($movie) ? $movie -> category : '', ['class' =>
                        'mb-3 form-control']) !!}
                    </div>
                     <div class="form-group">
                        {!! Form::label('Country','Country', []) !!}
                        {!! Form::select('country_id',$country ,isset($movie) ? $movie -> country : '', ['class' =>
                        'mb-3 form-control']) !!}
                    </div>
                     <div class="form-group">
                        {!! Form::label('Genre','Genre', []) !!}
                        {!! Form::select('genre_id',$genre,isset($movie) ? $movie -> genre : '', ['class' =>
                        'mb-3 form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Image','Image', []) !!}
                        {!! Form::file('image', ['class' =>
                        'mb-3 form-control']) !!}

                        @if($movie) <img width="20%" src="{{ asset('uploads/movie/'.$movie->image) }}"> @endif

                    </div>
                    @if(!isset($movie))
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
                        <th scope="col">Image</th>
                        <th scope="col">Description</th>
                        <th scope="col">Active\Inactive</th>
                        <th scope="col">Category</th>
                        <th scope="col">Country</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $key => $cate)
                    <tr>
                        <th scope="row">{{$key}}</th>
                        <td>{{$cate -> title}}</td>
                         <td>{{$cate -> slug}}</td>
                         <td><image width="100%" src="{{asset('uploads/movie/'.$cate->image)}}"></td>
                        <td>{{$cate -> description}}</td>
                        <td>
                            @if($cate -> status)
                            Hien thi
                            @else
                            Khong hien thi
                            @endif

                        </td>
                        <td>{{$cate->category->title}}</td>
                        <td>{{$cate->country->title}}</td>
                        <td>{{$cate->genre->title}}</td>
                        <td>

                            {!! Form::open(['method' => 'DELETE','route' => ['movie.destroy',$cate ->id],'onsubmit'
                            => 'return confirm("Xoa hay khong ?")']) !!}
                            {!! Form::submit("Xoa", ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                             <a href="{{route('movie.edit',$cate -> id)}} " class="btn btn-warning">Sua</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection