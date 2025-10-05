    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="titulo{{ isset($item) ? $item->id : '' }}" name="titulo" value="{{ old('titulo', $item->titulo ?? '') }}" placeholder="TITULO *" required>
            <label for="titulo{{ isset($item) ? $item->id : '' }}">TITULO *</label>
            @error('titulo')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <input type="file" class="form-control" id="caminho{{ isset($item) ? $item->id : '' }}" name="caminho" placeholder="CAMINHO *" required>
            <label for="caminho{{ isset($item) ? $item->id : '' }}">CAMINHO *</label>
            @error('caminho')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <input type="number" class="form-control" id="qtd_observacoes{{ isset($item) ? $item->id : '' }}" name="qtd_observacoes" value="{{ old('qtd_observacoes', $item->qtd_observacoes ?? '') }}" placeholder="QTD_OBSERVACOES *" required>
            <label for="qtd_observacoes{{ isset($item) ? $item->id : '' }}">QTD_OBSERVACOES *</label>
            @error('qtd_observacoes')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <label class="form-label" for="it_id_fonte{{ isset($item) ? $item->id : '' }}">FONTE *</label>
        <select class="selectize" id="it_id_fonte{{ isset($item) ? $item->id : '' }}" name="it_id_fonte" data-placeholder="Selecione um FONTE" required>
            <option value="" disabled>Selecione um FONTE</option>
            @foreach ($fontes as $fonte)
                <option value="{{ $fonte->id }}" {{ old('it_id_fonte', $item->it_id_fonte ?? '') == $fonte->id ? 'selected' : '' }}>{{ $fonte->nomeRegistro }}</option>
            @endforeach
        </select>
        @error('it_id_fonte')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
