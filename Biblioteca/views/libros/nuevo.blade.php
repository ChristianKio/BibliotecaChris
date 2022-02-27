@extends("layouts.plantillaformulario")

@section("Formulario")
    <h1>Crear libros</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <p>
            <label for="titulo">Titulo</label>
            <input class="form-control" id="titulo" type="text" name="titulo">
        </p>

        <p>
                <select id="autor" name="autor" class="form-control">
                    <option value="">Seleccione autor</option>
                    @foreach($autores as $autor)
                        <option value="{{ $autor["id"] }}">{{ $autor["nombre"] }}</option>
                    @endforeach
                </select>
        </p>

        <p>
            <select name="editorial" class="form-control">
                <option value="">Seleccione editorial</option>
                @foreach($editoriales as $editorial)
                    <option value="{{ $editorial["id"] }}">{{ $editorial["nombre"] }}</option>
                @endforeach
            </select>
        </p>

        <p>
            <label for="imagen">Imagen</label>
            <input class="form-control" id="imagen" type="file" name="imagen">
        </p>

        <p>
            <select name="categoria" class="form-control">
                <option value="">Seleccione categoria</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria["id"] }}">{{ $categoria["nombre"] }}</option>
                @endforeach
            </select>
        </p>

        <p>
            <label for="sinopsis">Sinopsis:</label>
            <textarea class="form-control" id="sinopsis" name="sinopsis"></textarea>
        </p>

        <p>
            <label for="disponibilidad">Disponible</label>
            <input id="si-disponibilidad" type="radio" name="disponibilidad" value="1" checked> <label for="si-disponibilidad">Si</label>
            <input id="no-disponibilidad" type="radio" name="disponibilidad" value="0"> <label for="no-disponibilidad">No</label>
        </p>

        <p>
            <input class="btn btn-primary btn-sm" type="submit" value="Guardar">
            <a class="btn btn-secondary btn-sm" href="index.php">Cancelar</a>
        </p>
    </form>
@endsection