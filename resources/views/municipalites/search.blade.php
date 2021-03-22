@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-8">
          <a href="{{route('municipalites.index')}}" class="btn btn-primary my-2">
            <i class="fa fa-home"></i>
          </a>
            <table class="table table-nover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name Fr</th>
                        <th>Name Ar</th>
                        <th>Region</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($municipalites as $municipalite)
                       <tr>
                           <td>{{$municipalite->id}}</td>
                           <td>{{$municipalite->name_fr}}</td>
                           <td>{{$municipalite->name_ar}}</td>
                           <td>{{$municipalite->regions->name_fr}}</td>
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
                       </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection