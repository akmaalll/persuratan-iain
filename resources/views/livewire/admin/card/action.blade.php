<div class="card-header align-items-center py-5 gap-2 gap-md-5">
    <!--begin::Card title-->
    <div class="card-title">
        <div class="mw-100px me-3">
            <select class="form-select form-select-solid me-3" data-control="select2" data-hide-search="true"
                data-placeholder="Per Page" id="perPage">
                <option>5</option>
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
        </div>
        <div class="d-flex">
            <input id="input_search" type="text" class="form-control form-control-solid w-250px me-3"
                placeholder="Search">

            <button id="button_search" class="btn btn-secondary me-3">
                <span class="btn-label">
                    <i class="fa fa-search"></i>
                </span>
            </button>

            <button id="button_refresh" class="btn btn-secondary">
                <span class="btn-label">
                    <i class="fa fa-sync"></i>
                </span>
            </button>
        </div>
    </div>
    <!--end::Card title-->

    <!--begin::Card toolbar-->
    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
        <a wire:click="create()" class="btn btn-success">
            <span class="btn-label">
                <i class="fa fa-plus"></i>
            </span>
            Add New
        </a>
    </div>

    <!--end::Card toolbar-->
</div>
