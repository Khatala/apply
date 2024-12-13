<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Limkokwing Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* Custom styles */
        .add-faculty-section {
            text-align: right;
            margin-bottom: 20px;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: #343a40;
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

        .main-content {
            margin-top: 60px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .content-header {
            background-color: #007bff;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .content-header h1 {
            font-size: 1.5rem;
            margin: 0;
        }

        .table-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .table {
            width: 100%;
            margin-top: 15px;
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: #e9ecef;
        }

        .table td,
        .table th {
            vertical-align: middle;
            padding: 15px;
        }

        .alert-success {
            border-radius: 5px;
        }

        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: auto;
        }

        .btn {
            border-radius: 20px;
        }

        .btn-edit {
            background-color: #007bff;
            color: white;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .add-faculty-section {
            text-align: right;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">name</a>
        </div>
    </nav>

    <!-- Main Layout -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-3">
                <h5>Navigation</h5>
                <a href="#"><i class="bi bi-person"></i> Profile</a>
                <a href="{{ route('institutions.index') }}"><i class="bi bi-journal-text"></i> applications</a>
                <a href="{{ url('/404') }}"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </div>

            <div class="col-md-10">
                <div class="container main-content">

                    <!-- Add Faculty Button Section -->
                    <div class="add-faculty-section">

                        <a href="{{ route('faculties.create', $institution->id) }}" class="btn btn-dark mb-3"><i class="bi bi-plus-circle"></i>Add Faculty</a>
                    </div>

                    <h1>Welcome to the Dashboard, {{ $institution->name }}</h1>
                    <p>Code: {{ $institution->code }}</p>
                    <p>Email: {{ $institution->email }}</p>
                    @if($institution->image)
                    <img src="{{ asset('uploads/institutions/' . $institution->image) }}" alt="{{ $institution->name }}" width="200">
                    @endif
                    <!-- Content Header -->
                    <!-- Content Header -->
                    <div class="content-header d-flex justify-content-between align-items-center">
                        <h1 class="mb-0">Faculties for {{ $institution->name }}</h1>
                        <div class="d-flex align-items-center gap-3">
                            <!-- Search Icon with Input -->
                            <div class="input-group">
                                <input id="search-input" type="text" class="form-control form-control-sm" placeholder="Search faculty..." aria-label="Search faculties">
                                <button class="btn btn-dark btn-sm" type="button" onclick="searchTable()"><i class="bi bi-search"></i></button>
                            </div>

                            <!-- Notification Icon -->
                            <div class="position-relative">
                                <a href="{{ route('notifications') }}" class="text-decoration-none text-dark">
                                    <i class="bi bi-bell fs-4"></i>
                                    <!-- Notification Badge -->
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        3
                                        <span class="visually-hidden">unread notifications</span>
                                    </span>

                                </a>
                            </div>

                        </div>
                    </div>


                    <!-- Table Content -->
                    <div class="table-container">
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Faculty Code</th>
                                    <th>Sponsor Type</th>
                                    <th>Actions</th>
                                    <th>Courses</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($faculties as $faculty)
                                <tr>
                                    <td>{{ $faculty->name }}</td>
                                    <td>{{ $faculty->faculty_code }}</td>
                                    <td>{{ $faculty->sponsor_type }}</td>
                                    <td>

                                        <a href="{{ route('faculties.edit', ['institutionId' => $institution->id, 'id' => $faculty->id]) }}" class="btn btn-dark btn-sm">
                                            <i class="bi bi-pencil"></i> Edit</a>
                                        <form action="{{ route('faculties.destroy', ['institutionId' => $institution->id, 'id' => $faculty->id]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this faculty?');"><i class="bi bi-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                    <td><a href="{{ route('faculties.courses.index', ['institutionId' => $institution->id, 'facultyId' => $faculty->id]) }}" class="btn btn-dark mb-3">
                                            <i class="bi bi-book"></i> View Courses
                                        </a></td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Limkokwing Applications. All Rights Reserved.</p>
    </div>
</body>
<script>
    // JavaScript Function for Searching Table
    function searchTable() {
        const input = document.getElementById('search-input').value.toLowerCase();
        const table = document.querySelector('.table tbody');
        const rows = table.getElementsByTagName('tr');

        // Loop through each row
        for (let i = 0; i < rows.length; i++) {
            const columns = rows[i].getElementsByTagName('td');
            let match = false;

            // Loop through each column in the row
            for (let j = 0; j < columns.length; j++) {
                if (columns[j].textContent.toLowerCase().includes(input)) {
                    match = true;
                    break;
                }
            }

            // Show or hide rows based on match
            rows[i].style.display = match ? '' : 'none';
        }
    }
</script>

</html>