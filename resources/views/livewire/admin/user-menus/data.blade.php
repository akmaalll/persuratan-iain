@foreach ($data as $key => $v)
    <tr>
        <td class="text-gray-600 fw-semibold">
            {{ ++$i }}
        </td>
        <td class="text-gray-600 fw-semibold">
            {{ $v->name }}
        </td>
        <td class="text-end">
            @if (Helper::countMenu($v->id) == null)
                <a href="{{ url('admin/' . $title . '/create/' . $v->id) }}" class="btn btn-sm fw-bold btn-primary">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                    Create Role
                </a>
            @else
                <a href="{{ url('admin/' . $title . '/' . $v->id . '/edit') }}" class="">
                    <button type="button" class="btn btn-icon btn-bg-secondary btn-active-color-primary btn-sm me-1">
                        <i class="ki-duotone ki-pencil fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </button>
                </a>
                <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{ $v->id }}" title="Delete"
                    class="deleteData">
                    <button type="button" class="btn btn-icon btn-bg-secondary btn-active-color-primary btn-sm">
                        <i class="ki-duotone ki-trash fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                        </i>
                    </button>
                </a>
                {{-- {!! Helper::btnAction($v->id, $title) !!} --}}
            @endif

        </td>
    </tr>
@endforeach
