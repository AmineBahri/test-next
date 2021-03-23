<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use Excel;
use App\Imports\CompanyImport;

class CompanyController extends Controller
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
        return view('companies.index')->with([
            'companies' => Company::paginate(5)
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
        return view('companies.create');
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
            "adresse" => "required"
        ]);

        //add data

        Company::create([
            "name_fr" => $request->name_fr,
            "name_ar" => $request->name_ar,
            "adresse" => $request->adresse
        ]);

        return redirect('/companies')->withSuccess("Companie ajoutée avec succès");
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
        $companie = Company::findOrFail($id);
        return view("companies.edit")->with([
            "companie" => $companie
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
            "adresse" => "required",
        ]);

        //update data

        $companie = Company::findOrFail($id);
        $companie->update([
            "name_fr" => $request->name_fr,
            "name_ar" => $request->name_ar,
            "adresse" => $request->adresse
        ]);

        return redirect('/companies')->withSuccess("Companie modifiée avec succès");
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
        $companie = Company::findOrFail($id);
        $companie->delete();
        return redirect('/companies')->withSuccess("Companie supprimée avec succès");
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
        $data = Company::where('name_fr', 'like', '%'.$request->input('query').'%')->get();
        //return $data;
        return view('companies.search', ['companies' => $data]);
      }
      elseif (auth()->user()->roles === 'user' || auth()->user()->roles === 'auteur' || auth()->user()->roles === 'superviseur')
        {
            return redirect('/home')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
        }
    }

    /*méthode spécifiée au role auteur qui affiche le button de suppression 
    et ne permet pas de faire la suppression*/

    public function auteurCompany()
    {
        return redirect('/companies')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
    }

    /* méthode permet d'imprter des données à partir de fichier excel vers la BD*/

    public function importCompany()
    {
      if (auth()->user()->roles === 'admin') 
      {
        return view('companies.import');
      }
      elseif (auth()->user()->roles === 'user' || auth()->user()->roles === 'auteur' || auth()->user()->roles === 'superviseur')
        {
            return redirect('/home')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
        }
    }

    public function companyImportedByExcel(Request $request)
    {
      if (auth()->user()->roles === 'admin') 
      {
        Excel::import(new CompanyImport,$request->file);
        return redirect('/companies')->withSuccess("Données importées d'excel avec succès");
      }
      elseif (auth()->user()->roles === 'user' || auth()->user()->roles === 'auteur' || auth()->user()->roles === 'superviseur')
        {
            return redirect('/home')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
        }
    }
}
