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
        <div class="h4">Edit Students</div>
        <div>
            <a href="{{ route('students.index') }}" class="btn btn-primary">Back</a>
        

        </div>
    </div>


    <form action="{{ route('students.update' , $student->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    <div class="card border-0 shadow-lg">
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter your name"
                  class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$student->name) }}">
                  @error('name')
                  <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                  
                 </div>

                 <div class="mb-3">
                <label for="name" class="form-label">Email</label>
                <input type="text" name="email" id="email" placeholder="Enter your email"
                  class="form-control @error('name') is-invalid @enderror" value="{{ old('email' , $student->email) }}">
                  @error('email')
                  <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                 </div>

                 <div class="mb-3">
                <label for="name" class="form-label">Address</label>
                <textarea name="address" id="address" cols="30" rows="4"
                 placeholder="Enter Address" class="form-control">{{ old('address',$student->address) }}
                </textarea>
                 </div>

                 <div class="mb-3">
                <label for="name" class="form-label"></label>
                <input type="file" name="image" class=" @error('image') is-invalid @enderror">
                @error('image')
                  <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                  <div class="pt-3">
                    @if($student->image != '')
                        <img src="{{ route('students.image', $student->image) }}" alt=""
                        width="100" height="100">
                    @endif
                </div>


                </div>
            

        </div>

    </div>
    <button class="btn btn-primary my-3">Update Student</button>
    </form>

</div>
    
</body>
</html>