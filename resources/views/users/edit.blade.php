{{-- @extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit New User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif


<form action="{{ route('users.update', $user->uuid) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name"  class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="email" name="email"  class="form-control" placeholder="Email">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Confirm Password:</strong>
                <input type="password" name="confirm-password" class="form-control" placeholder="Confirm Password">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
               
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection --}}

@extends('layouts.app')
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">User</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{route('home')}}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{route('users.index')}}">User</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Create Users</a>
                </li>
            </ul>
        </div>

        <form action="{{ route('users.update', $user->uuid) }}" method="POST">
            @csrf
            @method('PATCH')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Update User Record</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group form-floating-label">
                                    <input name="name" id="inputFloatingLabel" value="{{ old('name', $user->name) }}" type="text" class="form-control input-border-bottom" required>
                                    <label for="inputFloatingLabel" class="placeholder">Name</label>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group form-floating-label">
                                    <input id="inputFloatingLabel" type="email" name="email" class="form-control input-border-bottom" value="{{ old('email', $user->email) }}" required>
                                    <label for="inputFloatingLabel" class="placeholder">Email</label>
                                </div>
                            </div>


                            <div class="col-md-6 col-lg-4">
                                <div class="form-group form-floating-label">
                                    <input id="inputFloatingLabel" type="password" name="password" class="form-control input-border-bottom" >
                                    <label for="inputFloatingLabel" class="placeholder">Password</label>
                                </div>
                            </div>


                            <div class="col-md-6 col-lg-4">
                                <div class="form-group form-floating-label">
                                    <input id="inputFloatingLabel" type="password" name="confirm-password" class="form-control input-border-bottom" >
                                    <label for="inputFloatingLabel" class="placeholder">Confirm Password</label>
                                </div>
                            </div>

                            
                            

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group form-floating-label">
                                    <select name="roles[]" class="form-control input-border-bottom" id="selectFloatingLabel" required>
                                        @foreach($roles as $role)
                                            <option value="{{ $role }}" {{ in_array($role, $userRole) ? 'selected' : '' }}>{{ $role }}</option>
                                        @endforeach
                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Select Role</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button class="btn btn-success">Submit</button>
                    </div>


                   
                </div>
            </div>
        </div>
        </form>


       
    </div>
</div>
@push('scripts')
@if (count($errors) > 0)
    <script>
        $(document).ready(function() {
            var placementFrom = 'top';
            var placementAlign = 'right'
            var state = 'danger';
            var style = 'withicon';
            var content = {};

            content.title = 'Whoops! There were some problems with your input.';
            content.message = `<ul>`;
            @foreach ($errors->all() as $error)
                content.message += `<li>{{ $error }}</li>`;
            @endforeach
            content.message += `</ul>`;

            if (style == "withicon") {
                content.icon = 'fa fa-exclamation-triangle'; // Change the icon as per your need
            } else {
                content.icon = 'none';
            }

            $.notify(content,{
                type: state,
                placement: {
                    from: placementFrom,
                    align: placementAlign
                },
                delay: 5000,
                timer: 1000,
                allow_dismiss: true,
                z_index: 9999,
            });
        });


      
    </script>
@endif

@endpush
@endsection