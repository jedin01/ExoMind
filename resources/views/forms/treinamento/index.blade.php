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
        <div class="form-floating form-floating-outline">
                <input type="date" class="form-control" id="dt_data{{ isset($item) ? $item->id : '' }}" name="dt_data" value="{{ old('dt_data', $item->dt_data ?? '') }}" placeholder="DT_DATA *" required>
            <label for="dt_data{{ isset($item) ? $item->id : '' }}">DT_DATA *</label>
            @error('dt_data')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <input type="time" class="form-control" id="hora_inicio{{ isset($item) ? $item->id : '' }}" name="hora_inicio" value="{{ old('hora_inicio', $item->hora_inicio ?? '') }}" placeholder="HORA_INICIO *" required>
            <label for="hora_inicio{{ isset($item) ? $item->id : '' }}">HORA_INICIO *</label>
            @error('hora_inicio')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <input type="time" class="form-control" id="hora_termino{{ isset($item) ? $item->id : '' }}" name="hora_termino" value="{{ old('hora_termino', $item->hora_termino ?? '') }}" placeholder="HORA_TERMINO *" required>
            <label for="hora_termino{{ isset($item) ? $item->id : '' }}">HORA_TERMINO *</label>
            @error('hora_termino')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
