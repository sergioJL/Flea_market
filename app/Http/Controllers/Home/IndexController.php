<?php

namespace App\Http\Controllers\Home;

use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;

/**
 * Class indexController
 * @package App\Http\Controllers\Home
 */
class indexController extends Controller
{
    /**
     * indexController constructor.
     */
    public function __construct()
    {
        // 开启session
        session_start();
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function index()
    {
        $user_id = session('user_id');
        if(null != $user_id)
        {
            return app()->call('App\Http\Controllers\Home\ProductsController@showall');
            //return redirect('/product/showall')->with(['user_id'=>$user_id]);
            //return view('User.login');
        }
        else
        {
            return redirect('user/login');
        }
    }
}
