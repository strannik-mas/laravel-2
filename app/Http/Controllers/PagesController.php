<?php

namespace App\Http\Controllers;
//{{--11 урок--}}
use App\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function execute()
    {
        if(view()->exists('admin.pages')){
            $pages = Page::all();
            $data = [
                'title' => 'Страницы',
                'pages' => $pages,
            ];
            return view('admin.pages',$data);
        } else {
            abort(404);
        }
    }
}
