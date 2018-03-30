<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Multimedia;

class multimediaController extends Controller
{

    public function index()
    {
        $multimedia=Multimedia::all()->first();
        return view('multimedia.multimedia')->with('multimedia',$multimedia);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $multimedia = Multimedia::all()->first();
        if(is_null($multimedia)){
            $multimedia = new  Multimedia();
        }else{
             $multimedia=Multimedia::all()->first();
        }
        $multimedia->url_envivo = $request->url_envivo;
        $multimedia->save();
        return $multimedia;
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
