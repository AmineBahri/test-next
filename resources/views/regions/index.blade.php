@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-8">
          <form class="form-group" method="POST" action="{{route('regions.search')}}">
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
          <a href="{{route('regions.create')}}" class="btn btn-primary my-2">
            <i class="fa fa-plus"></i>
          </a>
          @endif
            <table class="table table-nover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name Fr</th>
                        <th>Name Ar</th>
                        @if(auth()->user()->roles === 'admin' || auth()->user()->roles === 'superviseur')
                        <th>Actions</th>
                        @elseif(auth()->user()->roles === 'auteur')
                        <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($regions as $region)
                       <tr>
                           <td>{{$region->id}}</td>
                           <td>{{$region->name_fr}}</td>
                           <td>{{$region->name_ar}}</td>
                           @if(auth()->user()->roles === 'admin' || auth()->user()->roles === 'superviseur')
                           <td class="d-flex flex-row align-items-center">
                              <a href="{{route('regions.edit',$region->id)}}" class="btn btn-sm btn-warning mr-2">
                                <i class="fa fa-edit"></i>
                              </a>
                              <form id="{{$region->id}}" method="POST" action="{{route('regions.destroy',$region->id)}}">
                                   @csrf
                                   @method("DELETE")
                                   <button onclick="event.preventDefault();
                                      if (confirm('Voulez vous vraiment supprimer la region {{$region->name_fr}} ?')) 
                                        document.getElementById({{$region->id}}).submit();
                                      " class="btn btn-sm btn-danger">
                                       <i class="fa fa-trash"></i>
                                   </button>
                               </form>
                           </td>
                           @elseif(auth()->user()->roles === 'auteur')
                            <td>
                              <a href="{{route('regions.role')}}" class="btn btn-sm btn-danger mr-2">
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
              {{$regions->links()}}
            </div>
        </div>
    </div>
</div>
@endsection