<x-base-layout>

    @if(session()->has('success'))
        <div class="row">
            <div class="col-md-12">
                <!--begin::Alert-->
                <div class="alert bg-light-success d-flex flex-column flex-sm-row p-5 mb-10">
                    <!--begin::Icon-->
                    <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
                    <!--end::Icon-->

                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <!--begin::Content-->
                        <span>Your message was successfully sent to {{config('app.name')}} customer service.</span>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Alert-->
            </div>
        </div>
    @endif

    @include('pages.partials.shipment_quick_links')

    @foreach($errors->all() as $error) {{$error}} @endforeach
    <form method="post" action="{{route('shipments.store')}}">
        @csrf
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="mb-5">
                <x-card>
                    <x-slot name="title" class="gap-2">
                        Shipment Summary Report (By Period)
                    </x-slot>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="period_select_date">Date</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <select id="period_select_date" name="period[select_date]" class="form-control">
                                <option value="">Date ...</option>
                                <option value="today">Today</option>
                                <option value="yesterday">Yesterday</option>
                                <option value="lastweek">Last week</option>
                                <option value="last2weeks">Last 2 weeks</option>
                                <option value="lastmonth">Last month</option>
                                <option value="last2months">Last 2 months</option>
                                <option value="last3months">Last 3 months</option>
                                <option value="lastyear">Last year</option>
                                <option value="allpastdates">All past dates</option>
                                <option value="allfuturedates">All future dates</option>
                                <option value="specificdate">Specific date</option>
                                <option value="daterange">Date Range</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-9 col-12 form-check">
                            <input type="checkbox" class="form-check-input" id="exclude_manuals" name="exclude_manuals" value="1">
                            <label class="form-label" for="exclude_manuals"> Exclude Manual Shipments</label>
                        </div>
                        <div class="col-md-3 col-12">
                            <button class="btn btn-primary pull-right mobile-float-left" type="submit"><i class="fa fa-download"></i> Download </button>

                        </div>

                    </div>
                    
                </x-card>
                </div>

                <div class="mb-5">
                <x-card>
                    <x-slot name="title" class="gap-2">
                        Shipment Summary Report (By Invoice)
                    </x-slot>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="period_select_date">For Invoice:</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <select id="period_select_date" name="period[select_date]" class="form-control">
                                <option value="">Select an Invoice</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-9 col-12 form-check">
                            <input type="checkbox" class="form-check-input" id="exclude_manuals" name="exclude_manuals" value="1">
                            <label class="form-label" for="exclude_manuals"> Exclude Manual Shipments</label>
                        </div>
                        <div class="col-md-3 col-12">
                            <button class="btn btn-primary pull-right mobile-float-left" type="submit"><i class="fa fa-download"></i> Download </button>

                        </div>

                    </div>
                    
                </x-card>
                </div>

                <div class="mb-5">
                <x-card>
                    <x-slot name="title" class="gap-2">
                        Shipment Summary Report (By reference)
                    </x-slot>

                    <div class="row mb-3">
                        <div class="col-md-3 col-12">
                            <label class="form-label required" for="reference">Reference</label>
                        </div>

                        <div class="col-md-9 col-12">
                            <input type="text" id="reference" name="reference" placeholder="" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-9 col-12 form-check">
                            <input type="checkbox" class="form-check-input" id="exclude_manuals" name="exclude_manuals" value="1">
                            <label class="form-label" for="exclude_manuals"> Exclude Manual Shipments</label>
                        </div>
                        <div class="col-md-3 col-12">
                            <button class="btn btn-primary pull-right mobile-float-left" type="submit"><i class="fa fa-download"></i> Download </button>

                        </div>

                    </div>
                    
                </x-card>
                </div>
            </div>
        </div>

       
       
    </form>

  
    @section('scripts')
       
    @endsection
</x-base-layout>
