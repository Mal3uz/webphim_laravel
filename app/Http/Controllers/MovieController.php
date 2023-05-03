<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Movie::with('category','genre','country')->orderBy('id','DESC')->get();
        return view('admincp.movie.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category= Category::pluck('title','id');
        $country= Country::pluck('title','id');
        $genre= Genre::pluck('title','id');
        $movie = null;
       
        return view('admincp.movie.form',compact('category','country','genre','movie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
    $data = $request->all();
    $movie = new Movie();
    $movie->title = $data['title'];
    $movie->name_origin = $data['name_origin'];
    $movie->slug = $data['slug'];
    $movie->phim_hot = $data['phim_hot'];
    $movie->description = $data['description'];
    $movie->status = $data['status'];
    $movie->category_id = $data['category_id'];
    $movie->genre_id = $data['genre_id'];
    $movie->country_id = $data['country_id'];

    // Thêm hình ảnh
    $get_image = $request->file('image');


    if ($get_image) {
        $get_name_image = $get_image->getClientOriginalName(); // hinhanh1.jpg
        $name_image = current(explode('.', $get_name_image)); // [0] => hinhanh1  . [2] =>jpg // current => lay [0] , neu thay la end => lay[1]
        $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension(); // them random vo cuoi de tranh bi trung hinh anh sau do thi no noi thanh hinhanh12534.jpg
        $get_image->move('uploads/movie/', $new_image);
        // File::copy($path.$new_image,$path_gallery.$new_image);//cau lenh de them thu vien anh nhung trong day khong can thiet
        $movie->image = $new_image;
    } else {
        // Nếu không có hình ảnh được tải lên, gán giá trị mặc định cho trường 'image'
        $movie->image = 'default_image.jpg';
    }

    $movie->save();
    return Redirect::back();
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $category= Category::pluck('title','id');
        $country= Country::pluck('title','id');
        $genre= Genre::pluck('title','id');

        $movie = Movie::find($id);
        return view('admincp.movie.form',compact('category','country','genre','movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function update(Request $request, $id)
{
    $data = $request->all();
    $movie = Movie::find($id);
    $movie->title = $data['title'];
    $movie->slug = $data['slug'];
    $movie->phim_hot = $data['phim_hot'];
    $movie->description = $data['description'];
    $movie->status = $data['status'];
    $movie->category_id = $data['category_id'];
    $movie->genre_id = $data['genre_id'];
    $movie->country_id = $data['country_id'];

    // Thêm hình ảnh
    $get_image = $request->file('image');

    if ($get_image) {
         $imagePath = public_path('uploads/movie/') . $movie->image;
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
        $get_name_image = $get_image->getClientOriginalName(); // hinhanh1.jpg
        $name_image = current(explode('.', $get_name_image)); // [0] => hinhanh1  . [2] =>jpg // current => lay [0] , neu thay la end => lay[1]
        $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension(); // them random vo cuoi de tranh bi trung hinh anh sau do thi no noi thanh hinhanh12534.jpg
        $get_image->move(public_path('uploads/movie/'), $new_image);
        $movie->image = $new_image;
    } 

    $movie->save();
    return redirect()->back();
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function destroy($id)
{
    $movie = Movie::find($id);
    if (!$movie) {
        return redirect()->back()->withErrors('Movie not found.');
    }

    $imagePath = public_path('uploads/movie/' . $movie->image);

    $movie->delete();

    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    return redirect()->back();
}



}
