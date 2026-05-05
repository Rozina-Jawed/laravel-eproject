@extends('admin.layout')
@section('admin')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <form action="{{ url('admin/patients/' . $patient->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Patient</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="patient_name" value="{{ $patient->patient_name }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Age</label>
                            <input type="number" name="patient_age" value="{{ $patient->patient_age }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ $patient->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $patient->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="/admin/patients" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection