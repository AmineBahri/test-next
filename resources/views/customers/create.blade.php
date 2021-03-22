@extends('layouts.app')

@section('content')
	<div class="container">
	 <div class="row justify-content-center">
        <div class="col-md-4">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-8">
          <div class="card p-3">
            <h3 class="card-title">Ajouter un customer</h3>
            <div class="card-body">
		  	<form method="post" action="{{url('storecustomer')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <input type="text" name="name" placeholder="Name" class="form-control">
                </div>
                <div class="form-group">
                  <input type="number" name="cin" placeholder="Cin" class="form-control">
                </div>
                <div class="form-group">
                  <input type="text" name="address" placeholder="Address" class="form-control">
                </div>
                <div class="form-group">
                  <input type="date" name="birthday" placeholder="Birthday" class="form-control">
                </div>
                <div class="form-group">
                  <input type="number" name="phone" placeholder="Phone" class="form-control">
                </div>
                <div class="form-group">
                  <input type="file" name="image_path" class="form-control">
                </div>
                <div class="form-group">
                  <input type="text" name="parents_name" placeholder="Parents name" class="form-control">
                </div>
                <div class="form-group">
                  <select name="customerstype_id" class="form-control">
                    <option value="" selected disabled>
                      Choisir un customers type
                    </option>
                    @foreach($customerstype as $customer_type)
                      <option value="{{$customer_type->id}}">
                        {{$customer_type->name_fr}}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <select name="companie_id" class="form-control">
                    <option value="" selected disabled>
                      Choisir une companie
                    </option>
                    @foreach($companies as $company)
                      <option value="{{$company->id}}">
                        {{$company->name_fr}}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <select name="municipalite_id" class="form-control">
                    <option value="" selected disabled>
                      Choisir une municipalite
                    </option>
                    @foreach($municipalites as $municipalite)
                      <option value="{{$municipalite->id}}">
                        {{$municipalite->name_fr}}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">
                    Validate
                  </button>
                </div>
              </form>
		  </div>
		</div>
	</div>
</div>
</div>
@endsection