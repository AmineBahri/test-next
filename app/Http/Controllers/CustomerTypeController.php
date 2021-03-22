<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerType; 

class CustomerTypeController extends Controller
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
        return view('customerstype.index')->with([
            'customerstype' => CustomerType::paginate(5)
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
        return view('customerstype.create');
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
            "name_ar" => "required"
        ]);

        //add data

        CustomerType::create([
            "name_fr" => $request->name_fr,
            "name_ar" => $request->name_ar,
        ]);

        return redirect('/customerstype')->withSuccess("Customer Type added succesfully");
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
        $customer_type = CustomerType::findOrFail($id);
        return view("customerstype.edit")->with([
            "customer_type" => $customer_type
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

        $customer_type = CustomerType::findOrFail($id);
        $customer_type->update([
            "name_fr" => $request->name_fr,
            "name_ar" => $request->name_ar,
        ]);

        return redirect('/customerstype')->withSuccess("Customer Type updated succesfully");
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
        $customer_type = CustomerType::findOrFail($id);
        $customer_type->delete();
        return redirect('/customerstype')->withSuccess("Customer Type deleted succesfully");
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
        $data = CustomerType::where('name_fr', 'like', '%'.$request->input('query').'%')->get();
        //return $data;
        return view('customerstype.search', ['customerstype' => $data]);
      }
      elseif (auth()->user()->roles === 'user' || auth()->user()->roles === 'auteur' || auth()->user()->roles === 'superviseur')
        {
            return redirect('/home')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
        }
    }

    /*méthode spécifiée au role auteur qui affiche le button de suppression 
    et ne permet pas de faire la suppression*/

    public function auteurCustomerType()
    {
        return redirect('/customerstype')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
    }
}
