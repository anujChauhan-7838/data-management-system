<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
class DashboardController extends Controller
{
    function __construct(){
        parent::__construct();
    }

    public function index(){ 
        $totalUsers = User::count();
        $totalCategory = Category::count();
        $totalProducts = Product::count();
        return view('dashboard',['totalUsers'=>$totalUsers,'totalCategory'=>$totalCategory,'totalProduct'=>$totalProducts]);
    }
}
