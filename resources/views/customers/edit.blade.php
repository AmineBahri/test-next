@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-8">
          <div class="card p-3">
            <h3 class="card-title">Modifier le customer {{$customer->name}}</h3>
            <div class="card-body">
		  	<form method="post" action="{{url('updatecustomer',$customer->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <input type="text" name="name" value="{{$customer->name}}" class="form-control">
                </div>
                <div class="form-group">
                  <input type="number" name="cin" value="{{$customer->cin}}" class="form-control">
                </div>
                <div class="form-group">
                  <input type="text" name="address" value="{{$customer->address}}" class="form-control">
                </div>
                <div class="form-group">
                  <input type="date" name="birthday" value="{{$customer->birthday}}" class="form-control">
                </div>
                <div class="form-group">
                  <input type="number" name="phone" value="{{$customer->phone}}" class="form-control">
                </div>
                <div class="form-group">
                  <img src="{{asset($customer->image_path)}}" width="200" height="200" alt="{{$customer->name}}">
                </div>
                <div class="form-group">
                  <input type="file" name="image_path" class="form-control">
                </div>
                <div class="form-group">
                  <input type="text" name="parents_name" value="{{$customer->parents_name}}" class="form-control">
                </div>
                <div class="form-group">
                  <select name="customerstype_id" class="form-control">
                    <option value="" selected disabled>
                      Choisir un customer type
                    </option>
                    @foreach($customerstype as $customer_type)
                      <option {{$customer->customertype_id === $customer_type->id ? "selected" : ""}} value="{{$customer_type->id}}">
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
                      <option {{$customer->companie_id === $company->id ? "selected" : ""}} value="{{$company->id}}">
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
                      <option {{$customer->municipalite_id === $municipalite->id ? "selected" : ""}} value="{{$municipalite->id}}">
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