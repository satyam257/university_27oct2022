<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>{{config('app.name')}}</title>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="{{url('css/app.css')}}" />
    <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{url('assets/font-awesome/4.5.0/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{url('assets/css/fonts.googleapis.com.css')}}" />
    <link rel="stylesheet" href="{{url('assets/css/ace.min.css')}}" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="{{url('assets/css/ace-part2.min.css')}}" class="ace-main-stylesheet" />
    <![endif]-->
    <link rel="stylesheet" href="{{url('assets/css/ace-skins.min.css')}}"/>
    <link rel="stylesheet" href="{{url('assets/css/ace-rtl.min.css')}}"/>
    <script src="{{url('assets/js/ace-extra.min.js')}}"></script>
    <link rel="stylesheet" href="{{url('assets/css/custom.css')}}" class="ace-main-stylesheet"
          id="main-ace-style"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('libs')}}/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs')}}/datatables.net-bs4/css/responsive.dataTables.min.css">

    <STYLE>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        .input-group {
            position: relative;
            display: flex;
            flex-wrap: nowrap;
            align-items: stretch;
            width: 100%;
        }
        .dt-button{
            background-image: none!important;
            border: 1px solid #FFF;
            border-radius: 0;
            padding: 5px 20px;
            border-radius: 5px;
            box-shadow: none!important;
            -webkit-transition: background-color .15s,border-color .15s,opacity .15s;
            -o-transition: background-color .15s,border-color .15s,opacity .15s;
            transition: background-color .15s,border-color .15s,opacity .15s;
            vertical-align: middle;
            margin: 0;
            position: relative;
        }
        table{padding: 0px !important}
        table th, table td{
            padding: 10px;
        }
        .table td{
            border-bottom: 1px  solid  #f1f1f1 !important;
        }
        .nav li {
            display: block;
            width: 100% !important;
        }
        .dropdown-toggle:after {
            display: none;
        }
    </STYLE>
</head>

<body class="no-skin">
<div class="pre-loader">
    <div class="sk-fading-circle">
        <div class="sk-circle1 sk-circle"></div>
        <div class="sk-circle2 sk-circle"></div>
        <div class="sk-circle3 sk-circle"></div>
        <div class="sk-circle4 sk-circle"></div>
        <div class="sk-circle5 sk-circle"></div>
        <div class="sk-circle6 sk-circle"></div>
        <div class="sk-circle7 sk-circle"></div>
        <div class="sk-circle8 sk-circle"></div>
        <div class="sk-circle9 sk-circle"></div>
        <div class="sk-circle10 sk-circle"></div>
        <div class="sk-circle11 sk-circle"></div>
        <div class="sk-circle12 sk-circle"></div>
    </div>
</div>

