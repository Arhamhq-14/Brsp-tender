@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Tenders</h4>
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
                        <a href="{{ route('tender.archive') }}">Archived Tenders</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('tenders.create') }}">Create Tender</a>
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
                                            <th>Ref No</th>
                                            <th>Title</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>

                                        <tr>
                                            <th>Ref No</th>
                                            <th>Title</th>
                                            <th>Action</th>
                                        </tr>

                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            @foreach ($tenders as $tender)
                                                <td>{{ $tender->reference_number }}</td>
                                                 <td>{!! $tender->description !!}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{route('tenders.show', $tender->uuid)}}" class="far fa-eye text-info fa-lg mx-2"></a>
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








                {{-- @foreach ($tenders as $tender)
                    <aside class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-uppercase">{{ $tender->title }}</h2>
                                <p class="card-text">{!! $tender->description !!}</p>
                                <p class="card-text">
                                    <strong style="color: #007bff;">Reference Number:</strong> 
                                    <span style="color: #28a745;">{{ $tender->reference_number }}</span>
                                </p>
                                <a href="{{route('tenders.edit', $tender->uuid)}}" class="far fa-edit fa-lg mx-2"></a>

                                <a href="{{route('tenders.show', $tender->uuid)}}" class="far fa-eye text-info fa-lg mx-2"></a>

                                <form method="POST" action="{{ route('tenders.destroy', $tender->uuid) }}"
                                    style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-link" disabled>
                                        <i class="far fa-trash-alt text-danger fa-lg mx-2"></i>
                                    </button>
                                </form>
                                @if ($tender->document != null)
                                    <a href="{{ route('tender.download', $tender->uuid) }}"
                                        class="fas fa-download text-primary fa-lg mx-2"></a>
                                @endif
                            </div>
                        </div> <!-- card.// -->
                    </aside>
                @endforeach --}}

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
