@extends('admin._layouts.index')

{{-- @push('Data Master')
    here show
@endpush --}}

@push($title)
    active
@endpush

@section('content')
    <!--begin::Toolbar-->
    @component('admin._card.breadcrumb')
        @slot('header')
            {{ $title }}
        @endslot
        @slot('page')
            Form
        @endslot
    @endcomponent
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">

            <!--begin::Tables Widget 10-->
            <div class="card mb-5 mb-xl-8">

                <!--begin::Header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Form {{ isset($status) ? 'Edit' : 'Input' }}</span>
                    </h3>
                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div class="card-body pt-3">

                    <div class="row mt-5">
                        <!--begin:Form-->
                        <form id="kt_modal_new_target_form" class="form" action="#">
                            <input name="status" type="hidden" id="methodId" value="{{ $status ?? '' }}">

                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <div class="col-md-6 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Level User</span>
                                    </label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true" data-placeholder="Select a Roles" name="id_role"
                                        id="id_role">
                                        <option value="">Select user...</option>
                                        @foreach (Helper::getData('roles') as $v)
                                            <option {{ isset($id) && $id == $v->id ? 'selected' : '' }}
                                                value="{{ $v->id }}">{{ $v->name }}
                                                {{ $v->role->nama ?? null }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md-12 fv-row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive-lg">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" width="8%">No</th>
                                                        <th>Menu</th>
                                                        <th>Read</th>
                                                        <th>Create</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                        {{-- <th>Report</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; ?>
                                                    @foreach (Helper::getData('menus') as $v1)
                                                        @if ($v1->parent == 0)
                                                            <tr bgcolor="#f0f8ff">
                                                                <td>{{ $no++ }}
                                                                    <input type="hidden" value="{{ $v1->id }}">
                                                                </td>
                                                                <td>{{ $v1->name }}</td>
                                                                <td colspan="6">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" class="i-grey-square"
                                                                                name="read{{ $v1->id }}"
                                                                                id="read{{ $v1->id }}" />
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @foreach (Helper::getData('menus')->where('parent', $v1->id) as $v2)
                                                                <tr>
                                                                    <td>{{ $no++ }}
                                                                        <input type="hidden" value="{{ $v2->id }}">
                                                                    </td>
                                                                    <td>{{ $v2->name }}</td>
                                                                    <td width="9%">
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" class="i-grey-square"
                                                                                    name="read{{ $v2->id }}"
                                                                                    id="read{{ $v2->id }}">
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td width="9%">
                                                                        <div class="checkbox"
                                                                            style="margin-bottom: 0px; margin-top: 0px">
                                                                            <label>
                                                                                <input type="checkbox" class="i-grey-square"
                                                                                    name="create{{ $v2->id }}"
                                                                                    id="create{{ $v2->id }}">
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td width="9%">
                                                                        <div class="checkbox"
                                                                            style="margin-bottom: 0px; margin-top: 0px">
                                                                            <label>
                                                                                <input type="checkbox" class="i-grey-square"
                                                                                    name="edit{{ $v2->id }}"
                                                                                    id="edit{{ $v2->id }}">
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td width="9%">
                                                                        <div class="checkbox"
                                                                            style="margin-bottom: 0px; margin-top: 0px">
                                                                            <label>
                                                                                <input type="checkbox" class="i-grey-square"
                                                                                    name="delete{{ $v2->id }}"
                                                                                    id="delete{{ $v2->id }}">
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    {{-- <td width="9%">
                                                                        <div class="checkbox"
                                                                            style="margin-bottom: 0px; margin-top: 0px">
                                                                            <label>
                                                                                <input type="checkbox" class="i-grey-square"
                                                                                    name="report{{ $v2->id }}"
                                                                                    id="report{{ $v2->id }}">
                                                                            </label>
                                                                        </div>
                                                                    </td> --}}
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--end::Input group-->

                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <a href="{{ route($title . '.index') }}">
                                    <button type="button" id="kt_modal_new_target_cancel" class="btn btn-light me-3"
                                        data-bs-dismiss="modal">Batal</button>
                                </a>
                                <button type="submit" id="kt_modal_new_target_save" class="btn btn-primary">
                                    @if (isset($status) && $status == 'edit')
                                        <span class="indicator-label">Update</span>
                                    @else
                                        <span class="indicator-label">Simpan</span>
                                    @endif
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                            <!--end::Actions-->

                        </form>
                        <!--end:Form-->
                    </div>

                </div>
                <!--begin::Body-->
            </div>
            <!--end::Tables Widget 10-->

        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection

@push('jsScriptForm')
    <script type="text/javascript">
        const editUser = () => {
            $.ajax({
                url: '{{ url("admin/$title/$id/show") }}',
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    let um = JSON.parse(data.usermenu);
                    for (var i = 0; i < um.length; i++) {
                        if (um[i]['read'] === '1') {
                            $('#read' + um[i]['id_menu']).attr("checked", "checked");
                        } else {
                            $('#read' + um[i]['id_menu']).removeAttr("checked", "checked");
                        }
                        if (um[i]['create'] === '1') {
                            $('#create' + um[i]['id_menu']).attr("checked", "checked");
                        } else {
                            $('#create' + um[i]['id_menu']).removeAttr("checked", "checked");
                        }
                        if (um[i]['edit'] === '1') {
                            $('#edit' + um[i]['id_menu']).attr("checked", "checked");
                        } else {
                            $('#edit' + um[i]['id_menu']).removeAttr("checked", "checked");
                        }
                        if (um[i]['delete'] === '1') {
                            $('#delete' + um[i]['id_menu']).attr("checked", "checked");
                        } else {
                            $('#delete' + um[i]['id_menu']).removeAttr("checked", "checked");
                        }
                        if (um[i]['report'] === '1') {
                            $('#report' + um[i]['id_menu']).attr("checked", "checked");
                        } else {
                            $('#report' + um[i]['id_menu']).removeAttr("checked", "checked");
                        }
                    }
                    $('#formId').val(data.id);
                    $('#id_role').val(data.id).trigger('change');
                    return
                },
                error: function() {}
            });
        }

        $(document).ready(function() {
            var idx = $('#methodId').val();

            if (idx == 'edit') {
                editUser()
                return
            }

        });

        // Define form element
        const form = document.getElementById('kt_modal_new_target_form');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    'name': {
                        validators: {
                            notEmpty: {
                                message: 'Nama is required'
                            }
                        }
                    },
                    'code': {
                        validators: {
                            notEmpty: {
                                message: 'Kode is required'
                            }
                        }
                    },
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                },

            }
        );

        $(form.querySelector('[name="id_role"]')).on('change', function() {
            validator.revalidateField('id_role');
            var id = this.value
            var url = '{{ url("admin") }}/' + '{{ $title }}/' +  id + '/show';
            $.ajax({
                url: url,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    let um = JSON.parse(data.usermenu);
                    for (var i = 0; i < um.length; i++) {
                        if (um[i]['read'] === '1') {
                            $('#read' + um[i]['id_menu']).attr("checked", "checked");
                        } else {
                            $('#read' + um[i]['id_menu']).removeAttr("checked", "checked");
                        }
                        if (um[i]['create'] === '1') {
                            $('#create' + um[i]['id_menu']).attr("checked", "checked");
                        } else {
                            $('#create' + um[i]['id_menu']).removeAttr("checked", "checked");
                        }
                        if (um[i]['edit'] === '1') {
                            $('#edit' + um[i]['id_menu']).attr("checked", "checked");
                        } else {
                            $('#edit' + um[i]['id_menu']).removeAttr("checked", "checked");
                        }
                        if (um[i]['delete'] === '1') {
                            $('#delete' + um[i]['id_menu']).attr("checked", "checked");
                        } else {
                            $('#delete' + um[i]['id_menu']).removeAttr("checked", "checked");
                        }
                        if (um[i]['report'] === '1') {
                            $('#report' + um[i]['id_menu']).attr("checked", "checked");
                        } else {
                            $('#report' + um[i]['id_menu']).removeAttr("checked", "checked");
                        }
                    }
                    $('#formId').val(data.id);
                    return
                },
                error: function() {}
            });
        });
    </script>


    @include('admin._card._createAjax')
@endpush
