    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="vc_name{{ isset($item) ? $item->id : '' }}" name="vc_name" value="{{ old('vc_name', $item->vc_name ?? '') }}" placeholder="NAME *" required>
            <label for="vc_name{{ isset($item) ? $item->id : '' }}">NAME *</label>
            @error('vc_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="vc_email{{ isset($item) ? $item->id : '' }}" name="vc_email" value="{{ old('vc_email', $item->vc_email ?? '') }}" placeholder="EMAIL *" required>
            <label for="vc_email{{ isset($item) ? $item->id : '' }}">EMAIL *</label>
            @error('vc_email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="vc_password{{ isset($item) ? $item->id : '' }}" name="vc_password" value="{{ old('vc_password', $item->vc_password ?? '') }}" placeholder="PASSWORD *" required>
            <label for="vc_password{{ isset($item) ? $item->id : '' }}">PASSWORD *</label>
            @error('vc_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <input type="file" class="form-control" id="vc_profile_photo_path{{ isset($item) ? $item->id : '' }}" name="vc_profile_photo_path" placeholder="PROFILE_PHOTO_PATH" >
            <label for="vc_profile_photo_path{{ isset($item) ? $item->id : '' }}">PROFILE_PHOTO_PATH</label>
            @error('vc_profile_photo_path')
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
