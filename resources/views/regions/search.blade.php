@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-8">
          <a href="{{route('regions.index')}}" class="btn btn-primary my-2">
            <i class="fa fa-home"></i>
          </a>
            <table class="table table-nover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name Fr</th>
                        <th>Name Ar</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($regions as $region)
                       <tr>
                           <td>{{$region->id}}</td>
                           <td>{{$region->name_fr}}</td>
                           <td>{{$region->name_ar}}</td>
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
                       </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection