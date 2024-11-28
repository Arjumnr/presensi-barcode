@include('admin.partials.layouts.layoutTop')

<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">{{ isset($datas) ? 'Edit Time Table' : 'Add Time Table' }}</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('dashboard') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">{{ isset($datas) ? 'Edit Time Table' : 'Add Time Table' }}</li>
        </ul>
    </div>

    <div class="card h-100 p-0 radius-12">
        <div class="card-body p-24">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-8 col-lg-10">
                    <div class="card border">
                        <div class="card-body">
                            <form
                                action="{{ isset($datas) ? route('time-table.update', $datas->id) : route('time-table.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($datas))
                                    @method('PUT') <!-- This ensures the form is treated as an update -->
                                @endif

                                <div class="mb-20">
                                    <label for="matkul"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Mata Kuliah<span
                                            class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="matkul" name="matkul"
                                        value="{{ isset($datas) ? $datas->matkul : '' }}" placeholder="input Mata Kuliah...">
                                </div>

                                <div class="mb-20">
                                    <label for="date_session"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Tanggal Pelaksanaan<span
                                            class="text-danger-600">*</span></label>
                                    <input type="date" class="form-control radius-8" id="date_session" name="date_session"
                                        value="{{ isset($datas) ? $datas->date_session : '' }}" placeholder="input Tanggal Pelaksanaan...">
                                </div>

                                <div class="mb-20">
                                    <label for="start_time"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Waktu Mulai<span
                                            class="text-danger-600">*</span></label>
                                    <input type="time" class="form-control radius-8" id="start_time" name="start_time"
                                        value="{{ isset($datas) ? $datas->start_time : '' }}" placeholder="input Waktu Mulai...">
                                </div>

                                <div class="mb-20">
                                    <label for="end_time"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Waktu Selesai<span
                                            class="text-danger-600">*</span></label>
                                    <input type="time" class="form-control radius-8" id="end_time" name="end_time"
                                        value="{{ isset($datas) ? $datas->end_time : '' }}" placeholder="input Waktu Selesai...">
                                </div>

                                <div class="d-flex align-items-center justify-content-center gap-3">
                                    <a href="{{ route('user.list') }}"
                                        class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8">Cancel</a>
                                    <button type="submit"
                                        class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                                        {{ isset($datas) ? 'Update' : 'Save' }}
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        
    </script>
@endpush

@include('admin.partials.layouts.layoutBottom')
