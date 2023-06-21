@extends('layouts.app')

@section('title')
Employee Registration System
@endsection

@section('nav')
@endsection

@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="">Employee List</h3>
                        </div>
                    </div>


                    <form action="{{ route('search-and-download')}}" method="GET">
                        <div class="row mt-3">
                            <div class="col-md-2">
                                <span class="text-muted" id="">Employee ID</span>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <span class="text-muted" id="">Employee Code</span>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2">
                                <span class="text-muted" id="">Employee Name</span>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <span class="text-muted" id="">Email</span>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12 d-flex justify-content-evenly align-items-center">
                                <button type="submit" class="btn btn-primary btn-sm">Search</button>
                                <button type="submit" name="download" class="btn btn-primary btn-sm" value="true">PDF Download</button>
                                <button type="submit" name="download" class="btn btn-primary btn-sm" value="true">Excel Download</button>
                                {{-- <span class="float-end">Total Count : <span class="fw-bold">{{ $counts }}</span></span> --}}

                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped mt-3 table-bordered text-center">
                                <thead class="bg-black text-white">
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Employee ID</th>
                                        <th rowspan="2">Employee Code</th>
                                        <th rowspan="2">Employee Name</th>
                                        <th rowspan="2">Email</th>
                                        <th colspan="4">Action</th>
                                    </tr>
                                    <tr>
                                        <th>Edit</th>
                                        <th>Detail</th>
                                        <th>Active</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $employee)
                                    <form action="{{ route('employees.destroy',$employee->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <tr>
                                            <td>{{ $employee->id }}</td>
                                            <td>{{ $employee->employee_id }}</td>
                                            <td>{{ $employee->employee_code }}</td>
                                            <td>{{ $employee->employee_name }}</td>
                                            <td>{{ $employee->email_address }}</td>
                                            <td>
                                                <a href="{{ route('employees.edit',$employee->id) }}"><i class="fa-solid text-success fa-pen-to-square"></i></a>
                                            </td>
                                            <td>
                                                <a href="{{ route('employees.show',$employee->id) }}"><i class="fa-solid text-info fa-circle-info"></i></a>
                                            </td>
                                            <td>
                                                <a href="{{ route('employees.show',$employee->id)}}" class="btn btn-outline-secondary btn-sm" >Active</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('employees.destroy',$employee->id) }}"><i class="fa-solid text-danger fa-trash"></i></a>
                                            </td>

                                        </tr>
                                    </form>

                                @endforeach



                                </tbody>
                            </table>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-end">
                                {{ $employees->links() }}

                            </div>
                            {{-- ->appends(['keyword' => $search]) --}}
                        </div>
                    </div>



                </div>

            </div>
        </div>
    </div>
</div>
@endsection
