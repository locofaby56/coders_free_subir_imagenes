@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Subir Imagenes </h1>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Imagenes</h5>
                    <p class="card-text">
                        <form action="{{route('admin.files.store')}}" method="POST" enctype="multipart/form-data">
                            
                            @csrf
                            <div class="form-group">
                            <input type="file" id="file" name="file" accept="image/*"><br><br>
                            @error('file')
                               <small class="text-danger">{{$message}}</small> 
                            @enderror
                            </div>
                            <input type="submit" class="btn btn-primary" value="Subir imagen">
                        </form>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



