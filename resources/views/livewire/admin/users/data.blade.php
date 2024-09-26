@foreach ($data as $key => $v)
    <tr class="text-start text-gray-600 fs-7">
        <td>
            <span class="fw-semibold">
                {{ ++$i }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->name }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->username }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->role->name }}
            </span>
        </td>
        <td class="text-end">
            {!! Helper::btnAction($v->id, $title) !!}
        </td>
    </tr>
@endforeach
