<!--begin::Action--->
<td class="text-center">
    <a href="{{ route('address-groups.addresses.edit', ['address_group' => $model->addressGroup, 'address' => $model]) }}" class="btn btn-sm btn-info btn-active-light-primary">
        Edit
    </a>
    <button data-destroy="{{ route('address-groups.addresses.destroy', ['address_group' => $model->addressGroup, 'address' => $model]) }}" class="btn btn-sm btn-danger btn-active-light-primary">
        Delete
    </button>
</td>
<!--end::Action--->
