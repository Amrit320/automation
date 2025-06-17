<!DOCTYPE html>
<html>

<head>
    <title>User List</title>

    <!-- Bootstrap CSS (if not already in your layout) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    {{ view('admin.layouts.css') }}
</head>

<body>
    {{ view('admin.layouts.header') }}

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>User Submissions</h2>

            <!-- Import Button -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">
                Import Users
            </button>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table id="userTable" class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Invite Sent</th>
                    <th>Reminder Sent</th>
                    <th>Attendance</th>
                    <th>Last Updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->Invite_Sent ? 'Yes' : 'Not Yet' }}</td>

                    <td>{{ $user->reminder_sent ? 'Yes' : 'No' }}</td>
                    <td>{{ $user->attendance_status }}</td>
                    <td>{{ $user->last_updated }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.users.import') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Import Users</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="import_file" class="form-label">Select Excel or CSV file</label>
                            <input type="file" class="form-control" id="import_file" name="import_file" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Upload</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{ view('admin.layouts.footer') }}


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>