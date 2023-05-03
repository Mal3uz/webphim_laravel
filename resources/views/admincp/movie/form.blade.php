@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <a href="{{route('movie.index')}}" class="btn btn-primary">Liệt Kê Phim</a>
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
                        {!! Form::label('Tên gốc','Tên gốc', []) !!}
                        {!! Form::text('name_origin',isset($movie) ? $movie -> name_origin : '', ['class' => 'mb-3 form-control' , 'placeholder' => 'nhap vao du lieu' ]) !!}
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
                        {!! Form::label('Hot','Hot', []) !!}
                        {!! Form::select('phim_hot',['1' => 'Co' , '0' => 'Khong'],isset($movie) ? $movie -> phim_hot : '', ['class' =>
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


        </div>
    </div>
</div>
@endsection