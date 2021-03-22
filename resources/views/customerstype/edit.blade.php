@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-8">
          <div class="card p-3">
            <h3 class="card-title">Modifier un customer de type {{$customer_type->name_fr}}</h3>
            <div class="card-body">
              <form method="post" action="{{route('customerstype.update',$customer_type->id)}}">
                @csrf
                @method("PUT")
                <div class="form-group">
                  <input type="text" name="name_fr" value="{{$customer_type->name_fr}}" class="form-control">
                </div>
                <div class="form-group">
                  <input type="text" name="name_ar" value="{{$customer_type->name_ar}}" class="form-control">
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