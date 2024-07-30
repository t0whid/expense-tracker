@extends('backend.layouts.app')
@section('title', 'Edit Expense')

@section('styles')

@endsection

@section('content')
    <div class="content-wrapper mt-3">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10">
                        <!-- General form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Expense</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- Form start -->
                            <form method="POST" action="{{ route('expenses.update', $expense->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $expense->name) }}" placeholder="Enter Expense Name" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="amount">Amount <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ old('amount', $expense->amount) }}" placeholder="Enter Amount" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="category_id">Category <span class="text-danger">*</span></label>
                                        <select class="form-control" id="category_id" name="category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == old('category_id', $expense->category_id) ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="note">Note <small class="text-muted">(optional)</small></label>
                                        <textarea class="form-control" id="note" name="note" placeholder="Enter Note">{{ old('note', $expense->note) }}</textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="date">Date <small class="text-muted">(optional)</small></label>
                                        <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $expense->date ? $expense->date->format('Y-m-d') : '') }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="expense_by">Expense By <small class="text-muted">(optional)</small></label>
                                        <input type="text" class="form-control" id="expense_by" name="expense_by" value="{{ old('expense_by', $expense->expense_by) }}" placeholder="Enter Name">
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')

@endsection
