<div class="row">
    <div class="col-md-6">
        <div class="mb-10">
            <label class="form-label required" for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name', $product->name)}}" />
            @error('name')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-10">
            <label class="form-label required" for="description">Description</label>
            <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{old('description', $product->description)}}" />
            @error('description')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-10">
            <label class="form-label" for="hs_code">HS Code</label>
            <input type="text" name="hs_code" id="hs_code" class="form-control @error('hs_code') is-invalid @enderror" value="{{old('hs_code', $product->hs_code)}}" />
            @error('hs_code')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-10">
            <label class="form-label required" for="country_id">Country of Origin</label>
            <select name="country_id" id="country_id" class="form-select @error('country_id') is-invalid @enderror" data-control="select2">
                <option value="" selected disabled>Select Country</option>
                @foreach($countries as $country)
                    <option {{old('country_id', $product->country_id) == $country->id ? 'selected' : ''}} value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>
            @error('country_id')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-10">
            <label class="form-label required" for="weight">Weight</label>
            <input type="text" name="weight" id="weight" class="form-control @error('weight') is-invalid @enderror" value="{{old('weight', $product->weight)}}" />
            @error('weight')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-10">
            <label class="form-label required" for="measurement_unit_id">Unit of measurement</label>
            <select name="measurement_unit_id" id="measurement_unit_id" class="form-select @error('measurement_unit_id') is-invalid @enderror" data-control="select2">
                <option value="" selected disabled>Select Unit of measurement</option>
                @foreach($measurementUnits as $measurementUnit)
                    <option {{old('measurement_unit_id', $product->measurement_unit_id) == $measurementUnit->id ? 'selected' : ''}} value="{{$measurementUnit->id}}">{{$measurementUnit->name}}</option>
                @endforeach
            </select>
            @error('measurement_unit_id')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-10">
            <label class="form-label required" for="reference">Reference</label>
            <input type="text" name="reference" id="reference" class="form-control @error('reference') is-invalid @enderror" value="{{old('reference', $product->reference)}}" />
            @error('reference')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-10">
            <label class="form-label required" for="unit_price">Unit Price</label>
            <input type="text" name="unit_price" id="unit_price" class="form-control @error('unit_price') is-invalid @enderror" value="{{old('unit_price', $product->unit_price)}}" />
            @error('unit_price')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-10">
            <label class="form-label required" for="unit_id">Unit</label>
            <select name="unit_id" id="unit_id" class="form-select @error('unit_id') is-invalid @enderror" data-control="select2">
                <option value="" selected disabled>Select Unit</option>
                @foreach($units as $unit)
                    <option {{old('unit_id', $product->unit_id) == $unit->id ? 'selected' : ''}} value="{{$unit->id}}">{{$unit->name}}</option>
                @endforeach
            </select>
            @error('unit_id')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>
</div>
