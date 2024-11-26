@include('admin.partials.layouts.layoutTop')

<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">{{ isset($datas) ? 'Edit Students' : 'Add Students' }}</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('dashboard') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">{{ isset($datas) ? 'Edit Students' : 'Add Students' }}</li>
        </ul>
    </div>

    <div class="card h-100 p-0 radius-12">
        <div class="card-body p-24">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-8 col-lg-10">
                    <div class="card border">
                        <div class="card-body">
                            <form action="{{ isset($datas) ? route('student.update', $datas->id) : route('student.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($datas))
                                    @method('PUT') <!-- This ensures the form is treated as an update -->
                                @endif

                                <div class="mb-20">
                                    <label for="nim"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">NIM<span
                                            class="text-danger-600">*</span></label>
                                    <input type="number" class="form-control radius-8" id="nim" name="nim"
                                        value="{{ isset($datas) ? $datas->nim : '' }}" placeholder="input NIM...">
                                </div>

                                <div class="mb-20">
                                    <label for="email"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Email<span
                                            class="text-danger-600">*</span></label>
                                    <input type="email" class="form-control radius-8" id="email" name="email"
                                        value="{{ isset($datas) ? $datas->email : '' }}" placeholder="input Email...">
                                </div>

                                <div class="mb-20">
                                    <label for="name"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Name<span
                                            class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="name" name="name"
                                        value="{{ isset($datas) ? $datas->name : '' }}" placeholder="input Name...">
                                </div>

                                <div class="mb-20">
                                    <label for="phone"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Phone<span
                                            class="text-danger-600">*</span></label>
                                    <input type="number" class="form-control radius-8" id="phone" name="phone"
                                        value="{{ isset($datas) ? $datas->phone : '' }}"
                                        placeholder="input Phone...">
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
