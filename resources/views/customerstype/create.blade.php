@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-8">
          <div class="card p-3">
            <h3 class="card-title">Ajouter un customer type</h3>
            <div class="card-body">
              <form method="post" action="{{route('customerstype.store')}}">
                @csrf
                <div class="form-group">
                  <input type="text" name="name_fr" placeholder="Nom français" class="form-control">
                </div>
                <div class="form-group">
                  <input type="text" name="name_ar" placeholder="Nom arabe" class="form-control">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">
                    Valider
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection