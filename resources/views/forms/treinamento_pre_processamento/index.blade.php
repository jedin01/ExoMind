    <div class="col-md-6 mb-4">
        <label class="form-label" for="it_id_treinamento{{ isset($item) ? $item->id : '' }}">TREINAMENTO *</label>
        <select class="selectize" id="it_id_treinamento{{ isset($item) ? $item->id : '' }}" name="it_id_treinamento" data-placeholder="Selecione um TREINAMENTO" required>
            <option value="" disabled>Selecione um TREINAMENTO</option>
            @foreach ($treinamentos as $treinamento)
                <option value="{{ $treinamento->id }}" {{ old('it_id_treinamento', $item->it_id_treinamento ?? '') == $treinamento->id ? 'selected' : '' }}>{{ $treinamento->nomeRegistro }}</option>
            @endforeach
        </select>
        @error('it_id_treinamento')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-6 mb-4">
        <label class="form-label" for="it_id_pre_processamento{{ isset($item) ? $item->id : '' }}">PREPROCESSAMENTOS *</label>
        <select class="selectize" id="it_id_pre_processamento{{ isset($item) ? $item->id : '' }}" name="it_id_pre_processamento" data-placeholder="Selecione um PREPROCESSAMENTOS" required>
            <option value="" disabled>Selecione um PREPROCESSAMENTOS</option>
            @foreach ($pre_processamentoss as $pre_processamentos)
                <option value="{{ $pre_processamentos->id }}" {{ old('it_id_pre_processamento', $item->it_id_pre_processamento ?? '') == $pre_processamentos->id ? 'selected' : '' }}>{{ $pre_processamentos->nomeRegistro }}</option>
            @endforeach
        </select>
        @error('it_id_pre_processamento')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
