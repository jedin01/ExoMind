    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <textarea class="form-control" id="lt_description{{ isset($item) ? $item->id : '' }}" name="lt_description" placeholder="DESCRIPTION *" required>{{ old('lt_description', $item->lt_description ?? '') }}</textarea>
            <label for="lt_description{{ isset($item) ? $item->id : '' }}">DESCRIPTION *</label>
            @error('lt_description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="vc_agent{{ isset($item) ? $item->id : '' }}" name="vc_agent" value="{{ old('vc_agent', $item->vc_agent ?? '') }}" placeholder="AGENT" >
            <label for="vc_agent{{ isset($item) ? $item->id : '' }}">AGENT</label>
            @error('vc_agent')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="vc_ip_address{{ isset($item) ? $item->id : '' }}" name="vc_ip_address" value="{{ old('vc_ip_address', $item->vc_ip_address ?? '') }}" placeholder="IP_ADDRESS" >
            <label for="vc_ip_address{{ isset($item) ? $item->id : '' }}">IP_ADDRESS</label>
            @error('vc_ip_address')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="vc_level{{ isset($item) ? $item->id : '' }}" name="vc_level" value="{{ old('vc_level', $item->vc_level ?? '') }}" placeholder="LEVEL" >
            <label for="vc_level{{ isset($item) ? $item->id : '' }}">LEVEL</label>
            @error('vc_level')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <label class="form-label" for="it_id_user{{ isset($item) ? $item->id : '' }}">USER *</label>
        <select class="selectize" id="it_id_user{{ isset($item) ? $item->id : '' }}" name="it_id_user" data-placeholder="Selecione um USER" required>
            <option value="" disabled>Selecione um USER</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('it_id_user', $item->it_id_user ?? '') == $user->id ? 'selected' : '' }}>{{ $user->nomeRegistro }}</option>
            @endforeach
        </select>
        @error('it_id_user')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
