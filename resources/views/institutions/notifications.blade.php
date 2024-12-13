<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Limkokwing Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

        .table-container {
            overflow-x: auto;
            max-width: 100%;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background-color: #007bff;
            color: #fff;
            text-align: left;
        }

        .table th,
        .table td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .table th {
            font-weight: bold;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            display: inline-block;
            padding: 6px 12px;
            text-decoration: none;
            font-size: 14px;
            border-radius: 4px;
            margin: 0 5px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }

        .btn-danger:hover {
            background-color: #a71d2a;
        }

        a {
            color: inherit;
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
            width: 85%;
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

        .active {
            background-color: #495057;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">institution</a>
        </div>
    </nav>

    <!-- Main Layout -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-3">
                <div class="position-relative d-inline-block">
                    <!-- Profile Picture -->
                    @if ($institution->image != "")
                    <img class="border rounded-circle p-1 mb-3" width="150" height="150" src="{{ asset('uploads/institutions/'.$institution->image) }}" alt="Profile Picture">
                    @else
                    <img class="border rounded-circle p-1 mb-3" width="150" height="150" src="path_to_default_image.jpg" alt="Default Profile Picture">
                    @endif

                    <!-- Camera Icon (Positioned on the edge of the profile picture) -->
                    <label for="profileImageInput"
                        class="position-absolute"
                        style="
               bottom: 12px; /* Adjust for intersection */
               right: 15px; /* Adjust for intersection */
               background-color: #007bff; 
               color: #fff; 
               border-radius: 50%; 
               width: 40px; 
               height: 40px; 
               display: flex; 
               align-items: center; 
               justify-content: center; 
               cursor: pointer; 
               box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
                        <a href="{{ route('institutions.edit', $institution->id) }}"> <i class="fas fa-camera"></i></a>
                    </label>

                </div>

                <h3>{{ $institution->name }}</h3>
                <a href="#"><i class="bi bi-person"></i> Profile</a>
                <a href="{{ route('faculties.log', ['institution_id' => $institution->id]) }}"><i class="bi bi-journal-text"></i> Faculties</a>
                <a href="{{ url('/404') }}"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </div>

            <div class="col-md-10">
                <div class="container main-content">


                    <!-- Content Header -->
                    <!-- Content Header -->
                    <div class="content-header d-flex justify-content-between align-items-center">
                        <h1 class="mb-0">Applicants for {{ $institution->name }}</h1>
                        <div class="d-flex align-items-center gap-3">
                            <!-- Search Icon with Input -->
                            <div class="input-group">
                                <input id="search-input" type="text" class="form-control form-control-sm" placeholder="Search..." aria-label="Search faculties">
                                <button class="btn btn-dark btn-sm" type="button" onclick="searchTable()"><i class="bi bi-search"></i></button>
                            </div>

                            <!-- Notification Icon -->
                            <div class="position-relative">
                                <a href="{{ route('institutions.notifications', $institution->id) }}" class="text-decoration-none text-dark">
                                    <i class="bi bi-bell fs-4"></i>

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


                        <div class="table-container">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Names</th>
                                        <th>Address</th>
                                        <th>Gender</th>
                                        <th>Course</th>
                                        <th>District</th>
                                        <th>Date of Birth</th>
                                        <th>Email</th>
                                        <th>Results</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($products->isNotEmpty())
                                    @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->first_name }} {{ $product->last_name }}</td>
                                        <td>{{ $product->address }}</td>
                                        <td>{{ $product->gender }}</td>
                                        <td>{{ $product->course_name }}</td>
                                        <td>{{ $product->district }}</td>
                                        <td>{{ \Carbon\Carbon::parse($product->dob)->format('d M, Y') }}</td>
                                        <td>{{ $product->email }}</td>
                                        <td>
                                            @if ($product->results)
                                            <a href="{{ asset('uploads/results/' . $product->results) }}" target="_blank">View Results</a>
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</td>
                                        <td>
                                            <a href="#" onclick="admitProduct({{ $product->id }});" class="btn btn-primary btn-sm">
                                                <i class="bi bi-check-circle"></i> Admit
                                            </a>
                                            <form id="admit-product-form-{{ $product->id }}" action="{{ route('products.admit', $product->id) }}" method="post" style="display: none;">
                                                @csrf
                                            </form>

                                            <a href="#" onclick="deleteProduct({{ $product->id }});" class="btn btn-danger btn-sm">
                                                <i class="bi bi-person-x"></i> Reject
                                            </a>
                                            <form id="delete-product-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="post" style="display: none;">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="14">No applications available.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
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
</body>
<script>
    function deleteProduct(productId) {
        const form = document.getElementById(`delete-product-form-${productId}`);
        if (confirm("Are you sure you want to reject this student?")) {
            form.submit();
        }
    }

    function admitProduct(productId) {
        const form = document.getElementById(`admit-product-form-${productId}`);
        if (confirm("Are you sure you want to admit this student?")) {
            form.submit();
        }
    }
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