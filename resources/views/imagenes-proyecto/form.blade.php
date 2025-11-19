<div class="row">
    <div class="col-md-12 mb-3">
        <label class="form-label fw-bold">Proyecto</label>
        <input type="text" class="form-control" value="{{ $proyecto->nombre }}" disabled>
        <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label fw-bold">Imagen del proyecto</label>

        <input 
            type="file" 
            name="imagen" 
            accept="image/*"
            onchange="previewImagen(event)"
            class="form-control @error('imagen') is-invalid @enderror"
        >

        {!! $errors->first('imagen', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="col-md-12 text-center mb-3">
        <img id="preview" 
             src="" 
             class="img-fluid rounded shadow"
             style="max-height: 250px; display:none;">
    </div>

    <div class="col-md-12">
        <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-upload"></i> Guardar Imagen
        </button>
    </div>
</div>

<script>
function previewImagen(event) {
    let reader = new FileReader();

    reader.onload = function() {
        let preview = document.getElementById('preview');
        preview.src = reader.result;
        preview.style.display = 'block';
    }

    reader.readAsDataURL(event.target.files[0]);
}
</script>
