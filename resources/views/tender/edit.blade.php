@extends('layouts.app')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Tender</h4>
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
                        <a href="{{ route('tenders.index') }}">Tenders</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Create Tender</a>
                    </li>
                </ul>
            </div>

            <form action="{{ route('tenders.update', $tender->uuid) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Edit Tender</div>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group form-floating-label">
                                            <input name="title" id="inputFloatingLabel" value="{{ $tender->title }}"
                                                type="text" class="form-control input-border-bottom" required>
                                            <label for="inputFloatingLabel" class="placeholder">Title</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="inputFloatingLabel" class="placeholder">Description</label>
                                            <textarea class="summernote" name="description">{{ $tender->description }}</textarea>
                                        </div>

                                    </div>


                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group form-floating-label">
                                            <input name="reference_number" id="inputFloatingLabelref"
                                                value="{{ $tender->reference_number }}" type="text"
                                                class="form-control input-border-bottom" required>
                                            <label for="inputFloatingLabelref" class="placeholder">Reference Number</label>
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group form-floating-label">
                                            <input id="inputFloatingLabeldat" type="date"
                                                value="{{ $tender->start_date }}" name="start_date"
                                                class="form-control input-border-bottom">
                                            <label for="inputFloatingLabeldat" class="placeholder">Start Date</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group form-floating-label">
                                            <input id="inputFloatingLabeldat" type="datetime-local"
                                                value="{{ $tender->end_date }}" name="end_date"
                                                class="form-control input-border-bottom">
                                            <label for="inputFloatingLabeldat" class="placeholder">End Date</label>
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group form-group-default">
                                            <label>Project</label>
                                            <select class="form-control" id="formGroupDefaultSelect" name="project">
                                                @foreach ($project as $p)
                                                <option value="{{$p->uuid}}" {{ $tender->project == $p->uuid ? 'selected' : ''  }}>{{$p->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                  

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group form-group-default">
                                            <label>Donor</label>
                                            <select class="form-control" id="formGroupDefaultSelect" name="donor">
                                                @foreach ($donor as $d)
                                                <option value="{{$d->uuid}}" {{ $tender->donor == $d->uuid ? 'selected' : ''  }}>{{$d->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group form-group-default">
                                            <label>Type</label>
                                            <select class="form-control" id="formGroupDefaultSelect" name="t_type">
                                                <option value="Serivces" {{ $tender->t_type == 'Serivces' ? 'selected' : '' }}>Serivces</option>
                                                <option value="Supplies" {{ $tender->t_type == 'Supplies' ? 'selected' : '' }}>Supplies</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group form-group-default">
                                            <label>Tender Type</label>
                                            <select class="form-control" id="formGroupDefaultSelect" name="type">
                                                <option value="Tender" {{ $tender->type == 'Tender' ? 'selected' : '' }}>
                                                    Tender</option>
                                                <option value="Corrigendum"
                                                    {{ $tender->type == 'Corrigendum' ? 'selected' : '' }}>Corrigendum
                                                </option>
                                                <option value="Expression of Interest"
                                                    {{ $tender->type == 'Expression of Interest' ? 'selected' : '' }}>
                                                    Expression of Interest</option>
                                            </select>
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group form-group-default">
                                            <label>Tender Status</label>
                                            <select class="form-control" id="formGroupDefaultSelect" name="status">
                                                <option value="0" {{ $tender->archived == 0 ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="1" {{ $tender->archived == 1 ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    

                                    <div class="col-md-8 col-lg-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                            </div>

                                            <div class="custom-file">
                                                <input type="file" name="document" class="custom-file-input"
                                                    id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label"
                                                    for="inputGroupFile01">{{ $tender->document ? basename($tender->document) : 'Choose file' }}</label>
                                            </div>

                                        </div>
                                    </div>


                                    <div>
                                        <button class="btn btn-success">Submit</button>
                                    </div>
            </form>
        </div>
        @if ($tender->document)
            <form action="{{ route('tenders.destroy', $tender->uuid) }}" method="POST">
                @csrf
                @method('DELETE')
                <span id="existing-file" class="text-danger">
                    {{ basename($tender->document) }}
                    <button type="submit" id="remove-file" aria-label="Remove file"
                        style="background:none; border:none; color:red; cursor:pointer;">
                        &times;
                    </button>
                </span>
            </form>
        @else
            <span class="text-danger">* Upload PDF File</span>
        @endif
    </div>




    </div>
    </div>
    </div>






    </div>
    </div>
    @push('scripts')
        <script type="text/javascript">
            $.getScript('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js', function() {
                $('.summernote').summernote();
            });



            document.querySelector('.custom-file-input').addEventListener('change', function(e) {
                var fileName = e.target.files[0].name;
                var label = e.target.nextElementSibling;
                label.textContent = fileName;
            });

            document.getElementById('remove-file').addEventListener('click', function() {
                if (confirm('Are you sure you want to delete this file?')) {
                    document.getElementById('delete-file-form').submit();
                }
            });
        </script>
        @if (count($errors) > 0)
            <script>
                $(document).ready(function() {
                    var placementFrom = $('#notify_placement_from option:selected').val();
                    var placementAlign = $('#notify_placement_align option:selected').val();
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
