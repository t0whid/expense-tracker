@extends('backend.layouts.app')
@section('title', 'Incomes')

@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<style>
    #incomesTable {
        font-size: 0.9rem; /* Adjust font size */
    }
    #incomesTable th, #incomesTable td {
        padding: 0.5rem; /* Adjust padding */
    }
    #incomesTable thead th {
        background-color: #007bff;
        color: #ffffff;
        font-weight: bold;
    }
    #incomesTable tbody tr {
        border-bottom: 1px solid #dee2e6;
    }
    #incomesTable tbody tr:hover {
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
                <h1>Incomes</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Incomes</li>
                </ol>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Incomes List</h3>
                <div class="card-tools">
                    <a href="{{ route('incomes.create') }}" class="btn btn-success">Add New Income</a>
                </div>
            </div>
            <div class="card-body">
                <table id="incomesTable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($incomes as $income)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $income->title }}</td>
                            <td>{{ $income->amount }}</td>
                            <td>{{ $income->category->name }}</td>
                            <td>{{ $income->date ? $income->date->format('d-m-Y') : 'N/A' }}</td>
                            <td>
                                <a href="{{ route('incomes.edit', $income->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <form action="{{ route('incomes.destroy', $income->id) }}" method="POST" class="d-inline delete-form">
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
<script>
$(document).ready(function() {
    $('#incomesTable').DataTable();
});
</script>
@endsection
