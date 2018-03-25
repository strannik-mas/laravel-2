<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Validator;

class PagesEditController extends Controller
{
    //13 урок
    //идентификатор используется для формирования модели
    public function execute(Page $page,Request $request/*$id*/)
    {
//        $page = Page::find($id);

        //15 урок
        if($request->isMethod('delete')){
            $page->delete();
            return redirect('admin')->with('status', 'Страница удалена');
        }

        //14 урок
        if($request->isMethod('post')){
            $input = $request->except('_token');

            $validator = Validator::make($input, [
                'name' => 'required|max:255',
                'alias' => 'required|max:255|unique:pages,alias,'.$input['id'],
                'text' => 'required'
            ]);

            if($validator->fails()){
                return redirect()->route('pagesEdit', ['page' => $input['id']])->withErrors($validator);
            }
            if($request->hasFile('images')){
                $file = $request->file('images');
                $file->move(public_path().'/img',$file->getClientOriginalName());
                $input['images'] = $file->getClientOriginalName();
            }else {
                $input['images'] = $input['old_images'];
            }

            unset($input['old_images']);

            $page->fill($input);

            if($page->update()){
                return redirect('admin')->with('status', 'Страница обновлена');
            }
        }



        //13 урок
        $old = $page->toArray();
        if(view()->exists('admin.pages_edit')){
            $data = [
                'title' => 'Редактирование страницы'.$old['name'],
                'data' => $old
            ];
            return view('admin.pages_edit', $data);
        }else {
            abort(404);
        }
    }
}
