@extends('backend.layouts.app')
@section('title', 'Expense Categories')

@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<!-- SweetAlert2 CSS -->
<!-- Custom CSS -->
<style>
    #categoriesTable {
        font-size: 0.9rem; /* Adjust font size */
    }
    #categoriesTable th, #categoriesTable td {
        padding: 0.5rem; /* Adjust padding */
    }
    #categoriesTable thead th {
        background-color: #007bff;
        color: #ffffff;
        font-weight: bold;
    }
    #categoriesTable tbody tr {
        border-bottom: 1px solid #dee2e6;
    }
    #categoriesTable tbody tr:hover {
        background-color: #f1f1f1;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem; /* Adjust button size */
    }
</style>
@endsection

@section('content')
<div class="content-wrapper mt-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Expense Categories</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Expense Categories</li>
                </ol>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Expense Categories List</h3>
                <div class="card-tools">
                    <a href="{{ route('categories.create') }}" class="btn btn-success">Add Expense Category</a>
                </div>
            </div>
            <div class="card-body">
                <table id="categoriesTable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <form action="{{ route('categories.toggleStatus', $category->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="{{ $category->status ? 0 : 1 }}">
                                    <button type="submit" class="btn btn-sm {{ $category->status ? 'btn-success' : 'btn-secondary' }}">
                                        {{ $category->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<!-- SweetAlert2 JS -->
<script>
$(document).ready(function() {
    $('#categoriesTable').DataTable();

});
</script>
@endsection
