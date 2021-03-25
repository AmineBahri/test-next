@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="row">
        <div class="col">
          <a href="{{route('home')}}" class="list-group-item font-weight-bold list-group-item-action">
          {{ __('messages.Dashboard') }}
          </a>
        </div>
        <div class="col">
          <a href="{{route('regions.index')}}" class="list-group-item font-weight-bold list-group-item-action">
          {{ __('messages.Regions') }}
          </a>
        </div>
        <div class="col">
          <a href="{{route('municipalites.index')}}" class="list-group-item font-weight-bold list-group-item-action">
          {{ __('messages.Municipalites') }}
          </a>
        </div>
        <div class="col">
          <a href="{{route('companies.index')}}" class="list-group-item font-weight-bold list-group-item-action">
          {{ __('messages.Companies') }}
          </a>
        </div>
        <div class="col">
          <a href="{{route('customerstype.index')}}" class="list-group-item font-weight-bold list-group-item-action">
          {{ __('messages.Customers Type') }}
         </a>
        </div>
        <div class="col">
          <a href="{{route('home')}}" class="list-group-item font-weight-bold list-group-item-action">
          {{ __('messages.Customers') }}
          </a>
        </div>
      </div>
        <div class="col-md-12">
            <form class="form-group" method="POST" action="{{route('customers.search')}}">
            @csrf
          <div class="row">
              <div class="col">
                <input type="text" name="query" class="form-control">
              </div>
              <div class="col">
                <button type="submit" class="btn btn-success">{{ __('messages.search') }}</button>
              </div>
          </div>
          </form>
          @if(auth()->user()->roles === 'admin')
          <a href="{{url('addcustomer')}}" class="btn btn-primary my-2">
            <i class="fa fa-plus"></i>
          </a>
          @endif
                    <table class="table table-nover">
                       <thead>
                         <tr>
                            <th>{{ __('messages.Id') }}</th>
                            <th>{{ __('messages.Name') }}</th>
                            <th>{{ __('messages.Cin') }}</th>
                            <th>{{ __('messages.Address') }}</th>
                            <th>{{ __('messages.Birthday') }}</th>
                            <th>{{ __('messages.Phone') }}</th>
                            <th>{{ __('messages.Image') }}</th>
                            <th>{{ __('messages.Parents Name') }}</th>
                            <th>{{ __('messages.Customer Type') }}</th>
                            <th>{{ __('messages.Company') }}</th>
                            <th>{{ __('messages.Municipalite') }}</th>
                            @if(auth()->user()->roles === 'admin' || auth()->user()->roles === 'superviseur')
                            <th>{{ __('messages.Actions') }}</th>
                            @elseif(auth()->user()->roles === 'auteur')
                            <th>{{ __('messages.Actions') }}</th>
                            @endif
                         </tr>
                        </thead>
                        <tbody>
                          @foreach($customers as $customer)
                          <tr>
                           <td>{{$customer->id}}</td>
                           <td>{{$customer->name}}</td>
                           <td>{{$customer->cin}}</td>
                           <td>{{$customer->address}}</td>
                           <td>{{$customer->birthday}}</td>
                           <td>{{$customer->phone}}</td>
                           <td>
                            <img src="{{asset($customer->image_path)}}" alt="{{$customer->name}}" width="50" height="50" class="img-fluid rounded">
                           </td>
                           <td>{{$customer->parents_name}}</td>
                           <td>{{$customer->customertype->name_fr}}</td>
                           <td>{{$customer->companies->name_fr}}</td>
                           <td>{{$customer->municipalites->name_fr}}</td>
                           @if(auth()->user()->roles === 'admin' || auth()->user()->roles === 'superviseur')
                           <td class="d-flex flex-row justify-content-center align-items-center">
                              <a href="{{url('editcustomer/'.$customer->id)}}" class="btn btn-sm btn-warning mr-2">
                                <i class="fa fa-edit"></i>
                              </a>
                              <a href="{{url('deletecustomer/'.$customer->id)}}" class="btn btn-sm btn-danger mr-2" onclick="return confirmDialog()">
                                <i class="fa fa-trash"></i>
                              </a>
                           </td>
                           @elseif(auth()->user()->roles === 'auteur')
                            <td>
                              <a href="{{url('auteurrole')}}" class="btn btn-sm btn-danger mr-2">
                                <i class="fa fa-trash"></i>
                              </a>
                            </td>
                           @endif
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <div class="justify-content-center d-flex">
                      {{$customers->links()}}
                    </div>
                </div>
    </div>
</div>
@endsection
<script type="text/javascript">
  function confirmDialog() {
  var x=confirm("Vous etes sur de les supprimer?")
  if (x) {
    return true;
  } else {
    return false;
  } } 
</script>