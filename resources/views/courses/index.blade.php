<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Limkokwing my school</title>
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
            <a class="navbar-brand" href="#">Limkokwing Admin</a>
        </div>
    </nav>

    <!-- Main Layout -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-3">
                <h5>Navigation</h5>
                <a href="#"><i class="bi bi-person"></i> Profile</a>
                <a href="{{ route('institutions.index') }}"><i class="bi bi-journal-text"></i> Institutions</a>
                <a href="#"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </div>

            <div class="col-md-10">
                <div class="container main-content">
                    <!-- Add Faculty Button Section -->
                    <h1>Courses for {{ $faculty->name ?? 'Faculty' }}</h1>

                    <div class="add-course-section text-end mb-3">
                    <a href="{{ route('courses.create', ['institution_id' => $institution->id, 'faculty_id' => $faculty->id]) }}"  class="btn btn-dark mb-3">
                    <i class="bi bi-plus-circle"></i>Create Course</a>

                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Course Name</th>
                                <th>Level</th>
                                <th>Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($courses) && $courses->isNotEmpty())
                                @foreach($courses as $course)
                                    <tr>
                                        <td>{{ $course->id }}</td>
                                        <td>{{ $course->name }}</td>
                                        <td>{{ $course->level }}</td>
                                        <td>{{ $course->duration }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">No courses available.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Limkokwing Applications. All Rights Reserved.</p>
    </div>
</body>

</html>