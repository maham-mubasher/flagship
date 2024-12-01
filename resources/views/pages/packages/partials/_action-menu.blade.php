<!--begin::Action--->
<td class="text-center">
    <a href="{{ route('packages.edit', $model) }}" class="btn btn-sm btn-info btn-active-light-primary">
        <i class="fa-solid fa-edit"></i> Edit
    </a>
    <button data-destroy="{{ route('packages.destroy', $model) }}" class="btn btn-sm btn-danger btn-active-light-primary">
        <i class="fa-solid fa-trash"></i> Delete
    </button>
</td>
<!--end::Action--->
