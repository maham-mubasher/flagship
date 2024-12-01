<!--begin::Action--->
<td class="text-center">
    <a href="{{ route('products.edit', $model) }}" class="btn btn-sm btn-info btn-active-light-primary">
        Edit
    </a>
    <button data-destroy="{{ route('products.destroy', $model) }}" class="btn btn-sm btn-danger btn-active-light-primary">
        Delete
    </button>
</td>
<!--end::Action--->
