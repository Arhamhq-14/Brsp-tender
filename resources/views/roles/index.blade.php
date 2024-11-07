{{-- @extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Role Management</h2>
        </div>
        <div class="pull-right">
        @can('role-create')
            <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
            @endcan
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


<table class="table table-bordered">
  <tr>
     <th>No</th>
     <th>Name</th>
     <th width="280px">Action</th>
  </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('roles.show',$role->uuid) }}">Show</a>
            
                <a class="btn btn-primary" href="{{ route('roles.edit',$role->uuid) }}">Edit</a>
            @endcan
           
            <form method="POST" action="{{  }}" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        @endcan
        
        </td>
    </tr>
    @endforeach
</table>


{!! $roles->render() !!}



@endsection --}}






@extends('layouts.app')


@section('content')

    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Role Management</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ route('home') }}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}">Roles</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('roles.create')}}">Create Role</a>
                    </li>
                </ul>
            </div>
       
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>

                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>

                                    </tfoot>
                                    <tbody>
                                        <tr>
                                           
                                            @foreach ($roles as $key => $role)
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                    <div class="form-button-action">

                                                        <a class="d-flex align-items-center"
                                                            href="{{ route('roles.show',$role->uuid) }}"
                                                            data-toggle="tooltip" title="Show User">
                                                            <i class="fa fa-eye mr-2"></i>
                                                        </a>
                                                        @can('role-edit')
                                                        <a class="d-flex align-items-center"
                                                            href="{{ route('roles.edit',$role->uuid) }}"
                                                            data-toggle="tooltip" title="Show User">
                                                            <i class="fa fa-edit mr-2"></i>
                                                        </a>
                                                        @endcan
                                                        @can('role-delete')
                                                        <form method="POST"
                                                            action="{{ route('roles.destroy', $role->uuid) }}"
                                                            style="display:inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" data-toggle="tooltip" title=""
                                                                class="btn btn-link btn-danger"
                                                                data-original-title="Remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    @push('scripts')
        @if ($message = Session::get('success'))
            <script>
                $(document).ready(function() {
                    var placementFrom = 'top';
                    var placementAlign = 'right';
                    var state = 'success';
                    var style = 'withicon';
                    var content = {};

                    content.title = 'Success';
                    content.message = ''; 
                    content.message += `{{ $message }}`;

                    if (style == "withicon") {
                        content.icon = 'fa fa-exclamation-triangle'; // Change the icon as per your need
                    } else {
                        content.icon = 'none';
                    }

                    $.notify(content, {
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
