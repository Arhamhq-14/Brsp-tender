@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Setting</h4>
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
                        <a href="{{ route('settings.index') }}">Settings</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Create Setting</a>
                    </li>
                </ul>
            </div>

            <form action="{{ route('settings.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Add New Setting</div>
                            </div>
                            <div class="card-body">
                                <div class="row">


                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group form-group-default">
                                            <label>Type</label>
                                            <select class="form-control" id="formGroupDefaultSelect" name="type">
                                                <option value="1">Project</option>
                                                <option value="2">Donor</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group form-floating-label">
                                            <input name="title" id="inputFloatingLabel" value="{{ old('title') }}"
                                                type="text" class="form-control input-border-bottom" required style="text-transform: uppercase;">
                                            <label for="inputFloatingLabel" class="placeholder">Title</label>
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
