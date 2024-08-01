@extends('backend.layouts.app')
@section('title', 'Add New Income')

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
                                <h3 class="card-title">Add New Income</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- Form start -->
                            <form method="POST" action="{{ route('incomes.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Income Title" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="amount">Amount <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" class="form-control" id="amount" name="amount" placeholder="Enter Amount" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="income_category_id">Category <span class="text-danger">*</span></label>
                                        <select class="form-control" id="income_category_id" name="income_category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="note">Note <small class="text-muted">(optional)</small></label>
                                        <textarea class="form-control" id="note" name="note" placeholder="Enter Note"></textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="date">Date <small class="text-muted">(optional)</small></label>
                                        <input type="date" class="form-control" id="date" name="date">
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
