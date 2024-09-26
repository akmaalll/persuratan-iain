@foreach ($data as $key => $v)
    <tr class="text-start text-gray-600 fs-7">
        <td>
            <span class="fw-semibold">
                {{ ++$i }}
            </span>
        </td>
        <td class="pe-0">
            <span class="fw-semibold">
                {{ $v->code }}
            </span>
        </td>
        <td>
            <span class="fw-semibold">
                {{ $v->name }}
            </span>
        </td>

        <td class="text-end">
            {!! Helper::btnAction($v->id, $title) !!}
            {{-- <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
            <!--begin::Menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="1/edit" class="menu-link px-3">Edit</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3" data-kt-ecommerce-product-filter="delete_row">Delete</a>
                </div>
                <!--end::Menu item-->
            </div> --}}
            <!--end::Menu-->
        </td>
    </tr>
@endforeach
