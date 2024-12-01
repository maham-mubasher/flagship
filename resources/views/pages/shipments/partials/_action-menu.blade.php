<!--begin::Action--->
<td class="text-center">
    <a href="{{ route('shipments.edit', $model) }}" class="btn btn-sm btn-info btn-active-light-primary">
        Edit
    </a>
    <button data-destroy="{{ route('shipments.destroy', $model) }}" class="btn btn-sm btn-danger btn-active-light-primary">
        Delete
    </button>
</td>
<!--end::Action--->
