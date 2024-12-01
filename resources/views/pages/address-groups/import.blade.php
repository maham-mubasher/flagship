<x-base-layout>
    <div class="row">
        <div class="col-md-4">
            <div class="card card-custom">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="/address-groups/import">
                @csrf

                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-10">
                            <label class="form-label required" for="address_group_id">Address Group</label>
                            <select name="address_group_id" data-control="select2" id="address_group_id" class="form-select @error('address_group_id') is-invalid @enderror">
                                @foreach(\App\Models\AddressGroup::all() as $addressGroup)
                                    <option @if($loop->first) selected @endif value="{{$addressGroup->id}}">{{$addressGroup->name}}</option>
                                @endforeach
                            </select>
                            @error('address_group_id')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-10">
                            <label class="form-label required" for="csv_file">CSV File</label>
                            <input type="file" name="csv_file" id="csv_file" class="form-control @error('csv') is-invalid @enderror" accept=".csv" />
                            @error('csv')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa-solid fa-paper-plane"></i> Submit
                        </button>
                    </div>
                </div>
            </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">Instructions</div>
                </div>
                <div class="card-body">
                    <strong>Follow the instructions carefully before importing the file.</strong>
                    <p>The columns of the file should be in the following order.</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-rounded">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th>Column Number</th>
                                    <th>Column Name</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Company/Name <small class="text-muted">(required)</small></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Attention <small class="text-muted">(required)</small></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Address <small class="text-muted">(required)</small></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Apt./Suite <small class="text-muted">(option)</small></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Department <small class="text-muted">(option)</small></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>City <small class="text-muted">(required)</small></td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Country <small class="text-muted">(required)</small></td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>Province/State <small class="text-muted">(required)</small></td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>Postal Code <small class="text-muted">(required)</small></td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>Phone <small class="text-muted">(required)</small></td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>Ext <small class="text-muted">(option)</small></td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td>Email <small class="text-muted">(option)</small></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base-layout>
