<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class DetailSellModel extends Model
{
    use HasFactory;

    protected $table = 'detail_sells'; 

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'unit_price',
        'amount',
        'subtotal',
        'state',
        'id_sell',
        'id_product',
    ];
    
    protected $guarded = [];

    public static function getDetailSellsAll($id_sell)
    {
        $detail_sells = DB::table('detail_sells')
            ->join('products', 'detail_sells.id_product', 'products.id')
            ->where('detail_sells.id_sell', '=', $id_sell)
            ->where('detail_sells.state', '=', true)
            ->select('detail_sells.*', 'products.name AS product_name', 'products.price AS product_price')
            ->get();
       
        return $detail_sells;    
    }
    public static function lastId()
    {
        return DB::table('detail_sells')->max('id');
    }
}