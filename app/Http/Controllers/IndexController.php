<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;

class IndexController extends Controller
{
    public function home(){
        $category = Category::orderBy('id','DESC') -> get();
        $genre = Genre::orderBy('id','DESC') -> get();
        $country = Country::orderBy('id','DESC') -> get();
    	return view('pages.home',compact('category','genre','country'));
    }
     public function category($slug){
        $category = Category::orderBy('id','DESC') -> get();
        $genre = Genre::orderBy('id','DESC') -> get();
        $country = Country::orderBy('id','DESC') -> get();
    	return view('pages.category',compact('category','genre','country'));
    }
     public function genre($slug){
        $category = Category::orderBy('id','DESC') -> get();
        $genre = Genre::orderBy('id','DESC') -> get();
        $country = Country::orderBy('id','DESC') -> get();
    	return view('pages.genre',compact('category','genre','country'));
    }
     public function country($slug){
        $category = Category::orderBy('id','DESC') -> get();
        $genre = Genre::orderBy('id','DESC') -> get();
        $country = Country::orderBy('id','DESC') -> get();
    	return view('pages.country',compact('category','genre','country'));
    }
     public function movie(){
    	return view('pages.movie');
    }
     public function watch(){
    	return view('pages.watch');
    }
     public function episode(){
    	return view('pages.episode');
    }
}
