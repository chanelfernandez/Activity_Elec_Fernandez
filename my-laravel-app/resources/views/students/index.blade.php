@extend ('layouts.app')
@section('content')

<div class="d-flex justify-content-between aligh-items-center mb-3">
  
    <h2>Student List</h2>

    <a href="{{route('student.create')}}" class="btn btn-primary">
        add student
    </a>
    </div>

    <div class="card">
        <div class="card-body">

            <table class="table table-bothered table-striped">
            <thread>
                <tr>
                    <th>Student Number</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Actions</th>
                </tr>
            </thread>

            <tbody>
                @forelse ($students as $student)
                    <tr>
                        <td> {{ $student->student_number}}</td>
                        <td> {{ $student->first_name}} {{$student->last_name }}</td>
                        <td> {{ $student->email}} </td>
                        <td> {{ $student->course}} </td>
                        
                    <td> 
                         <a href=" {{ route('students.show', $student) }}" class="btn btn-info btn-sm"> View </a>
                         <a href=" {{ route('students.edit', $student) }}" class="btn btn-warning btn-sm"> Edit </a>
                         <form action="{{ route('students.destroy', $students) }}"
                         method="POST"
                         class="id-inline"
                         onsubmit="return" 
                    confirm('Delete this student?')">
                            @crsf
                            @method
