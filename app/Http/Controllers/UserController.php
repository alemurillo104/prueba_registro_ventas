<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsuarioModel;

use Carbon\Carbon;
use DB;
use Log;
use Redirect;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = UsuarioModel::getUsuariosAll(); 
        return view('user.index', ["usuarios" => $usuarios]);
    }
    
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $data = [
            'ci'=> $request->get('ci'),
            'name'  => $request->get('name'),
            'phone' => $request->get('phone'),
            'genre' => $request->get('genre'),
        ];

        $user_id = DB::table('usuarios')->insertGetId($data);
        return redirect()->route('admin.usuario.index');
    }
}