    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="vc_nome{{ isset($item) ? $item->id : '' }}" name="vc_nome" value="{{ old('vc_nome', $item->vc_nome ?? '') }}" placeholder="NOME *" required>
            <label for="vc_nome{{ isset($item) ? $item->id : '' }}">NOME *</label>
            @error('vc_nome')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
