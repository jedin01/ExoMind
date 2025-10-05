    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="valor{{ isset($item) ? $item->id : '' }}" name="valor" value="{{ old('valor', $item->valor ?? '') }}" placeholder="VALOR *" required>
            <label for="valor{{ isset($item) ? $item->id : '' }}">VALOR *</label>
            @error('valor')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <label class="form-label" for="it_id_modelo{{ isset($item) ? $item->id : '' }}">MODELO *</label>
        <select class="selectize" id="it_id_modelo{{ isset($item) ? $item->id : '' }}" name="it_id_modelo" data-placeholder="Selecione um MODELO" required>
            <option value="" disabled>Selecione um MODELO</option>
            @foreach ($modelos as $modelo)
                <option value="{{ $modelo->id }}" {{ old('it_id_modelo', $item->it_id_modelo ?? '') == $modelo->id ? 'selected' : '' }}>{{ $modelo->nomeRegistro }}</option>
            @endforeach
        </select>
        @error('it_id_modelo')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-6 mb-4">
        <label class="form-label" for="it_id_hiperparametro{{ isset($item) ? $item->id : '' }}">HIPERPARAMETROCATEGORIAMODELO *</label>
        <select class="selectize" id="it_id_hiperparametro{{ isset($item) ? $item->id : '' }}" name="it_id_hiperparametro" data-placeholder="Selecione um HIPERPARAMETROCATEGORIAMODELO" required>
            <option value="" disabled>Selecione um HIPERPARAMETROCATEGORIAMODELO</option>
            @foreach ($hiperparametro_categoria_modelos as $hiperparametro_categoria_modelo)
                <option value="{{ $hiperparametro_categoria_modelo->id }}" {{ old('it_id_hiperparametro', $item->it_id_hiperparametro ?? '') == $hiperparametro_categoria_modelo->id ? 'selected' : '' }}>{{ $hiperparametro_categoria_modelo->nomeRegistro }}</option>
            @endforeach
        </select>
        @error('it_id_hiperparametro')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
