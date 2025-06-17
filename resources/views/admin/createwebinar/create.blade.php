<!DOCTYPE html>
<html>

<head>
    <title>Create Webinar</title>

    <!-- Bootstrap CSS (if not already in your layout) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    {{ view('admin.layouts.css') }}
</head>

<body>
    {{ view('admin.layouts.header') }}

    <div class="container mt-4 border p-4 shadow-sm bg-white rounded-2">
        <h2>Create New Webinar</h2>

        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.createwebinar.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('admin.createwebinar.form')

            <button type="submit" class="btn btn-success">Create Webinar</button>
            <a href="{{ route('admin.createwebinar.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    {{ view('admin.layouts.footer') }}


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>