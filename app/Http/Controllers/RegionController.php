<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;
use Excel;
use App\Imports\RegionImport;

class RegionController extends Controller
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
        return view('regions.index')->with([
            'regions' => Region::paginate(5)
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
          return view('regions.create');
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
        ]);

        //add data

        Region::create([
            "name_fr" => $request->name_fr,
            "name_ar" => $request->name_ar,
        ]);

        return redirect('/regions')->withSuccess("Region ajoutée avec succès");
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
        $region = Region::findOrFail($id);
        return view("regions.edit")->with([
            "region" => $region
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
        ]);

        //update data

        $region = Region::findOrFail($id);
        $region->update([
            "name_fr" => $request->name_fr,
            "name_ar" => $request->name_ar,
        ]);

        return redirect('/regions')->withSuccess("Region modifiée avec succès");
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
        $region = Region::findOrFail($id);
        $region->delete();
        return redirect('/regions')->withSuccess("Region supprimée avec succès");
      }
      elseif (auth()->user()->roles === 'user' || auth()->user()->roles === 'auteur')
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
        $data = Region::where('name_fr', 'like', '%'.$request->input('query').'%')->get();
        //return $data;
        return view('regions.search', ['regions' => $data]);
      }
      elseif (auth()->user()->roles === 'user' || auth()->user()->roles === 'auteur' || auth()->user()->roles === 'superviseur')
        {
            return redirect('/home')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
        }
    }

    /*méthode spécifiée au role auteur qui affiche le button de suppression 
    et ne permet pas de faire la suppression*/

    public function auteurRegion()
    {
        return redirect('/regions')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
    }

    /* méthode permet d'imprter des données à partir de fichier excel vers la BD*/

    public function importRegion()
    {
      if (auth()->user()->roles === 'admin') 
      {
        return view('regions.import');
      }
      elseif (auth()->user()->roles === 'user' || auth()->user()->roles === 'auteur' || auth()->user()->roles === 'superviseur')
        {
            return redirect('/home')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
        }
    }

    public function RegionImportedByExcel(Request $request)
    {
      if (auth()->user()->roles === 'admin') 
      {
        Excel::import(new RegionImport,$request->file);
        return redirect('/regions')->withSuccess("Données importées d'excel avec succès");
      }
      elseif (auth()->user()->roles === 'user' || auth()->user()->roles === 'auteur' || auth()->user()->roles === 'superviseur')
        {
            return redirect('/home')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
        }
    }
}
