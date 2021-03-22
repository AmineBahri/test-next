@extends('layouts.app')

@section('content')
	<div class="container">
	 <div class="row justify-content-center">
        <div class="col-md-4">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-8">
          <div class="card p-3">
            <h3 class="card-title">Ajouter une municipalite</h3>
            <div class="card-body">
		  	<form method="post" action="{{route('municipalites.store')}}">
                @csrf
                <div class="form-group">
                  <input type="text" name="name_fr" placeholder="Nom français" class="form-control">
                </div>
                <div class="form-group">
                  <input type="text" name="name_ar" placeholder="Nom Arabe" class="form-control">
                </div>
                <div class="form-group">
                  <select name="region_id" class="form-control">
                    <option value="" selected disabled>
                      Choisir une région
                    </option>
                    @foreach($regions as $region)
                      <option value="{{$region->id}}">
                        {{$region->name_fr}}
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