@include('admin.partials.layouts.layoutTop')

<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Company</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Settings - Company</li>
        </ul>
    </div>

    <div class="card h-100 p-0 radius-12 overflow-hidden">
        <div class="card-body p-40">
            <form action="{{ route('setting.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-md-12 d-flex justify-content-center ">
                        <div class="card h-100 p-0">
                            <div class="card-header border-bottom bg-base py-16 px-24">
                                <h6 class="text-lg fw-semibold mb-0">Logo Organisasi</h6>
                            </div>
                            <div class="card-body p-24">
                                <div class="upload-image-wrapper d-flex align-items-center gap-3 flex-wrap">
                                    <div class="uploaded-imgs-container d-flex gap-3 flex-wrap">
                                        @if (isset($settings->logo_setup) && $settings->logo_setup)
                                            <div
                                                class="position-relative h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50">
                                                <img src="{{ asset('storage/uploads/setting/' . $settings->logo_setup) }}" alt="Logo" class="w-100 h-100 object-fit-cover">

                                            </div>
                                        @else
                                            <div
                                                class="position-relative h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50">
                                                <span class="text-secondary-light">No Logo</span>
                                            </div>
                                        @endif
                                    </div>

                                    <label
                                        class="logo h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1"
                                        for="logo">
                                        <iconify-icon icon="solar:camera-outline"
                                            class="text-xl text-secondary-light"></iconify-icon>
                                        <span class="fw-semibold text-secondary-light">Upload</span>
                                        <input id="logo" name="logo" type="file" hidden>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="mb-20">
                            <label for="nama_organisasi"
                                class="form-label fw-semibold text-primary-light text-sm mb-8">Nama Organisasi <span
                                    class="text-danger-600">*</span></label>
                            <input type="text" class="form-control radius-8" id="nama_organisasi"
                                name="nama_organisasi" placeholder="Enter Nama Organisasi"
                                value="{{ old('nama_organisasi', $settings->name_setup ?? '') }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="mb-20">
                            <label for="facebook"
                                class="form-label fw-semibold text-primary-light text-sm mb-8">Facebook</label>
                            <input type="url" class="form-control radius-8" id="facebook" name="facebook"
                                placeholder="facebook URL" value="{{ old('facebook', $settings->fb ?? '') }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="mb-20">
                            <label for="instagram"
                                class="form-label fw-semibold text-primary-light text-sm mb-8">Instagram</label>
                            <input type="url" class="form-control radius-8" id="instagram" name="instagram"
                                placeholder="instagram URL" value="{{ old('instagram', $settings->ig ?? '') }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="mb-20">
                            <label for="youtube"
                                class="form-label fw-semibold text-primary-light text-sm mb-8">YouTube</label>
                            <input type="url" class="form-control radius-8" id="youtube" name="youtube"
                                placeholder="youtube URL" value="{{ old('youtube', $settings->yt ?? '') }}">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="mb-20">
                            <label for="alamat" class="form-label fw-semibold text-primary-light text-sm mb-8">Alamat
                                <span class="text-danger-600">*</span></label>
                            <input type="text" class="form-control radius-8" id="alamat" name="alamat"
                                placeholder="Enter Your alamat" value="{{ old('alamat', $settings->address ?? '') }}">
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-center gap-3 mt-24">
                        <button type="reset"
                            class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-40 py-11 radius-8">Reset</button>
                        <button type="submit"
                            class="btn btn-primary border border-primary-600 text-md px-24 py-12 radius-8">Save
                            Change</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@push('scripts')
    <script>
        // ================================================ Upload Single image js Start here ================================================
        const fileInput = document.getElementById("logo");
        const uploadedImgsContainer = document.querySelector(".uploaded-imgs-container");

        if (fileInput && uploadedImgsContainer) {
            fileInput.addEventListener("change", (e) => {
                // Clear previous image if exists
                uploadedImgsContainer.innerHTML = "";

                const file = e.target.files[0];
                if (file) {
                    const src = URL.createObjectURL(file);

                    const imgContainer = document.createElement("div");
                    imgContainer.classList.add("position-relative", "h-120-px", "w-120-px", "border",
                        "input-form-light", "radius-8", "overflow-hidden", "border-dashed",
                        "bg-neutral-50");

                    const removeButton = document.createElement("button");
                    removeButton.type = "button";
                    removeButton.classList.add("uploaded-img__remove", "position-absolute", "top-0",
                        "end-0",
                        "z-1", "text-2xxl", "line-height-1", "me-8", "mt-8", "d-flex");
                    removeButton.innerHTML =
                        "<iconify-icon icon='radix-icons:cross-2' class='text-xl text-danger-600'></iconify-icon>";

                    const imagePreview = document.createElement("img");
                    imagePreview.classList.add("w-100", "h-100", "object-fit-cover");
                    imagePreview.src = src;

                    imgContainer.appendChild(removeButton);
                    imgContainer.appendChild(imagePreview);
                    uploadedImgsContainer.appendChild(imgContainer);

                    removeButton.addEventListener("click", () => {
                        URL.revokeObjectURL(src);
                        imgContainer.remove();
                        fileInput.value = ""; // Clear the input after removing the image
                    });
                }
            });
        }
        // ================================================ Upload Single image js End here  ================================================
    </script>
@endpush

@include('admin.partials.layouts.layoutBottom')
