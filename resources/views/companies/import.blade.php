@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-8">
          <div class="card p-3">
            <h3 class="card-title">Importer des données à partir des fichiers excel</h3>
            <div class="card-body">
              <form method="POST" action="{{route('companies.excel')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="file">Choisir un fichier</label>
                  <input type="file" name="file" class="form-control">
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