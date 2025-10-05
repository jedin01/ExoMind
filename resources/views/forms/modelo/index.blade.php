    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="nome{{ isset($item) ? $item->id : '' }}" name="nome" value="{{ old('nome', $item->nome ?? '') }}" placeholder="NOME *" required>
            <label for="nome{{ isset($item) ? $item->id : '' }}">NOME *</label>
            @error('nome')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <input type="date" class="form-control" id="data{{ isset($item) ? $item->id : '' }}" name="data" value="{{ old('data', $item->data ?? '') }}" placeholder="DATA *" required>
            <label for="data{{ isset($item) ? $item->id : '' }}">DATA *</label>
            @error('data')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <label class="form-label" for="it_id_dataset{{ isset($item) ? $item->id : '' }}">DATASET *</label>
        <select class="selectize" id="it_id_dataset{{ isset($item) ? $item->id : '' }}" name="it_id_dataset" data-placeholder="Selecione um DATASET" required>
            <option value="" disabled>Selecione um DATASET</option>
            @foreach ($datasets as $dataset)
                <option value="{{ $dataset->id }}" {{ old('it_id_dataset', $item->it_id_dataset ?? '') == $dataset->id ? 'selected' : '' }}>{{ $dataset->nomeRegistro }}</option>
            @endforeach
        </select>
        @error('it_id_dataset')
            <span class="text-danger">{{ $message }}</span>
        @enderror
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
