<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Limkokwing Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #e9ecef;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar-custom {
            background-color: #007bff;
            color: white;
        }
        .navbar-custom .navbar-brand {
            color: white;
            font-weight: bold;
            letter-spacing: 0.05rem;
        }
        .btn-dark, .btn-danger {
            border-radius: 30px;
            padding: 5px 15px;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 5px; /* Spacing between icon and text */
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .table td {
            vertical-align: middle;
            padding: 15px;
        }
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            border-radius: 5px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.05rem;
        }
        .card {
            border-radius: 10px;
        }
        .image-thumbnail {
            border-radius: 50%;
            border: 2px solid #007bff;
        }
        .btn {
            border-radius: 30px;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: auto; /* Ensures footer stays at the bottom */
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: #ffffff;
            padding: 20px;
        }
        .sidebar h5 {
            color: #ffffff;
            margin-bottom: 20px;
        }
        .sidebar a {
            color: #ffffff;
            padding: 12px 15px;
            display: block;
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 10px;
            transition: background-color 0.3s ease;
            border-radius: 8px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .navbar-dark .navbar-brand {
            color: #ffffff;
        }
        .card-header {
            background-color: #007bff;
        }
        .card-body {
            background-color: #ffffff;
        }
        /* Hover effect for buttons */
        .btn-dark:hover {
            background-color: #343a40;
            color: white;
        }
        .btn-danger:hover {
            background-color: #dc3545;
        }
        .btn-actions {
            display: flex;
            justify-content: center;
            gap: 10px; /* Adds spacing between buttons */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Limkokwing Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Applications</a>
                    </li>
                    <li class="nav-item">
                    <a href="{{ url('/404') }}" class="nav-link">Logout</a>

                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Layout -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-3">
                <h5>Navigation</h5>
                <a href="#"><i class="bi bi-person"></i> Profile</a>
                <a href="#"><i class="bi bi-journal-text"></i> Institutions</a>
                <a href="{{ url('/404') }}">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
            <!-- Main Content -->
            <div class="col-md-10">
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-10 d-flex justify-content-end">
                            <a href="{{ route('institutions.create') }}" class="btn btn-dark mb-3"><i class="bi bi-plus-circle"></i> Add</a>
                        </div>
                    </div>

                    <!-- Success Alert -->
                    <div class="row justify-content-center">
                        @if (Session::has('success'))
                        <div class="col-md-10 mt-4">
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Table -->
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-10">
                            <div class="card border-0 shadow-lg my-4">
                                <div class="card-header text-center">
                                    <h3>Institutions</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Profile Picture</th>
                                                <th>Institution Name</th>
                                                <th>Email</th>
                                                <th>Created at</th>
                                                <th>Action</th>
                                                <th>Faculties</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($institutions->isNotEmpty())
                                            @foreach ($institutions as $institution)
                                            <tr>
                                                <td>{{ $institution->id }}</td>
                                                <td>
                                                    @if ($institution->image != "")
                                                        <img class="image-thumbnail" width="50" src="{{ asset('uploads/institutions/'.$institution->image) }}" alt="Profile Picture">
                                                    @endif
                                                </td>
                                                <td>{{ $institution->name }}</td>
                                                <td>{{ $institution->email }}</td>
                                                <td>{{ \Carbon\Carbon::parse($institution->created_at)->format('d M, Y') }}</td>
                                                <td class="btn-actions">
                                                    <a href="{{ route('institutions.edit', $institution->id) }}" class="btn btn-dark btn-sm">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>
                                                    <a href="#" onclick="deleteProduct({{ $institution->id }});" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </a>
                                                    <form id="delete-institution-form-{{ $institution->id }}" action="{{ route('institutions.destroy', $institution->id) }}" method="post" style="display: none;">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </td>
                                                <td>
                                                    <a href="{{ route('faculties.index', $institution->id) }}" class="btn btn-dark mb-3"><i class="bi bi-box-arrow-right"></i>View</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Limkokwing Applications. All Rights Reserved.</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+cbjaQEvYgz3hYQ7PzcI0yZG0y7hD" crossorigin="anonymous"></script>

    <script>
        function deleteProduct(id) {
            event.preventDefault();
            if (confirm('Are you sure you want to delete this product?')) {
                document.getElementById('delete-institution-form-' + id).submit();
            }
        }
    </script>
</body>
</html>
