<!DOCTYPE html>
<html>

<head>
    <title>Webinars List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    {{ view('admin.layouts.css') }}

</head>

<body>

    {{ view('admin.layouts.header') }}

    <div class="container mt-4">

        <h2>All Webinars</h2>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif


        <a href="{{ route('admin.createwebinar.create') }}" class="btn btn-primary mb-3">Create New Webinar</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Speakers</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($webinars as $webinar)
                <tr>
                    <td>{{ $webinar->title }}</td>
                    <td>{{ $webinar->speakers }}</td>
                    <td>{{ $webinar->date }}</td>
                    <td>{{ $webinar->time }}</td>
                    <td>{{ ucfirst($webinar->status) }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">

                            {{-- Edit Button --}}
                            <a href="{{ route('admin.createwebinar.edit', $webinar->id) }}" class="btn btn-warning rounded-2 px-3 py-3">
                                <i class="fa-solid fa-pen-to-square fa-lg"></i>
                            </a>

                            {{-- Delete Button --}}
                            <form action="{{ route('admin.createwebinar.destroy', $webinar->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this webinar?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger rounded-2 px-3 py-3">
                                    <i class="fa-solid fa-trash-can fa-lg"></i>
                                </button>
                            </form>

                        </div>


                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">No webinars found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ view('admin.layouts.footer') }}



</body>

</html>