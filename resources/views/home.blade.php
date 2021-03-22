@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
          <a href="{{route('regions.index')}}" class="list-group-item font-weight-bold list-group-item-action">
          Regions
          </a>
        </div>
        <div class="col">
          <a href="{{route('municipalites.index')}}" class="list-group-item font-weight-bold list-group-item-action">
          Municipalites
          </a>
        </div>
        <div class="col">
          <a href="{{route('companies.index')}}" class="list-group-item font-weight-bold list-group-item-action">
          Companies
          </a>
        </div>
        <div class="col">
          <a href="{{route('customerstype.index')}}" class="list-group-item font-weight-bold list-group-item-action">
          Customers Type
         </a>
        </div>
        <div class="col">
          <a href="{{url('customers')}}" class="list-group-item font-weight-bold list-group-item-action">
          Customers
          </a>
        </div>
    </div>
</div>
@endsection