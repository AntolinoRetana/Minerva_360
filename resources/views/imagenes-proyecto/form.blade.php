<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="proyecto_id" class="form-label">{{ __('Proyecto Id') }}</label>
            <input type="text" name="proyecto_id" class="form-control @error('proyecto_id') is-invalid @enderror" value="{{ old('proyecto_id', $imagenesProyecto?->proyecto_id) }}" id="proyecto_id" placeholder="Proyecto Id">
            {!! $errors->first('proyecto_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="url" class="form-label">{{ __('Url') }}</label>
            <input type="text" name="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url', $imagenesProyecto?->url) }}" id="url" placeholder="Url">
            {!! $errors->first('url', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="orden" class="form-label">{{ __('Orden') }}</label>
            <input type="text" name="orden" class="form-control @error('orden') is-invalid @enderror" value="{{ old('orden', $imagenesProyecto?->orden) }}" id="orden" placeholder="Orden">
            {!! $errors->first('orden', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>