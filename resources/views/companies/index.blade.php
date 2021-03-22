@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-8">
          <form class="form-group" method="POST" action="{{route('companies.search')}}">
            @csrf
          <div class="row">
              <div class="col">
                <input type="text" name="query" class="form-control">
              </div>
              <div class="col">
                <button type="submit" class="btn btn-success">search</button>
              </div>
          </div>
          </form>
          @if(auth()->user()->roles === 'admin')
          <a href="{{route('companies.create')}}" class="btn btn-primary my-2">
            <i class="fa fa-plus"></i>
          </a>
          @endif
            <table class="table table-nover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name Fr</th>
                        <th>Name Ar</th>
                        <th>Adresse</th>
                        @if(auth()->user()->roles === 'admin' || auth()->user()->roles === 'superviseur')
                        <th>Actions</th>
                        @elseif(auth()->user()->roles === 'auteur')
                        <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $companie)
                       <tr>
                           <td>{{$companie->id}}</td>
                           <td>{{$companie->name_fr}}</td>
                           <td>{{$companie->name_ar}}</td>
                           <td>{{$companie->adresse}}</td>
                           @if(auth()->user()->roles === 'admin' || auth()->user()->roles === 'superviseur')
                           <td class="d-flex flex-row align-items-center">
                              <a href="{{route('companies.edit',$companie->id)}}" class="btn btn-sm btn-warning mr-2">
                                <i class="fa fa-edit"></i>
                              </a>
                              <form id="{{$companie->id}}" method="POST" action="{{route('companies.destroy',$companie->id)}}">
                                   @csrf
                                   @method("DELETE")
                                   <button onclick="event.preventDefault();
                                      if (confirm('Voulez vous vraiment supprimer la companie {{$companie->name_fr}} ?')) 
                                        document.getElementById({{$companie->id}}).submit();
                                      " class="btn btn-sm btn-danger">
                                       <i class="fa fa-trash"></i>
                                   </button>
                               </form>
                           </td>
                           @elseif(auth()->user()->roles === 'auteur')
                            <td>
                              <a href="{{route('companies.role')}}" class="btn btn-sm btn-danger mr-2">
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
              {{$companies->links()}}
            </div>
        </div>
    </div>
</div>
@endsection