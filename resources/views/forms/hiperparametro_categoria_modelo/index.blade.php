    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="vc_nome{{ isset($item) ? $item->id : '' }}" name="vc_nome" value="{{ old('vc_nome', $item->vc_nome ?? '') }}" placeholder="NOME *" required>
            <label for="vc_nome{{ isset($item) ? $item->id : '' }}">NOME *</label>
            @error('vc_nome')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <label class="form-label" for="it_id_categoria{{ isset($item) ? $item->id : '' }}">CATEGORIAMODELO *</label>
        <select class="selectize" id="it_id_categoria{{ isset($item) ? $item->id : '' }}" name="it_id_categoria" data-placeholder="Selecione um CATEGORIAMODELO" required>
            <option value="" disabled>Selecione um CATEGORIAMODELO</option>
            @foreach ($categoria_modelos as $categoria_modelo)
                <option value="{{ $categoria_modelo->id }}" {{ old('it_id_categoria', $item->it_id_categoria ?? '') == $categoria_modelo->id ? 'selected' : '' }}>{{ $categoria_modelo->nomeRegistro }}</option>
            @endforeach
        </select>
        @error('it_id_categoria')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
