<!--begin::Aside-->
<div
	id="kt_aside"
	class="aside"
	data-kt-drawer="true"
	data-kt-drawer-name="aside"
	data-kt-drawer-activate="{default: true, lg: false}"
	data-kt-drawer-overlay="true"
	data-kt-drawer-width="{default:'200px', '300px': '250px'}"
	data-kt-drawer-direction="start"
	data-kt-drawer-toggle="#kt_aside_mobile_toggle"
	>
    <!--begin::Aside menu-->
	<div class="aside-menu flex-column-fluid">
		{{ theme()->getView('layout/aside/_menu') }}
    </div>
    <!--end::Aside menu-->
</div>
<!--end::Aside-->
