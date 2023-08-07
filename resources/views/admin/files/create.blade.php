@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Subir Imagenes </h1>
            {{-- <div class="card">
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
            </div> --}}
            <form action="{{route('admin.files.store')}}"
            method="POST"
            class="dropzone"
            id="my-awesome-dropzone"></form>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

<script>
    Dropzone.options.myAwesomeDropzone = { // camelized version of the `id`
      headers:{
        'X-CSRF-TOKEN' : "{{csrf_token()}}"
      },
      dictDefaultMessage: "Arrastre imagenes aqui mi perro",
      acceptedFiles: "image/*"
      
    };
  </script>

@endsection



