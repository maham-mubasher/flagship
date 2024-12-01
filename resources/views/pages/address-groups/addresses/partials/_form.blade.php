<div class="row">
    <div class="col-md-6">
        <div class="mb-10">
            <label for="company_name" class="required form-label">Company/Name</label>
            <input type="text" id="company_name" name="company_name" class="form-control @error('company_name') is-invalid @enderror"
                   placeholder="Company/Receiver's Name" value="{{old('company_name', $address->company_name)}}" />
            @error('company_name')
            <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-10">
            <label for="attention" class="required form-label">Attention</label>
            <input type="text" id="attention" name="attention" class="form-control @error('attention') is-invalid @enderror"
                   placeholder="Attention" value="{{old('attention', $address->attention)}}"/>
            @error('attention')
            <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-10">
            <label for="address" class="required form-label">Address</label>
            <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror"
                   placeholder="Address" value="{{old('address', $address->address)}}"/>
            @error('address')
            <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-10">
            <label for="suite" class="form-label">Apt./Suite#</label>
            <input type="text" id="suite" name="suite" class="form-control @error('suite') is-invalid @enderror"
                   placeholder="Apt.Suite#" value="{{old('suite', $address->suite)}}" />
            @error('suite')
            <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-10">
            <label for="department" class="form-label">Department</label>
            <input type="text" id="department" name="department" class="form-control @error('department') is-invalid @enderror"
                   placeholder="Department" value="{{old('department', $address->department)}}"/>
            @error('department')
            <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-10">
            <label for="country_id" class="form-label">Country</label>
            <select name="country_id" id="country_id" class="form-select @error('country_id') is-invalid @enderror" data-control="select2" data-placeholder="Select country">
                <option value="">Select Country</option>
                @foreach(\App\Models\Country::all() as $country)
                    <option {{old('country_id', $address->country_id) == $country->id ? 'selected' : ''}} value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>
            @error('country_id')
            <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-10">
            <label for="postal_code" class="required form-label">Postal Code</label>
            <input type="text" id="postal_code" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror"
                   placeholder="Postal Code" value="{{old('postal_code', $address->postal_code)}}" />
            @error('postal_code')
            <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-10">
            <label for="city" class="required form-label">City</label>
            <input type="text" id="city" name="city" class="form-control @error('city') is-invalid @enderror"
                   placeholder="City" value="{{old('city', $address->city)}}" />
            @error('city')
            <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-10">
            <label for="province" class="required form-label">Province</label>
            <input type="text" id="province" name="province" class="form-control @error('province') is-invalid @enderror"
                   placeholder="Province" value="{{old('province', $address->province)}}"/>
            @error('province')
            <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-12 mb-10">
        <div class="form-check form-check-custom form-check-solid">
            <input class="form-check-input" type="checkbox" value="1" id="is_residential_address"
                   name="is_residential_address" {{old('is_residential_address', $address->is_residential_address) ? "checked" : ""}} />
            <label class="form-check-label" for="is_residential_address">This is a residential address</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-10">
            <label for="phone" class="required form-label">Phone</label>
            <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror"
                   placeholder="Phone" value="{{old('phone', $address->phone)}}" />
            @error('phone')
            <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-10">
            <label for="ext" class="form-label">Ext.</label>
            <input type="text" id="ext" name="ext" class="form-control @error('ext') is-invalid @enderror"
                   placeholder="Ext." value="{{old('ext', $address->ext)}}" />
            @error('ext')
            <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-10">
            <label for="tax_id" class="form-label">Tax ID</label>
            <input type="text" id="tax_id" name="tax_id" class="form-control @error('tax_id') is-invalid @enderror"
                   placeholder="Tax ID" value="{{old('tax_id', $address->tax_id)}}" />
            @error('tax_id')
            <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-10">
            <label for="shipping_account" class="form-label">Shipping Account</label>
            <input type="text" id="shipping_account" name="shipping_account" class="form-control @error('shipping_account') is-invalid @enderror"
                   placeholder="Shipping Account" value="{{old('shipping_account', $address->shipping_account)}}" />
            @error('shipping_account')
            <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-10">
            <label for="email" class="form-label">Email</label>
            <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   placeholder="Email" value="{{old('email', $address->email)}}"/>
            @error('email')
            <span class="invalid-feedback">{{$message}}</span>
            @enderror
        </div>
    </div>
</div>
