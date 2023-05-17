<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class SellModel extends Model
{
    use HasFactory;
    
    protected $table = 'sells'; 

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'date',
        'observation',
        'state',
    ];

    protected $guarded = [];

    public static function getSellsAll( )
    {
        $sells = DB::table('sells')
            ->where('sells.state', '=', true)
            ->select('sells.*')
            ->get();
       
        return $sells;    
    }
}