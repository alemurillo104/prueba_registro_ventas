<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class UsuarioModel extends Model
{
    use HasFactory;
    
    protected $table = 'usuarios'; 

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'ci',
        'name',
        'nit',
        'phone',
        'genre',
        'state',
    ];

    protected $guarded = [];
    
    public static function getUsuariosAll( )
    {
        $usuarios = DB::table('usuarios')
            ->where('usuarios.state', '=', true)
            ->select('usuarios.*')
            ->get();
       
        return $usuarios;    
    }
}