<?php
/**
 * Created by PhpStorm.
 * User: Ben
 * Date: 2017/2/12
 * Time: 上午12:22
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class DefaultController extends Controller
{
    public function index()
    {
        return view('admin.defaults.index');
    }
}