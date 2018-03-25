<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Validator;

class PagesAddController extends Controller
{

    public function execute(Request $request)
    {
        //12 урок
        if($request->isMethod('post')){
            $input = $request->except('_token');

            $messages = [
                'required' => 'Поле :attribute обязательно к заполнению',
                'unique' => 'Поле :attribute должно быть уникальным'
            ];

            $validator = Validator::make($input, [
                'name' => 'required|max:100',
                'alias' => 'required|unique:pages|max:255',
                'text' => 'required'
            ], $messages);
            if($validator->fails()){
                return redirect()->route('pagesAdd')->withErrors($validator)->withInput();
            }

            //сохранение изображения в папку
            if($request->hasFile('images')){
                $file = $request->file('images');

                $input['images'] = $file->getClientOriginalName();
                $file->move(public_path().'/img', $file->getClientOriginalName());
            }

            $page = new Page();

//            $page->unguard();
            $page->fill($input);

            if($page->save()){
                return redirect('admin')->with('status', 'Страница добавлена');
            }
//            dd($input);
        }

        //11 урок
        if(view()->exists('admin.pages_add')){
            $data = [
                'title' => 'Новая страница'
            ];
            return view('admin.pages_add',$data);
        }else {
            abort(404);
        }
    }
}
