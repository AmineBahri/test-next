@extends('layouts.app')

@section('content')
	<div class="container">
	 <div class="row justify-content-center">
        <div class="col-md-4">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-8">
          <div class="card p-3">
            <h3 class="card-title">{{ __('messages.Ajouter un customer') }}</h3>
            <a href="{{route('customers.import')}}" class="nav-link my-2">
            {{ __('messages.Ajouter à partir fichier excel')}}</a>
            <div class="card-body">
		  	<form method="post" action="{{url('storecustomer')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <input type="text" name="name" placeholder="{{ __('messages.Name')}}" class="form-control">
                </div>
                <div class="form-group">
                  <input type="number" name="cin" placeholder="{{ __('messages.Cin')}}" class="form-control">
                </div>
                <div class="form-group">
                  <input type="text" name="address" placeholder="{{ __('messages.Address')}}" class="form-control">
                </div>
                <div class="form-group">
                  <input type="date" name="birthday" placeholder="{{ __('messages.Birthday')}}" class="form-control">
                </div>
                <div class="form-group">
                  <input type="number" name="phone" placeholder="{{ __('messages.Phone')}}" class="form-control">
                </div>
                <div class="form-group">
                  <input type="file" name="image_path" class="form-control">
                </div>
                <div class="form-group">
                  <input type="text" name="parents_name" placeholder="{{ __('messages.Parents Name')}}" class="form-control">
                </div>
                <div class="form-group">
                  <select name="customerstype_id" class="form-control">
                    <option value="" selected disabled>
                      {{ __('messages.Choisir un customers type')}}
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
                      {{ __('messages.Choisir une companie')}}
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
                      {{ __('messages.Choisir une municipalite')}}
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
                    {{ __('messages.Validate') }}
                  </button>
                </div>
              </form>
		  </div>
		</div>
	</div>
</div>
</div>
@endsection