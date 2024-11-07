<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BRSP Tender</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('assets/site/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="{{asset('assets/site/css/clean-blog.min.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('assets/site/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<style>
    .custom-btn {
        /* background-color: black;
        color: white;
        border-radius: 50px; Makes the button rounded */
        border: none; /* Removes border */
    } 

    .custom-btn:hover {
        background-color: #333; /* Darker black on hover */
        color: white; /* Keep white text on hover */
    }

    .custom-btn i {
        margin-right: 5px; /* Adds space between icon and text */
    }
</style>


<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                {{-- <a class="navbar-brand" href="index.html">BRSP</a> --}}
                <a class="navbar-brand" href="index.html">
                    <img src="{{asset('assets/img/brsp-new.png')}}" alt="BRSP Logo" style="height: 40px; width: auto;">
                </a>
                
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="https://brsp.org.pk/">Home</a>
                    </li>
                    <li>
                        <a href="https://brsp.org.pk/about-us/">About</a>
                    </li>
                    <li>
                        <a href="https://brsp.org.pk/contact-us-2/">Contact</a>
                    </li>
                    <li>
                        <a href="{{route('login')}}">Login</a>
                    </li>
                   
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('assets/site/img/brsp-img.jpg'); background-size: cover;  background-position: center; opacity: 0.8;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Archive Tenders</h1>
                        <hr class="small">
                        <span class="subheading">Management Information System.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                @foreach ($tenders as $tender)
                <div class="post-preview">
                    <a href="post.html" style="pointer-events: none; color: inherit; text-decoration: none;">
                        <h3>
                            {{ strtoupper($tender->title) }} <small>({{ strtoupper($tender->type) }})</small>
                        </h3>
                        <small style="font-size: 0.60em; display: block; margin-top: 0;">({{strtoupper($tender->t_type) }})</small>
                        <h4 class="post-subtitle">
                            {!! $tender->description!!}
                        </h4>
                    </a>
                    
                    <p class="post-meta">
                        Posted by <a href="#">{{$tender->user->name}}</a> 
                        Opening Date: <span style="color: orange;">{{ \Carbon\Carbon::parse($tender->start_date)->format('F d, Y') }}</span> | 
                        Close Date: <span style="color: red;">{{ \Carbon\Carbon::parse($tender->end_date)->format('d M Y h:i:s A') }}</span>
                        {{-- <a href="#" class="btn btn-sm custom-btn" style="margin-left: 10px;">
                            <i class="fa fa-download" aria-hidden="true"></i> Download
                        </a> --}}
                    </p>
                    
                </div>
                <hr>
                @endforeach
              
                <!-- Pager -->
                <ul class="pager">
                    <li class="next">
                        <a href="{{route('tender')}}">Active Tenders &rarr;</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <hr>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy;All rights reserved | Designed & Developed By BRSP  </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="{{asset('assets/site/vendor/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('assets/site/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- Contact Form JavaScript -->
    <script src="{{asset('assets/site/js/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('assets/site/js/contact_me.js')}}"></script>

    <!-- Theme JavaScript -->
    <script src="{{asset('assets/site/js/clean-blog.min.js')}}"></script>

</body>

</html>
