<!--begin::Action--->
<td class="text-center">
    <a href="{{ route('address-groups.addresses.index', ['address_group' => $model->id]) }}" class="btn btn-sm btn-primary btn-active-light-primary">
        Addresses
    </a>
    <button data-action="{{ route('address-groups.edit', $model->id) }}" class="btn btn-sm btn-info btn-active-light-primary ajax-modal">
        Edit
    </button>
    <button data-destroy="{{ route('address-groups.destroy', $model->id) }}" class="btn btn-sm btn-danger btn-active-light-primary">
        Delete
    </button>
</td>
<!--end::Action--->
