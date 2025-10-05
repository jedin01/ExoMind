    <div class="col-md-6 mb-4">
        <label class="form-label" for="it_id_metrica{{ isset($item) ? $item->id : '' }}">METRICAS *</label>
        <select class="selectize" id="it_id_metrica{{ isset($item) ? $item->id : '' }}" name="it_id_metrica" data-placeholder="Selecione um METRICAS" required>
            <option value="" disabled>Selecione um METRICAS</option>
            @foreach ($metricass as $metricas)
                <option value="{{ $metricas->id }}" {{ old('it_id_metrica', $item->it_id_metrica ?? '') == $metricas->id ? 'selected' : '' }}>{{ $metricas->nomeRegistro }}</option>
            @endforeach
        </select>
        @error('it_id_metrica')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
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
