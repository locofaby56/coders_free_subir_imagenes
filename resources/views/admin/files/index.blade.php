@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center g-2">
            @foreach ($files as $file)
                <div class="col-4">
                    <div class="card">
                        <img class="img-fluid" src="{{ asset($file->url) }}" alt="">
                        <div class="card-footer">
                            <a href="{{ route('admin.files.edit', $file->id) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('admin.files.destroy', $file->id) }}" class="d-inline formulario-eliminar" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
        @endforeach
        <div class="col-12">
            {{ $files->links() }}
        </div>
    </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('eliminar')== 'ok')
    <script>

      Swal.fire(
        'Eliminado!',
        '!! Eliminado con Exito !!',
        'success'
        )
        </script>
    @endif
    <script>
      $('.formulario-eliminar').submit(function(e){
        e.preventDefault();
      
        Swal.fire({
            title: 'Desea Elimiar esta Imagen?',
            text: "Ojo mi pez esta imagen se eliminara definitivamente ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, eliminar !',
            cancelButtonText: 'Cancelar Eliminacion !',
        }).then((result) => {
            if (result.isConfirmed) {
               
                this.submit();
            }
        })
      });
    </script>
@endsection
