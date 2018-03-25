<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Service;
use App\Portfolio;
use App\People;
use DB;
use Illuminate\Support\Facades\Cache;
use Mail;

class IndexController extends Controller
{
    //
    public function execute(Request $request)
    {
        //8 урок
        $messages = [
            'required' => 'Поле :attribute обязательно к заполнению',
            'email' => 'поле :attribute тут должен быть мыло'
        ];


        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email',
                'text' => 'required',
            ], $messages);

            $data = $request->all();
            Mail::send('site.email', ['data' => $data], function ($message) use ($data) {
                $mail_admin = env('MAIL_ADMIN');
                $message->from($data['email'], $data['name']);
                $message->to($mail_admin, '')->subject('question');
                return redirect()->route('home')->with('status', 'Email is send');
            });
        }

        //mail


        //5 урок
        $pages = Page::all();
        $portfolios = Portfolio::get(['name', 'filter', 'images']);
        $services = Service::where('id', "<", 20)->get();
        $peoples = People::take(3)->get();

        //7 урок
        $tags = DB::table('portfolios')->distinct()->pluck('filter');
//        dd($tags);


        //6 урок
        $menu = [];

        foreach ($pages as $page) {
            $item = [
                'title' => $page->name,
                'alias' => $page->alias
            ];
            $menu[] = $item;
        }

        $menu[] = [
            'title' => 'services',
            'alias' => 'service'
        ];
        $menu[] = [
            'title' => 'portfolio1',
            'alias' => 'Portfolio2'
        ];
        $menu[] = [
            'title' => 'team',
            'alias' => 'team'
        ];
        $menu[] = [
            'title' => 'contact',
            'alias' => 'contact'
        ];

        return view('site.index', [
            'menu' => $menu,
            'pages' => $pages,
            'services' => $services,
            'portfolios' => $portfolios,
            'peoples' => $peoples,
            'tags' => $tags,
        ]);

    }
}
