<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2">
            <label>Proyecto</label>
            <input type="text" class="form-control" value="{{ $proyecto->nombre }}" disabled>
            <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">
        </div>

        <div class="form-group mb-2">
            <label>Imagen del proyecto</label>

            <input 
                type="file" 
                name="imagen" 
                class="form-control @error('imagen') is-invalid @enderror"
            >

            {!! $errors->first('imagen', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>

    <div class="col-md-12 mt-2">
        <button type="submit" class="btn btn-primary">Guardar Imagen</button>
    </div>
</div>
