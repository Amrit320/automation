<!DOCTYPE html>
<html>

<head>
    <title>Edit Webinar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    {{ view('admin.layouts.css') }}
</head>

<body>

    {{ view('admin.layouts.header') }}

    <div class="container mt-4 border p-4 shadow-sm bg-white rounded-2">
        <h2>Edit Webinar</h2>

        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.createwebinar.update', $webinar->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('admin.createwebinar.form')

            <button type="submit" class="btn btn-success">Update Webinar</button>
            <a href="{{ route('admin.createwebinar.index') }}" class="btn btn-secondary">Cancel</a>
        </form>

    </div>

    {{ view('admin.layouts.footer') }}
</body>

</html>