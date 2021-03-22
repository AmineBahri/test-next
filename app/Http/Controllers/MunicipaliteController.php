<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Municipalite;
use App\Region;

class MunicipaliteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('municipalites.index')->with([
            'municipalites' => Municipalite::paginate(5),
            'regions' => Region::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (auth()->user()->roles === 'admin') 
      {
        return view('municipalites.create')->with([
            'regions' => Region::all()
        ]);
      }
      elseif (auth()->user()->roles === 'user' || auth()->user()->roles === 'auteur' || auth()->user()->roles === 'superviseur')
        {
            return redirect('/home')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if (auth()->user()->roles === 'admin') 
      {
        //validation
        $this->validate($request,[
            "name_fr" => "required",
            "name_ar" => "required",
            "region_id" => "required|numeric"
        ]);

        //add data

        Municipalite::create([
            "name_fr" => $request->name_fr,
            "name_ar" => $request->name_ar,
            "region_id" => $request->region_id
        ]);

        return redirect('/municipalites')->withSuccess("Municipalite ajoutée avec succès");
       }
       elseif (auth()->user()->roles === 'user' || auth()->user()->roles === 'auteur' || auth()->user()->roles === 'superviseur')
        {
            return redirect('/home')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if (auth()->user()->roles === 'admin' || auth()->user()->roles === 'superviseur') 
      {
        $municipalite = Municipalite::findOrFail($id);
        return view("municipalites.edit")->with([
            "municipalite" => $municipalite,
            "regions" => Region::all()
        ]);
      }
      elseif (auth()->user()->roles === 'user' || auth()->user()->roles === 'auteur' || auth()->user()->roles === 'superviseur')
        {
            return redirect('/home')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if (auth()->user()->roles === 'admin' || auth()->user()->roles === 'superviseur') 
      {
        //validation
        $this->validate($request,[
            "name_fr" => "required",
            "name_ar" => "required",
            "region_id" => "required|numeric",
        ]);

        //update data

        $municipalite = Municipalite::findOrFail($id);
        $municipalite->update([
            "name_fr" => $request->name_fr,
            "name_ar" => $request->name_ar,
            "region_id" => $request->region_id
        ]);

        return redirect('/municipalites')->withSuccess("Municipalite modifiée avec succès");
       }
      elseif (auth()->user()->roles === 'user' || auth()->user()->roles === 'auteur' || auth()->user()->roles === 'superviseur')
        {
            return redirect('/home')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if (auth()->user()->roles === 'admin' || auth()->user()->roles === 'superviseur') 
      {
        $municipalite = Municipalite::findOrFail($id);
        $municipalite->delete();
        return redirect('/municipalites')->withSuccess("Municipalite supprimée avec succès");
      }
      elseif (auth()->user()->roles === 'user' || auth()->user()->roles === 'auteur' || auth()->user()->roles === 'superviseur')
        {
            return redirect('/home')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
        }
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
      if (auth()->user()->roles === 'admin') 
      {
        $data = Municipalite::where('name_fr', 'like', '%'.$request->input('query').'%')->get();
        //return $data;
        return view('municipalites.search')->with([
            'municipalites' => $data,
            'regions' => Region::all()
        ]);
       }
       elseif (auth()->user()->roles === 'user' || auth()->user()->roles === 'auteur' || auth()->user()->roles === 'superviseur')
        {
            return redirect('/home')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
        }
    }

    /*méthode spécifiée au role auteur qui affiche le button de suppression 
    et ne permet pas de faire la suppression*/

    public function auteurMunicipalite()
    {
        return redirect('/municipalites')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
    }
}
