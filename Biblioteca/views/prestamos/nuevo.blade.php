@extends("layouts.plantillaformulario")

@section("Formulario")
    <h1>Crear prestamos</h1>

    <form action="" method="post" >

        <p>
                <select id="libro" name="libro" class="form-control">
                    <option value="">Seleccione libro</option>
                    @foreach($libros as $libro)
                        <option value="{{ $libro["id"] }}">{{ $libro["titulo"] }}</option>
                    @endforeach
                </select>
        </p>

        <p>
            <select name="usuario" class="form-control">
                <option value="">Seleccione usuario</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario["id"] }}">{{ $usuario["username"] }}</option>
                @endforeach
            </select>
        </p>

        <p>
            <label for="fecha_prestamo">Fecha de prestamo</label>
            <input class="form-control" id="fecha_prestamo" type="date"  name="fecha_prestamo">
        </p>

        <p>
            <label for="fecha_devolucion">Fecha de devolucion</label>
            <input class="form-control" id="fecha_devolucion" type="date" name="fecha_devolucion" >
        </p>


        <p>
            <label for="estado">Estado</label>
            <input id="si-devuelto" type="radio" name="estado" value="0" checked> <label for="si-devuelto">Devuelto</label>
            <input id="no-devuelto" type="radio" name="estado" value="1"> <label for="no-devuelto">Prestado</label>
        </p>

        <p>
            <input class="btn btn-primary btn-sm" type="submit" value="Guardar">
            <a class="btn btn-secondary btn-sm" href="index.php">Cancelar</a>
        </p>
    </form>
@endsection