<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud-laravel</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
</head>
<body>

<div class= "bg-dark py-3">
    <div class="container">
        <div class="h4 text-white">Laravel Crud</div>
    </div>
</div> 

<div class="container ">
    <div class="d-flex justify-content-between py-3">
        <div class="h4">Students</div>
        <div>
            <a href="{{ route('students.create') }}" class="btn btn-primary">Create</a>
        

        </div>
    </div>

@if(Session::has('success'))
<div class= "alert alert-success">
    {{ Session::get('success') }}
</div>

@endif



    <div class="card border-0 shadow-lg">
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>


                @if($students->isNotEmpty())
                @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>
                       @if($student->image != '')
                        <img src="{{ route('students.image', $student->image) }}" alt=""
                        width="50" height="50" class="rounded-circle">
                    @else
                        <img src="{{ url('uploads/students/no-image.png') }}" alt=""
                        width="50" height="50" class="rounded-circle">
                    @endif
                    </td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->address }}</td>
                    <td>
                        <a href="{{ url('/students/'.$student->id.'/edit') }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="#" onclick="deleteStudent({{ $student->id }})"  class="btn btn-danger btn-sm">Delete</a>
                    
                    <form id="student-action-{{ $student->id }}" action="{{ route('students.destroy',$student->id)}}"  method="post">
                        @csrf
                        @method('delete')

                    </form>
                    
                    
                    </td>
                </tr>
                @endforeach

                @else
                <tr>
                    <td colspan="6">Record Not Found</td>
                </tr>

                @endif


            </table>

        </div>

    </div>

    <div class="mt-3 mb-3">
        {{$students->links()}};
    </div>

</div>


    
</body>
</html>

<script>

    function deleteStudent(id){
        if(confirm("Are you sure you want to delete?")){
            document.getElementById('student-action-'+id).submit();

        }
    }

    </script>