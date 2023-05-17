<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProductModel;

use Carbon\Carbon;
use DB;
use Log;
use Redirect;

class ProductController extends Controller
{
    public function index()
    {
        $products = ProductModel::getProductsAll(); 
        return view('product.index', ["products" => $products]);
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $data = [
            'name'  => $request->get('name'),
            'price' => $request->get('price'),
        ];

        $user_id = DB::table('products')->insertGetId($data);
        return redirect()->route('admin.product.index');
    }
}