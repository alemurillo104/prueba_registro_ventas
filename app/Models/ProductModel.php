<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'price',
        'state',
    ];

    protected $guarded = [];

    public static function getProductsAll( )
    {
        $products = DB::table('products')
            ->where('products.state', '=', true)
            ->select('products.*')
            ->get();
       
        return $products;    
    }
}