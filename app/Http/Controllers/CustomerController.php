<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Company;
use App\CustomerType;
use App\Municipalite;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    //méthode permet de parcourir la liste de customers

    public function index()
    {
    	return view('customers.index')->with([
    		'customers' => Customer::paginate(5),
    	]);
    }

    //méthode permet de retourner la view d'ajout d'un customer

    public function create()
    {
    	if (auth()->user()->roles === 'admin') 
        {
            return view('customers.create')->with([
            'companies' => Company::all(),
            'customerstype' => CustomerType::all(),
            'municipalites' => Municipalite::all()
            ]);
        }
        elseif (auth()->user()->roles === 'user' || auth()->user()->roles === 'auteur' || auth()->user()->roles === 'superviseur')
        {
            return redirect('/home')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
        }
    }

    //méthode permet d'ajouter un customer

    public function addCustomer(Request $request)
    {
    	if (auth()->user()->roles === 'admin') 
        {
            //validation
            $this->validate($request,[
               "name" => "required",
               "cin" => "required|numeric|min:8",
               "address" => "required",
               "birthday" => "required|date",
               "phone" => "required|numeric|min:8",
               "image_path" => "required|image|mimes:png,jpeg,jpeg|max:2048",
               "parents_name" => "required",
               "customerstype_id" => "required|numeric",
               "companie_id" => "required|numeric",
               "municipalite_id" => "required|numeric",
            ]);

           //add data
           if ($request->has("image_path")) 
           {
            $file = $request->image_path;
            $imageName = "images/customers/".time()."_".$file->getClientOriginalName();
            $file->move(public_path("images/customers/"),$imageName);

            Customer::create([
                "name" => $request->name,
                "cin" => $request->cin,
                "address" => $request->address,
                "birthday" => $request->birthday,
                "phone" => $request->phone,
                "image_path" => $imageName,
                "parents_name" => $request->parents_name,
                "customertype_id" => $request->customerstype_id,
                "companie_id" => $request->companie_id,
                "municipalite_id" => $request->municipalite_id,
            ]);

            return redirect('/customers')->withSuccess("Customer ajouté avec succès");
            }
        }
        elseif (auth()->user()->roles === 'user' || auth()->user()->roles === 'auteur' || auth()->user()->roles === 'superviseur')
        {
            return redirect('/home')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
        }
    }

    //méthode permet de retourner la view d'édition d'un customer

    public function editCustomer($id)
    {
      if (auth()->user()->roles === 'admin' || auth()->user()->roles === 'superviseur') 
      {
        $customer = Customer::findOrFail($id);
        return view('customers.edit')->with([
            'customer' => $customer,
            'companies' => Company::all(),
            'customerstype' => CustomerType::all(),
            'municipalites' => Municipalite::all()
        ]);
      }
      elseif (auth()->user()->roles === 'user' || auth()->user()->roles === 'auteur')
        {
            return redirect('/home')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
        }
    }

    //méthode permet de faire la modification d'un customer

    public function updateCustomer(Request $request,$id)
    {
      if (auth()->user()->roles === 'admin' || auth()->user()->roles === 'superviseur') 
      {
        //validation
        $this->validate($request,[
            "name" => "required",
            "cin" => "required|numeric|min:8",
            "address" => "required",
            "birthday" => "required|date",
            "phone" => "required|numeric|min:8",
            "image_path" => "image|mimes:png,jpeg,jpeg|max:2048",
            "parents_name" => "required",
            "customerstype_id" => "required|numeric",
            "companie_id" => "required|numeric",
            "municipalite_id" => "required|numeric",
        ]);

        //update data
        $customer = Customer::findOrFail($id);
        if ($request->has("image_path")) 
        {
            $photo = public_path("images/customers/".$customer->image_path);
            if (File::exists($photo)) 
            {
                unlink($photo);
            }
            $file = $request->image_path;
            $imageName = "images/customers/".time()."_".$file->getClientOriginalName();
            $file->move(public_path("images/customers/"),$imageName);
            $customer->image_path = $imageName;
        }
        //$customer = Customer::findOrFail($id);
        $customer->name = $request->name;
        $customer->cin = $request->cin;
        $customer->address = $request->address;
        $customer->birthday = $request->birthday;
        $customer->phone = $request->phone;
        //$customer->image_path = $imageName;
        $customer->parents_name = $request->parents_name;
        $customer->customertype_id = $request->customerstype_id;
        $customer->companie_id = $request->companie_id;
        $customer->municipalite_id = $request->municipalite_id;
        $customer->save();
        return redirect('/customers')->withSuccess("Customer modifié avec succès");
      }  
      elseif (auth()->user()->roles === 'user' || auth()->user()->roles === 'auteur')
        {
            return redirect('/home')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
        }
    }

    //méthode permet de supprimer un customer

    public function deleteCustomer($id)
    {
      if (auth()->user()->roles === 'admin' || auth()->user()->roles === 'superviseur') 
      {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect('/customers')->withSuccess("Customer supprimé avec succès");
      }
      elseif (auth()->user()->roles === 'user' || auth()->user()->roles === 'auteur')
        {
            return redirect('/home')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
        }
    }

    /**
     * méthode permet de faire la recherche sur les customers.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
       if (auth()->user()->roles === 'admin') 
       { 
        $data = Customer::where('name', 'like', '%'.$request->input('query').'%')->get();
        //return $data;
        return view('customers.search')->with([
            'customers' => $data,
        ]);
       }
        elseif (auth()->user()->roles === 'user' || auth()->user()->roles === 'auteur' || auth()->user()->roles === 'superviseur')
        {
            return redirect('/home')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
        }
    }

    /*méthode spécifiée au role auteur qui affiche le button de suppression 
    et ne permet pas de faire la suppression*/

    public function auteurCustomer()
    {
        return redirect('/customers')->with(["errorLink" => "Vous n'avez pas le role de faire cette méthode"]);
    }
}
