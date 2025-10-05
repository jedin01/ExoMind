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
                <input type="text" class="form-control" id="vc_prefix{{ isset($item) ? $item->id : '' }}" name="vc_prefix" value="{{ old('vc_prefix', $item->vc_prefix ?? '') }}" placeholder="PREFIX *" required>
            <label for="vc_prefix{{ isset($item) ? $item->id : '' }}">PREFIX *</label>
            @error('vc_prefix')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="vc_route_subgroup{{ isset($item) ? $item->id : '' }}" name="vc_route_subgroup" value="{{ old('vc_route_subgroup', $item->vc_route_subgroup ?? '') }}" placeholder="ROUTE_SUBGROUP *" required>
            <label for="vc_route_subgroup{{ isset($item) ? $item->id : '' }}">ROUTE_SUBGROUP *</label>
            @error('vc_route_subgroup')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="vc_url{{ isset($item) ? $item->id : '' }}" name="vc_url" value="{{ old('vc_url', $item->vc_url ?? '') }}" placeholder="URL *" required>
            <label for="vc_url{{ isset($item) ? $item->id : '' }}">URL *</label>
            @error('vc_url')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="vc_sub_group{{ isset($item) ? $item->id : '' }}" name="vc_sub_group" value="{{ old('vc_sub_group', $item->vc_sub_group ?? '') }}" placeholder="SUB_GROUP" >
            <label for="vc_sub_group{{ isset($item) ? $item->id : '' }}">SUB_GROUP</label>
            @error('vc_sub_group')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-floating form-floating-outline">
                <input type="text" class="form-control" id="vc_icon{{ isset($item) ? $item->id : '' }}" name="vc_icon" value="{{ old('vc_icon', $item->vc_icon ?? '') }}" placeholder="ICON" >
            <label for="vc_icon{{ isset($item) ? $item->id : '' }}">ICON</label>
            @error('vc_icon')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <label class="form-label" for="it_id_group{{ isset($item) ? $item->id : '' }}">GROUP</label>
        <select class="selectize" id="it_id_group{{ isset($item) ? $item->id : '' }}" name="it_id_group" data-placeholder="Selecione um GROUP" >
            <option value="" disabled>Selecione um GROUP</option>
            @foreach ($groups as $group)
                <option value="{{ $group->id }}" {{ old('it_id_group', $item->it_id_group ?? '') == $group->id ? 'selected' : '' }}>{{ $group->nomeRegistro }}</option>
            @endforeach
        </select>
        @error('it_id_group')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
