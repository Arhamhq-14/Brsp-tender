
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
                        <a href="{{ route('tenders.index') }}">Active Tenders</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('tenders.create')}}">Create Tender</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <aside class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-uppercase">{{ $tender->title }}</h2>
                            <p class="card-text">{!! $tender->description !!}</p>
                            <p class="card-text">
                                <strong style="color:  blue">Reference Number: </strong> 
                                <span style="color:  blue">{{ $tender->reference_number }}</span>
                            </p>
                            <p class="card-text">
                                <strong style="color: blue;">Tender Type:</strong> 
                                    <span style="color: blue;">{{ $tender->t_type }}</span>
                                </p>
                            <p class="card-text">
                                <strong style="color: blue">Created By: </strong> 
                                <span style="color:  blue">{{$tender->user->name}}</span>
                            </p>

                            <div>
                                <span style="display: flex; gap: 20px;">
                                    <p style="color: blue"><strong>Project:</strong>  
                                        {{ $tender->projects->title}}
                                    </p>
                                    <p style="color:  blue"><strong>Donor:</strong> 
                                        {{ $tender->donors->title }}
                                    </p>
                                   
                                </span>
                                
                            </div>


                            <div>
                                <span style="display: flex; gap: 20px;">
                                    <p style="color: black">Posting Date: 
                                        {{ \Carbon\Carbon::parse($tender->posting_date)->format('d M Y') }}
                                    </p>
                                    <p style="color: green;">Opening Date: 
                                        {{ \Carbon\Carbon::parse($tender->start_date)->format('d M Y') }}
                                    </p>
                                    <p style="color: red;">Close Date: 
                                        {{ \Carbon\Carbon::parse($tender->end_date)->format('d M Y h:i:s A') }}
                                    </p>
                                </span>
                                
                            </div>
                            
                            <a href="{{route('tenders.edit',$tender->uuid)}}" class="far fa-edit fa-lg mx-2"></a>
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


              
            </div>



            <div class="row">
                <aside class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-body">
                               
                                <div class="card-sub">
                                   Users Who Apply for the Tender
                                </div>
                                <table class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Apply Date</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Contact</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Company</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tender->clients as $index => $cl)
                                        <tr>
                                            <th scope="col">{{$index + 1 }}</th>
                                            <th scope="col">{{$cl->name}}</th>
                                            <th scope="col">{{ \Carbon\Carbon::parse($cl->apply_date)->format('d M Y') }}</th>
                                            <th scope="col">{{$cl->email}}</th>
                                            <th scope="col">{{$cl->contact}}</th>
                                            <th scope="col">{{$cl->address}}</th>
                                            <th scope="col">{{$cl->company}}</th>
                                        </tr>
                                        @endforeach
                                       
                                      
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn" onclick="exportTableToExcel()">Download as Excel</button>
                        </div>
                    </div> <!-- card.// -->
                </aside>
            </div>
        </div>
    </div>



    <script>
        function exportTableToExcel() {
            var table = document.querySelector('.table');

            var wb = XLSX.utils.book_new();

            var ws = XLSX.utils.table_to_sheet(table);

            XLSX.utils.book_append_sheet(wb, ws, 'Tender Clients');

            XLSX.writeFile(wb, 'tender_clients.xlsx');
        }
    </script>




@endsection





