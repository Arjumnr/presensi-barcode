@include('admin.partials.layouts.layoutTop')
{{-- @php
dd ($user);
@endphp --}}
<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">{{ isset($user) ? 'Edit user' : 'Add user' }}</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('dashboard') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">{{ isset($user) ? 'Edit user' : 'Add user' }}</li>
        </ul>
    </div>

    <div class="card h-100 p-0 radius-12">
        <div class="card-body p-24">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-8 col-lg-10">
                    <div class="card border">
                        <div class="card-body">
                            <form action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($user))
                                    @method('PUT') <!-- This ensures the form is treated as an update -->
                                @endif

                                <div class="mb-20">
                                    <label for="nim"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">NIM<span
                                            class="text-danger-600">*</span></label>
                                    <input type="number" class="form-control radius-8" id="nim" name="nim"
                                        value="{{ isset($user) ? $user->nim : '' }}" placeholder="input NIM...">
                                </div>

                                <div class="mb-20">
                                    <label for="name"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Name<span
                                            class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="name" name="name"
                                        value="{{ isset($user) ? $user->name : '' }}" placeholder="input Name...">
                                </div>

                                <div class="mb-20">
                                    <label for="username"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Username<span
                                            class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="username" name="username"
                                        value="{{ isset($user) ? $user->username : '' }}"
                                        placeholder="input Username...">
                                </div>


                                <div class="mb-20">
                                    <label for="status"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Status<span
                                            class="text-danger-600">*</span></label>
                                    <select name="status" id="status" class="form-select radius-8">
                                        <option value="1"
                                            {{ isset($user) && $user->status == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0"
                                            {{ isset($user) && $user->status == '0' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-20">
                                    <label for="password"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Password<span
                                            class="text-danger-600">*</span></label>
                                    <div class="position-relative">
                                        <div class="icon-field">
                                            <input type="password" name="password"
                                                class="form-control h-56-px bg-neutral-50 radius-12" id="your-password"
                                                placeholder="input Password..." {{ !isset($user) ? 'required' : '' }}>
                                        </div>
                                        <span
                                            class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light"
                                            data-toggle="#your-password"></span>
                                    </div>
                                    <span class="mt-12 text-sm text-secondary-light">Your password must have at least 8
                                        characters</span>
                                </div>

                                <div class="d-flex align-items-center justify-content-center gap-3">
                                    <a href="{{ route('user.list') }}"
                                        class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8">Cancel</a>
                                    <button type="submit"
                                        class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                                        {{ isset($user) ? 'Update' : 'Save' }}
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
        const fileInput = document.getElementById("gambar");
        const uploadedImgsContainer = document.querySelector(".uploaded-imgs-container");

        if (fileInput && uploadedImgsContainer) {
            fileInput.addEventListener("change", (e) => {
                uploadedImgsContainer.innerHTML = "";

                const file = e.target.files[0];
                if (file) {
                    const src = URL.createObjectURL(file);
                    const imgContainer = document.createElement("div");
                    imgContainer.classList.add("position-relative", "h-120-px", "w-120-px", "border",
                        "input-form-light", "radius-8", "overflow-hidden", "border-dashed", "bg-neutral-50");

                    const removeButton = document.createElement("button");
                    removeButton.type = "button";
                    removeButton.classList.add("uploaded-img__remove", "position-absolute", "top-0", "end-0", "z-1",
                        "text-2xxl", "line-height-1", "me-8", "mt-8", "d-flex");
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
                        fileInput.value = "";
                    });
                }
            });
        }


        //password
        function initializePasswordToggle(toggleSelector) {
            $(toggleSelector).on('click', function() {
                $(this).toggleClass("ri-eye-off-line");
                var input = $($(this).attr("data-toggle"));
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        }
        // Call the function
        initializePasswordToggle('.toggle-password');
    </script>
@endpush

@include('admin.partials.layouts.layoutBottom')
