<form action="{{ $url }}" method="get" onsubmit="showLoader()">
    <div class="row mb-1 justify-content-end ">
        <div class="col-10 my-auto p-0">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend ">
                    <span class="input-group-text text-dark">From</span>
                </div>
                <input type="date" name="start" id="start" class="form-control"
                    value="{{ request()->get('start') ?? date('Y-m-d', strtotime('first day of this month', time())) }}">
                <div class="input-group-append ">
                    <span class="input-group-text text-dark">To</span>
                </div>
                <input type="date" name="end" id="end" class="form-control"
                    value="{{ request()->get('end') ?? date('Y-m-d', strtotime('last day of this month', time())) }}">
            </div>
            <input type="hidden" name="status" value="{{ request()->get('status') }}">
        </div>
        <div class="col-2 my-auto">
            <button type="submit" class="btn btn-success btn-sm">
                <span style="font-size: 20px;" class="mdi mdi-magnify"></span>
            </button>
        </div>
    </div>
</form>
