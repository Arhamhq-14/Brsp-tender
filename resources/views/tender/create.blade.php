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

            <form action="{{ route('tenders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Add New Tender</div>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group form-floating-label">
                                            <input name="title" id="inputFloatingLabel" value="{{ old('title') }}"
                                                type="text" class="form-control input-border-bottom" required>
                                            <label for="inputFloatingLabel" class="placeholder">Title</label>
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="inputFloatingLabel" class="placeholder">Description</label>
                                            <textarea class="summernote" name="description"></textarea>
                                        </div>

                                    </div>


                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group form-floating-label">
                                            <input name="reference_number" id="inputFloatingLabelref" value="{{ old('reference_number') }}"
                                                type="text" class="form-control input-border-bottom" required>
                                            <label for="inputFloatingLabelref" class="placeholder">Reference Number</label>
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group form-floating-label">
                                            <input id="inputFloatingLabeldat" type="date" value="{{ date('Y-m-d') }}"
                                                name="start_date" class="form-control input-border-bottom">
                                            <label for="inputFloatingLabeldat" class="placeholder">Start Date</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group form-floating-label">
                                            <input id="inputFloatingLabeldat" type="datetime-local"
                                                value="" name="end_date"
                                                class="form-control input-border-bottom">
                                            <label for="inputFloatingLabeldat" class="placeholder">End Date</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group form-group-default">
                                            <label>Project</label>
                                            <select class="form-control" id="formGroupDefaultSelect" name="project">
                                                @foreach ($project as $p)
                                                <option value="{{$p->uuid}}">{{$p->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                  

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group form-group-default">
                                            <label>Donor</label>
                                            <select class="form-control" id="formGroupDefaultSelect" name="donor">
                                                @foreach ($donor as $d)
                                                <option value="{{$d->uuid}}">{{$d->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group form-group-default">
                                            <label>Tender Type</label>
                                            <select class="form-control" id="formGroupDefaultSelect" name="type">
                                                <option value="Tender">Tender</option>
                                                <option value="Corrigendum">Corrigendum</option>
                                                <option value="Expression of Interest">Expression of Interest</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group form-group-default">
                                            <label>Type</label>
                                            <select class="form-control" id="formGroupDefaultSelect" name="t_type">
                                                <option value="Serivces">Serivces</option>
                                                <option value="Supplies">Supplies</option>
                                            </select>
                                        </div>
                                    </div>
                                   


                                    <div class="col-md-8 col-lg-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" name="document" class="custom-file-input" id="inputGroupFile01"
                                                aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                            
                                        </div>
                                        
                                    </div>
                                    <span class="text-danger">* Upload PDF File (One File Upto 10MB)</span>
                                    </div>






                                    <input  type="hidden" value="{{ date('Y-m-d') }}" name="posting_date">







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
        <script type="text/javascript">
            $.getScript('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js', function() {
                $('.summernote').summernote();
            });



                        document.querySelector('.custom-file-input').addEventListener('change', function (e) {
                var fileName = e.target.files[0].name;
                var label = e.target.nextElementSibling;
                label.textContent = fileName;
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
    @endpush
@endsection