<div id="navbar" class="navbar navbar-default  ace-save-state">
    <div class="navbar-container w-100 ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left display" id="menu-toggler"
                data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>
                    {{config('app.name')}}
                </small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav d-flex flex-nowrap" style="">
                <li class="grenn dropdown-modal">
                    <a data-toggle="dropdown" class="dropdown-toggle text-white font-weight-bold">
                        Batch : {{ \App\Models\Batch::find(Session::get('mode', \App\Helpers\Helpers::instance()->getCurrentAccademicYear()))->name}}
                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="dropdown-menu">
                        @foreach(\App\Models\Batch::join('student_classes', ['student_classes.year_id'=>'batches.id'])->where('student_id', Auth('student')->user()->id)->orderBy('name')->get() as $batch)
                            <li>
                                <a href="{{ route('mode',$batch->id) }}">{{$batch->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="light-blue dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="{{url('assets/images/avatars/user.jpg')}}"
                             alt="Jason's Photo"/>
                        <span>
						<small>Welcome</small>
                         {{\Auth::user()->name}}
						</span>

                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>
                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            @if(\Auth::guard('student')->user() == null)
                                @if(\Auth::user()->isHod || \Auth::user()->isTeacher)
                                    <a href="{{route('user.home')}}"><i
                                            class="ace-icon fa fa-user"></i>Profile</a>
                                @elseif(\Auth::user()->isAdmin)
                                    <a href="{{route('admin.home')}}"><i
                                            class="ace-icon fa fa-user"></i>Profile</a>
                                @endif
                            @else
                                <a href="{{route('student.home')}}"><i
                                        class="ace-icon fa fa-user"></i>Profile</a>
                            @endif
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
												document.getElementById('logout-form').submit();">
                                <i class="ace-icon fa fa-power-off"></i>
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>
<div class="main-container ace-save-state" id="main-container">

    <div id="sidebar" class="sidebar                  responsive                    ace-save-state">
        <script type="text/javascript">
            try {
                ace.settings.loadState('sidebar')
            } catch (e) {
            }
        </script>

        <div class="sidebar-shortcuts" id="sidebar-shortcuts" style="background-color: #dbfce1; color: #007139;">
            <div>
                <h5>{{\App\Models\Batch::find(\App\Helpers\Helpers::instance()->getCurrentAccademicYear())->name}}</h5>
            </div>
        </div><!-- /.sidebar-shortcuts -->
        <ul class="nav nav-list">
            <li>
                <a href="">
                    <i class="menu-icon fa fa-dashboard"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
                <b class="arrow"></b>
            </li>
            
            <li>
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon  text-primary fa fa-book"></i>
                    <span class="menu-text text-capitalize"> Form R/Form B</span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>

                <ul class="submenu">
                    <li>
                        <a href="" class="text-capitalize">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Signup/Drop Courses
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li>
                        <a href="{{ route('student.course.index')}}" class="text-capitalize">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Registered Courses
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{route('student.fee')}}">
                    <i class="menu-icon fa fa-money"></i>
                    <span class="menu-text">Fee Status</span>
                </a>
                <b class="arrow"></b>
            </li>
           @if(Auth::user()->type == "boarding")
            <li>
                <a href="{{route('student.boarding')}}">
                    <i class="menu-icon fa fa-money"></i>
                    <span class="menu-text">Boarding Fee</span>
                </a>
                <b class="arrow"></b>
            </li>
           @endif

            <li>
                <a href="{{route('student.subject')}}">
                    <i class="menu-icon fa fa-book"></i>
                    <span class="menu-text">Subject</span>
                </a>
                <b class="arrow"></b>
            </li>


            <li>
                <a href="{{route('student.result')}}">
                    <i class="menu-icon fa fa-graduation-cap"></i>
                    <span class="menu-text">Result</span>
                </a>
                <b class="arrow"></b>
            </li>

            <li>
                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   href="{{route('logout')}}">
                    <i class="menu-icon fa fa-lock"></i>
                    <span class="menu-text">	Logout</span>
                </a>
                <b class="arrow"></b>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>


        </ul><!-- /.nav-list -->


        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i id="sidebar-toggle-icon" class="ace-icon f ace-save-state"></i>
        </div>
    </div>
    <div class="main-content">
        <div class="main-content-inner">

            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>
                    <li class="active">Dashboard</li>
                    <li class="active"> Full Name: <b style="color: #e30000">{{\Auth::user()->name}}</b></li>

                </ul><!-- /.breadcrumb -->
            </div>

            <div class="m-5">
                @if(Session::has('success'))
                    <div class="alert alert-success fade in">
                        <strong>Success!</strong> {{Session::get('success')}}
                    </div>
                @endif

                @if(Session::has('error'))
                    <div class="alert alert-danger fade in">
                        <strong>Error!</strong> {{Session::get('error')}}
                    </div>
                @endif


                <div class="mb-4 mx-3">
                    <h4 class="font-weight-bold">{{ $title ?? '' }}</h4>
                </div>
                @yield('section')
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <div class="footer-inner">
        <div class="footer-content" style="background:#fff">
            <span class="bigger-120">
               &copy; 2019. All Rights Reserved by Nishang System
            </span>
            &nbsp; &nbsp;
            <span class="action-buttons">
                <a href="#">
                    <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                </a>

                <a href="#">
                    <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
                </a>

                <a href="#">
                    <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
                </a>
            </span>
        </div>
    </div>
</div>

<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
</a>
</div>
<script src="{{url('assets/js/jquery-2.1.4.min.js')}}"></script>
<script src="{{url('assets/js/bootstrap.min.js')}}"></script>
<script src="{{ url('assets/vendor/toastr/toastr.min.js') }}"></script>
<script src="{{url('assets/js/ace.min.js')}}"></script>

<script src="{{ asset('libs')}}/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('libs')}}/datatables.net-bs4/js/dataTables.responsive.min.js"></script>


<script>
    $(function () {
        $('.table , .adv-table table').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel',
                {
                    text: 'Download PDF',
                    extend: 'pdfHtml5',
                    message: '',
                    orientation: 'portrait',
                    exportOptions: {
                        columns: ':visible'
                    },
                    customize: function (doc) {
                        doc.pageMargins = [10,10,10,10];
                        doc.defaultStyle.fontSize = 7;
                        doc.styles.tableHeader.fontSize = 7;
                        doc.styles.title.fontSize = 9;
                        doc.content[0].text = doc.content[0].text.trim();

                        doc['footer']=(function(page, pages) {
                            return {
                                columns: [
                                    '{{ $title ?? '' }}',
                                    {
                                        // This is the right column
                                        alignment: 'right',
                                        text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
                                    }
                                ],
                                margin: [10, 0]
                            }
                        });
                        // Styling the table: create style object
                        var objLayout = {};
                        // Horizontal line thickness
                        objLayout['hLineWidth'] = function(i) { return .5; };
                        // Vertikal line thickness
                        objLayout['vLineWidth'] = function(i) { return .5; };
                        // Horizontal line color
                        objLayout['hLineColor'] = function(i) { return '#aaa'; };
                        // Vertical line color
                        objLayout['vLineColor'] = function(i) { return '#aaa'; };
                        // Left padding of the cell
                        objLayout['paddingLeft'] = function(i) { return 4; };
                        // Right padding of the cell
                        objLayout['paddingRight'] = function(i) { return 4; };
                        // Inject the object in the document
                        doc.content[1].layout = objLayout;
                    }
                }

            ],
            info:     false,
            searching: true,
            ordering : false
        });

    });


</script>

<script src="{{ asset('libs')}}/datatables.net/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('libs')}}/datatables.net/js/jszip.min.js"></script>
<script src="{{ asset('libs')}}/datatables.net/js/pdfmake.min.js"></script>
<script src="{{ asset('libs')}}/datatables.net/js/vfs_fonts.js"></script>
<script src="{{ asset('libs')}}/datatables.net/js/buttons.html5.min.js"></script>

<script>
    (function($){
        'use strict';
        $(window).on('load', function () {
            if ($(".pre-loader").length > 0)
            {
                $(".pre-loader").fadeOut("slow");
            }
        });
    })(jQuery)
</script>
@yield('script')
</body>
</html>