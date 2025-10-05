    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <select class="form-select" id="bl_read{{ isset($item) ? $item->id : '' }}" name="bl_read" required>
                    <option value="" {{ old('bl_read', $item->bl_read ?? '') == '' ? 'selected' : '' }} disabled>Selecione READ</option>
                    <option value="1" {{ old('bl_read', $item->bl_read ?? '') == '1' ? 'selected' : '' }}>Sim</option>
                    <option value="0" {{ old('bl_read', $item->bl_read ?? '') == '0' ? 'selected' : '' }}>Não</option>
                </select>
            <label for="bl_read{{ isset($item) ? $item->id : '' }}">READ *</label>
            @error('bl_read')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <select class="form-select" id="bl_update{{ isset($item) ? $item->id : '' }}" name="bl_update" required>
                    <option value="" {{ old('bl_update', $item->bl_update ?? '') == '' ? 'selected' : '' }} disabled>Selecione UPDATE</option>
                    <option value="1" {{ old('bl_update', $item->bl_update ?? '') == '1' ? 'selected' : '' }}>Sim</option>
                    <option value="0" {{ old('bl_update', $item->bl_update ?? '') == '0' ? 'selected' : '' }}>Não</option>
                </select>
            <label for="bl_update{{ isset($item) ? $item->id : '' }}">UPDATE *</label>
            @error('bl_update')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <select class="form-select" id="bl_create{{ isset($item) ? $item->id : '' }}" name="bl_create" required>
                    <option value="" {{ old('bl_create', $item->bl_create ?? '') == '' ? 'selected' : '' }} disabled>Selecione CREATE</option>
                    <option value="1" {{ old('bl_create', $item->bl_create ?? '') == '1' ? 'selected' : '' }}>Sim</option>
                    <option value="0" {{ old('bl_create', $item->bl_create ?? '') == '0' ? 'selected' : '' }}>Não</option>
                </select>
            <label for="bl_create{{ isset($item) ? $item->id : '' }}">CREATE *</label>
            @error('bl_create')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <select class="form-select" id="bl_delete{{ isset($item) ? $item->id : '' }}" name="bl_delete" required>
                    <option value="" {{ old('bl_delete', $item->bl_delete ?? '') == '' ? 'selected' : '' }} disabled>Selecione DELETE</option>
                    <option value="1" {{ old('bl_delete', $item->bl_delete ?? '') == '1' ? 'selected' : '' }}>Sim</option>
                    <option value="0" {{ old('bl_delete', $item->bl_delete ?? '') == '0' ? 'selected' : '' }}>Não</option>
                </select>
            <label for="bl_delete{{ isset($item) ? $item->id : '' }}">DELETE *</label>
            @error('bl_delete')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <label class="form-label" for="it_id_role{{ isset($item) ? $item->id : '' }}">ROLE *</label>
        <select class="selectize" id="it_id_role{{ isset($item) ? $item->id : '' }}" name="it_id_role" data-placeholder="Selecione um ROLE" required>
            <option value="" disabled>Selecione um ROLE</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ old('it_id_role', $item->it_id_role ?? '') == $role->id ? 'selected' : '' }}>{{ $role->nomeRegistro }}</option>
            @endforeach
        </select>
        @error('it_id_role')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-6 mb-4">
        <label class="form-label" for="it_id_module{{ isset($item) ? $item->id : '' }}">MODULE *</label>
        <select class="selectize" id="it_id_module{{ isset($item) ? $item->id : '' }}" name="it_id_module" data-placeholder="Selecione um MODULE" required>
            <option value="" disabled>Selecione um MODULE</option>
            @foreach ($modules as $module)
                <option value="{{ $module->id }}" {{ old('it_id_module', $item->it_id_module ?? '') == $module->id ? 'selected' : '' }}>{{ $module->nomeRegistro }}</option>
            @endforeach
        </select>
        @error('it_id_module')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
