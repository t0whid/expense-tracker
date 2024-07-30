@extends('backend.layouts.app')
@section('title', 'Expenses')

@section('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<style>
    #expensesTable {
        font-size: 0.9rem; /* Adjust font size */
    }
    #expensesTable th, #expensesTable td {
        padding: 0.5rem; /* Adjust padding */
    }
    #expensesTable thead th {
        background-color: #007bff;
        color: #ffffff;
        font-weight: bold;
    }
    #expensesTable tbody tr {
        border-bottom: 1px solid #dee2e6;
    }
    #expensesTable tbody tr:hover {
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
                <h1>Expenses</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Expenses</li>
                </ol>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Expenses List</h3>
                <div class="card-tools">
                    <a href="{{ route('expenses.create') }}" class="btn btn-success">Add New Expense</a>
                </div>
            </div>
            <div class="card-body">
                <table id="expensesTable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $expense)
                        <tr>
                            <td>{{ $expense->id }}</td>
                            <td>{{ $expense->name }}</td>
                            <td>{{ $expense->amount }}</td>
                            <td>{{ $expense->category->name }}</td>
                            <td>{{ $expense->date ? $expense->date->format('d-m-Y') : 'N/A' }}</td>
                            <td>{{ $expense->expense_by }}</td>
                            <td>
                                <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="d-inline delete-form">
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
    $('#expensesTable').DataTable();

});
</script>
@endsection
