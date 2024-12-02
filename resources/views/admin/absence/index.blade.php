@include('admin.partials.layouts.layoutTop')

<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0"> Table Students</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium"> Table Students</li>
        </ul>
    </div>

    <div class="card basic-data-table">
        <div class="card-header">
            <h5 class="card-title mb-0"> Datatables</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered mb-0" id="dataTable" data-page-length="10">
                <thead>
                    <tr>
                        <th scope="col">
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input" type="checkbox" id="selectAll">
                                <label class="form-check-label" for="selectAll">
                                    NO
                                </label>
                            </div>
                        </th>
                        <th scope="col">NIM</th>
                        <th scope="col">NAMA</th>
                        <th scope="col">MATAKULIAH</th>
                        <th scope="col">WAKTU</th>
                        <th scope="col">DOSEN</th>
                        <th scope="col">ABSEN </th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($datas as $data)
                        <tr>
                            <td>
                                <div class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input" type="checkbox" id=user{{ $data->id }}">
                                    <label class="form-check-label"
                                        for="event{{ $data->id }}">{{ $loop->iteration }}</label>
                                </div>
                            </td>
                            <td><a href="javascript:void(0)" class="text-primary-600">{{ $data->user->nim }}</a></td>
                            <td><a href="javascript:void(0)" class="text-black-600">{{ $data->user->name }}</a></td>
                            <td><a href="javascript:void(0)" class="text-black-600">{{ $data->timetable->matkul }}</a>
                            <td><a href="javascript:void(0)" class="text-black-600">{{ $data->timetable->start_time }} - {{ $data->timetable->end_time }}</a>
                            </td>
                            <td><a href="javascript:void(0)" class="text-black-600">Andi Adhe Amalya</a></td>
                            <td class="text-warning-600">
                                {{ \Carbon\Carbon::parse($data->scanned_at)->format('H:i:s | d M Y ') ?? '-' }}
                            </td>
                            </td>
                            <td>

                                <a href="{{ route('student.edit', $data->id) }}"
                                    class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                    title="Edit">
                                    <iconify-icon icon="lucide:edit"></iconify-icon>
                                </a>
                                <!-- Delete Icon - Confirm Before Deleting -->
                                <a href="javascript:void(0)"
                                    class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                    onclick="confirmDelete({{ $data->id }})" title="Delete">
                                    <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>


        </div>
    </div>
</div>

@push('scripts')
    <script script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        let table = new DataTable("#dataTable");

        //delete
        function confirmDelete(userId) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the AJAX delete request
                    $.ajax({
                        url: '/admin/student/destroy/' + userId, // URL of the delete route
                        type: 'POST', // Using the POST method (because we are submitting a form with method spoofing)
                        data: {
                            _method: 'DELETE', // This is the method spoofing for DELETE
                            _token: '{{ csrf_token() }}' // CSRF token for security
                        },
                        success: function(response) {
                            // If successful, show the success message and remove the event from the DOM
                            Swal.fire({
                                title: "Deleted!",
                                text: "User has been deleted.",
                                icon: "success"
                            }).then((result) => {
                                location.reload();

                            })

                            // Optionally, you can remove the event from the page without reload
                            $('#event-' + eventId).remove(); // Adjust this selector as needed
                        },
                        error: function(xhr, status, error) {
                            // Handle any error (e.g., event not found, server issue)
                            Swal.fire({
                                title: "Error!",
                                text: "There was an issue deleting the event.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        }
    </script>
@endpush

@include('admin.partials.layouts.layoutBottom')
