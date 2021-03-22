@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-8">
          <form class="form-group" method="POST" action="{{route('municipalites.search')}}">
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
          <a href="{{route('municipalites.create')}}" class="btn btn-primary my-2">
            <i class="fa fa-plus"></i>
          </a>
          @endif
            <table class="table table-nover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name Fr</th>
                        <th>Name Ar</th>
                        <th>Region</th>
                        @if(auth()->user()->roles === 'admin' || auth()->user()->roles === 'superviseur')
                        <th>Actions</th>
                        @elseif(auth()->user()->roles === 'auteur')
                        <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($municipalites as $municipalite)
                       <tr>
                           <td>{{$municipalite->id}}</td>
                           <td>{{$municipalite->name_fr}}</td>
                           <td>{{$municipalite->name_ar}}</td>
                           <td>{{$municipalite->regions->name_fr}}</td>
                           @if(auth()->user()->roles === 'admin' || auth()->user()->roles === 'superviseur')
                           <td class="d-flex flex-row align-items-center">
                              <a href="{{route('municipalites.edit',$municipalite->id)}}" class="btn btn-sm btn-warning mr-2">
                                <i class="fa fa-edit"></i>
                              </a>
                              <form id="{{$municipalite->id}}" method="POST" action="{{route('municipalites.destroy',$municipalite->id)}}">
                                   @csrf
                                   @method("DELETE")
                                   <button onclick="event.preventDefault();
                                      if (confirm('Voulez vous vraiment supprimer la municipalite {{$municipalite->name_fr}} ?')) 
                                        document.getElementById({{$municipalite->id}}).submit();
                                      " class="btn btn-sm btn-danger">
                                       <i class="fa fa-trash"></i>
                                   </button>
                               </form>
                           </td>
                           @elseif(auth()->user()->roles === 'auteur')
                            <td>
                              <a href="{{route('municipalites.role')}}" class="btn btn-sm btn-danger mr-2">
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
              {{$municipalites->links()}}
            </div>
        </div>
    </div>
</div>
@endsection