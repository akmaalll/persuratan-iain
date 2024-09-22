@foreach ($data as $key => $v)
    <tr class="text-start text-gray-600 fs-7">
        <td>
            <span class="fw-semibold">
                {{ ++$i }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->parent }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->name }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->icon }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->url }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->index }}
            </span>
        </td>
        <td class="text-muted fw-semibold">
            {{ $v->sub_parent }}
        </td>
        <td class="text-end">
            {!! Helper::btnAction($v->id, $title) !!}
        </td>
    </tr>
@endforeach
