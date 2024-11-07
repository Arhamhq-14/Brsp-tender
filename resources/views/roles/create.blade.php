{{-- @extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Role</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
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


<form action="{{ route('roles.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permission:</strong>
                <br/>
                
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
            <h4 class="page-title">User Roles</h4>
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
                    <a href="{{route('roles.index')}}">User</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Create Users</a>
                </li>
            </ul>
        </div>

        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Add New Role</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group form-floating-label">
                                    <input name="name" id="inputFloatingLabel" value="{{ old('name') }}" type="text" class="form-control input-border-bottom" required>
                                    <label for="inputFloatingLabel" class="placeholder">Name</label>
                                </div>
                            </div>
                            

                            <div class="col-md-6 col-lg-4">
                                <label for="selectFloatingLabel" class="placeholder">Permissions</label>
                                <div class="form-group form-floating-label input-border-bottom" id="selectFloatingLabel" required>
                                    
                                    @foreach($permission as $value)
                                        <label>
                                            <input type="checkbox" name="permission[]" value="{{ $value->uuid }}" class="name">
                                            {{ $value->name }}
                                        </label>
                                        <br/>
                                    @endforeach
                                    
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
            var placementAlign = 'right';
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