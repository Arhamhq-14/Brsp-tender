@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Roles</h4>
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
                        <a href="{{ route('roles.create') }}">Create Role</a>
                    </li>
                </ul>
            </div>

            <form action="{{ route('roles.update', $role->uuid) }}" method="POST">
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
                                            <input name="name" id="inputFloatingLabel"
                                                value="{{ old('name', $role->name) }}" type="text"
                                                class="form-control input-border-bottom" required>
                                            <label for="inputFloatingLabel" class="placeholder">Name</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <label for="selectFloatingLabel" class="placeholder">Permissions</label>
                                        <div class="form-group form-floating-label input-border-bottom"
                                            id="selectFloatingLabel" required>

                                            @foreach ($permission as $value)
                                                <label>
                                                    <input type="checkbox" name="permission[]" value="{{ $value->uuid }}"
                                                        class="name"
                                                        {{ in_array($value->uuid, $rolePermissions) ? 'checked' : '' }}>
                                                    {{ $value->name }}
                                                </label>
                                                <br />
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
