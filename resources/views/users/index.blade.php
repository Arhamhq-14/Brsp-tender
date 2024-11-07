@extends('layouts.app')


@section('content')


    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">User</h4>
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
                        <a href="{{ route('users.index') }}">User</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('users.create')}}">Create Users</a>
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
                                            <th>Email</th>
                                            <th>Roles</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>

                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Roles</th>
                                            <th>Action</th>
                                        </tr>

                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            @foreach ($data as $key => $user)
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if (!empty($user->getRoleNames()))
                                                        @foreach ($user->getRoleNames() as $v)
                                                            <label>{{ $v }}</label>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                        @can('user-list')
                                                        <a class="d-flex align-items-center"
                                                            href="{{ route('users.show', $user->uuid) }}"
                                                            data-toggle="tooltip" title="Show User">
                                                            <i class="fa fa-eye mr-2"></i>
                                                        </a>
                                                        @endcan

                                                        @can('user-edit')
                                                        <a class="d-flex align-items-center"
                                                            href="{{ route('users.edit', $user->uuid) }}"
                                                            data-toggle="tooltip" title="Show User">
                                                            <i class="fa fa-edit mr-2"></i>
                                                        </a>
                                                        @endcan

                                                        @can('user-delete')
                                                        <form method="POST"
                                                            action="{{ route('users.destroy', $user->uuid) }}"
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
