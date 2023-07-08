<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie  =edge">
    <title>Download PDF</title>
    <style>
        table, th, td {
        border: 1px solid;
        border-collapse: collapse;
        text-align: center;

        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped mt-3 table-bordered text-center">
                        <thead class="align-middle bg-black text-white">
                            <tr>
                                <th>No</th>
                                <th>Employee ID</th>
                                <th>Employee Code</th>
                                <th>Employee Name</th>
                                <th>NRC Number</th>
                                <th>Email Address</th>
                                <th>Gender</th>
                                <th>Date of Birth</th>
                                <th>Marital Status</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- {{ dd($employees)}} --}}
                            @foreach ($employees as $employee)
                                <form action="" method="">
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employee->employee_id }}</td>
                                        <td>{{ $employee->employee_code }}</td>
                                        <td>{{ $employee->employee_name }}</td>
                                        <td>{{ $employee->nrc_number }}</td>
                                        <td>{{ $employee->email_address }}</td>
                                        @if ( $employee->gender == 1)
                                        <td>Male</td>
                                        @else
                                        <td>Female</td>
                                        @endif
                                        <td>{{ $employee->date_of_birth }}</td>
                                        @if ($employee->marital_status == 1)
                                        <td>Single</td>
                                        @elseif ($employee->marital_status == 2)
                                        <td>Married</td>
                                        @elseif ($employee->marital_status == 3)
                                        <td>Divorce</td>
                                        @else
                                        <td> </td>
                                        @endif
                                        <td>{{ $employee->address }}</td>
                                    </tr>
                                </form>
                            @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
