<header class="app-heading shadow-2dp">
    <nav class="navbar navbar-default navbar-static-top">
        <!-- begin .navbar-header -->
        <div class="navbar-header">
            <!-- begin .navbar-header-left with image -->
            <div class="navbar-header-left b-r">
                <!--begin logo-->
                <a class="logo" href="index.html">
                    <span class="logo-xs visible-xs">
                        <img src="{{ asset('assets/img/logo_xs.svg') }}" alt="logo-xs">
                    </span>
                    <span class="logo-lg hidden-xs">
                        <img src="{{ asset('assets/img/logo_lg.svg') }}" alt="logo-lg">
                    </span>
                </a>
                <!--end logo-->
            </div>
            <!-- END: .navbar-header-left with image -->
            <nav class="nav navbar-header-nav">
                <a class="visible-xs b-r" href="#top-nav-list" data-toggle=collapse>
                    <i class="fa fa-fw fa-bars"></i>
                </a>

                {{-- <form class="navbar-form hidden-xs b-r">
                    <div class="icon-after-input">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="icon">
                            <a href="#">
                                <i class="fa fa-fw fa-search"></i>
                            </a>
                        </div>
                    </div>
                </form> --}}

            </nav>

            <ul class="nav navbar-header-nav m-l-a">
                <li class="visible-xs b-l">
                    <a href="#top-search" data-toggle="canvas">
                        <i class="fa fa-fw fa-search"></i>
                    </a>
                </li>

                {{-- Message Notification --}}
                {{-- <li class="dropdown b-l">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false">

                        <span class="b-wisteria fa fa-fw fa-envelope-o u-posRelative"></span>

                        <span class="label label-primary b-orange">8
                            <span class="waves"></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInDown w-sm pull-right">
                        <li class="b-b">
                            <div class="media">
                                <div class="media-left">
                                    <a class="profile-pic" href="#">
                                        <img class="media-object" src="../assets/img/w2.svg" alt="...">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading"><small class="pull-right">12 hours ago</small><b>Leanne
                                            Graham</b></h5>
                                    started following <strong>Ervin Howell </strong>
                                    <p class="text-muted">3 days ago at 7:12 pm - 10.12.2016</p>
                                </div>
                            </div>
                        </li>
                        <li class="b-b">
                            <div class="media">
                                <div class="media-left">
                                    <a class="profile-pic" href="#">
                                        <img class="media-object" src="../assets/img/m2.svg" alt="...">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading"><small class="pull-right">12 hours ago</small><b>Leanne
                                            Graham</b></h5>
                                    started following <strong>Ervin Howell </strong>
                                    <p class="text-muted">3 days ago at 7:12 pm - 10.12.2016</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a class="text-center u-block text-asbestos" href="app-mail-inbox.html">
                                <i class="fa fa-envelope"></i> Read All Messages
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- Other Notification --}}
                {{-- <li class="dropdown b-l">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="fa fa-fw fa-bell"></i>
                        <span class="point bg-carrot b-peter-river">
                            <span class="waves"></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu pull-right w-sm animated fadeInUp">

                        <li class="p-a-15">
                            <a href="app-mail-inbox.html">
                                <div class="clearfix">
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                    <i class="fa fa-envelope fa-fw"></i> <small>12 messages</small>
                                </div>
                            </a>
                        </li>
                        <li class="p-a-15">
                            <a href="app-mail-inbox.html">
                                <div class="clearfix">
                                    <span class="pull-right text-muted small">3 minutes ago</span>
                                    <i class="fa fa-twitter fa-fw"></i> <small>4 follower</small>
                                </div>
                            </a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li class="text-right">
                            <a class="text-wisteria" href="#">
                                See all notification
                            </a>
                        </li>
                    </ul>
                </li> --}}

                <li class="dropdown b-l">
                    <a class="dropdown-toggle profile-pic" href="#" data-toggle="dropdown" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <img class="img-circle" src="{{ asset('assets/img/Dreamy Waze.png') }}" alt="Jane Doe">
                        <b class="hidden-xs hidden-sm">{{ auth()->user()->name }}</b>
                    </a>
                    <ul class="dropdown-menu animated flipInY pull-right">
                        {{-- <li>
                            <a href="#">Profile</a>
                        </li> --}}
                        {{-- <li>
                            <a href="#">Contacts</a>
                        </li>
                        <li>
                            <a href="#">Mail Box</a>
                        </li> --}}
                        <li role="separator" class="divider"></li>
                        <li onclick="LogOut()">
                            <a href="#" >
                                <i class="fa fa-fw fa-sign-out"></i>
                                Logout
                            </a>

                        </li>
                    </ul>
                </li>
                <!-- begin mega-menu -->
                {{-- <li class="dropdown u-posStatic hidden-xs b-l">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false">Mega
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu nav-full-item">
                        <li>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h1 class="text-muted">Heading 1</h1>
                                        <h2 class="text-primary">Heading 2</h2>
                                        <h3 class="text-warning">Heading 3</h3>
                                        <h4 class="text-danger">Heading 4</h4>
                                        <h5 class="text-success">Heading 5</h5>
                                        <h6 class="text-info">Heading 6</h6>
                                    </div>
                                    <div class="col-sm-4">
                                        <p>Default paragraph</p>
                                        <p class="lead">lead paragraph</p>
                                        <p class="text-muted">Muted paragraph</p>
                                        <p class="text-warning">warning paragraph</p>
                                        <p class="text-primary">primary paragraph</p>
                                        <p class="text-info">info paragraph</p>
                                        <p class="text-success">success paragraph</p>
                                        <p class="text-danger">danger paragraph</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <img class="img-responsive" src="../assets/img/p1.svg" alt="" />
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li> --}}
                <!-- END: mega-menu -->
            </ul>
        </div>
        <!-- END: .navbar-header -->
    </nav>
</header>

@section('js-header')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const LogOut = () => {
        $.ajax({
           type:'POST',
           url:"{{ route('logout') }}",
           success:(res) => {
             window.location = "/"
           },
           error:(e) =>{
            console.log(e);
           }
        });
    }

</script>
@endsection