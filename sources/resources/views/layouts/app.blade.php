<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')

    <title>Portal Covid 19</title>
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/pickers/pickadate/pickadate.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/components.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/core/menu/menu-types/horizontal-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/dashboard-analytics.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/css/tables/datatable/datatables.min.css">
    <!-- SweetAlert -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/css/extensions/sweetalert2.min.css">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
</head>
<body class="horizontal-layout horizontal-menu 2-columns navbar-sticky footer-static" data-open="hover" data-menu="horizontal-menu" data-col="2-columns">    
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-fixed bg-primary navbar-brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ url('/') }}">
                        <div class="brand-logo"><img class="logo" src="{{ asset('assets/images/logo/logo.png') }}" /></div>
                        <h2 class="brand-text mb-0">Portal Covid 19</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a></li>
            </ul>
        </div>
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon bx bx-menu"></i></a></li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right d-flex align-items-center">
                        <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name">{{Auth::user()->name}}</span><span class="user-status text-muted">Available</span></div><span><img class="round" src="{{ asset('assets/images/portrait/small/avatar-s-11.jpg') }}" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <a class="dropdown-item" href="#"><i class="bx bx-user mr-50"></i> Edit Profile</a>
                                <div class="dropdown-divider mb-0"></div>
                                <a class="dropdown-item" href="{{route('logout')}}"><i class="bx bx-power-off mr-50"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-without-dd-arrow" role="navigation" data-menu="menu-wrapper">
        <div class="navbar-header d-xl-none d-block">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ url('/') }}">
                        <div class="brand-logo"><img class="logo" src="{{ asset('assets/images/logo/logo.png') }}" /></div>
                        <h2 class="brand-text mb-0">Portal Covid 19</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="filled">
                @include('layouts.menu')
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        @yield('content')
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-left d-inline-block">2020 &copy; Portal Covid 19</span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="bx bx-up-arrow-alt"></i></button>
        </p>
    </footer>
    <!-- END: Footer-->

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js') }}"></script>
    <script src="{{ asset('assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js') }}"></script>
    <script src="{{ asset('assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('assets/vendors/js/charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/extensions/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script> --}}
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('assets/js/scripts/configs/vertical-menu-light.js') }}"></script>
    <script src="{{ asset('assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('assets/js/core/app.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/components.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/footer.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- DataTables -->
    <script src="{{ asset('assets') }}/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <!-- SweetAlert -->
    <script src="{{ asset('assets') }}/vendors/js/extensions/sweetalert2.all.min.js"></script>
    
    <script type="text/javascript">
        $('.pickadate').pickadate({
            // format: 'd mmmm, yyyy',
            format: 'yyyy-mm-dd',
            formatSubmit: 'yyyy-mm-dd',
        });

        $('.pickatime').pickatime({
            format: 'h:i A',
            formatSubmit: 'HH:i',
        });

        $.fn.popupModal = function(options) {
            if(this.length) {
                var id = options.target,
                    modal_id = 'modal--' + id,
                    table_id = 'table--' + id,
                    trigger_class = 'trigger--' + modal_id,
                    trigger_button = $('.' + trigger_class);
                $(this).addClass(trigger_class);

                var dtOptions = $.extend({
                    pageLength: 10,
                    pagingType: "simple",
                    language: {
                        search: "",
                        searchPlaceholder: "Search"
                    },
                    iDisplayLength: 10,
                    bLengthChange: false,
                    autoWidth: true,
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    scrollX: true,
                    columnDefs: [{
                        searchable: false,
                        orderable: false,
                        targets: 0
                    }],
                    ajax: {},
                    columns: [],
                    order:[[1,'desc']],
                    drawCallback: function(settings) {
                      // this.columns.adjust();
                    },
                },options.tableOptions);

                var modalOptions = $.extend({
                        size: 'modal-md',
                        center: false,
                        animation: true,
                        title: '',
                        closeButton: true,
                        bodyClass: '',
                        footerClass: '',
                        body: '',
                        buttons: [],
                        autoFocus: true,
                        removeOnDismiss: false,
                        modal: {}
                    }, options.modalOptions);

                // Modal base template
                var modalTemplates  = '<div class="modal'+ (modalOptions.animation == true ? ' fade' : '') +'" tabindex="-1" role="dialog" id="'+ modal_id +'">'+
                '<div class="modal-dialog '+modalOptions.size+(modalOptions.center ? ' modal-dialog-centered' : '')+'" role="document">'+
                '<div class="modal-content">'+
                ((modalOptions.title != '') ?
                    '<div class="modal-header">'+
                    '<h5 class="modal-title">'+ modalOptions.title +'</h5>'+
                    ((modalOptions.closeButton == true) ?
                        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                        '<span aria-hidden="true">&times;</span>'+
                        '</button>  '
                    : '') +
                    '</div>  '
                : '') +
                '<div class="modal-body">'+
                '<table id="'+table_id+'" class="table table-stripped table-hover" width="100%"></table>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</div>';


                // Convert modal to object
                var modalTemplates = $(modalTemplates);
                var dataTables = modalTemplates.find('#' + table_id).DataTable(dtOptions);

                // append generated modal to the body
                $("body").append(modalTemplates);
                $("body").on("click", '.' + trigger_class, function() {
                    let modal = $('#' + modal_id).modal(modalOptions.modal);

                    modal.on('shown.bs.modal', function(e){
                        $($.fn.dataTable.tables(true)).DataTable()
                        .ajax.reload()
                        .columns.adjust();
                    });

                    if(modalOptions.removeOnDismiss) {
                        modal.on('hidden.bs.modal', function() {
                            modal.remove();
                        });
                    }

                    $('#' + table_id + ' tbody').on('click', 'tr', function () {
                        var data = dataTables.row(this.closest('tr')).data();
                        options.onSelect.call(this, data);
                        modal.modal('hide');
                    });
                });

            }
            return false;
        };

        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            @if (session('status'))
                // Sweet Alert
                swal.fire({
                    title: "{{ ucwords(session('status')['message_type']) }}!",
                    text: "{{ session('status')['message_desc'] }}",
                    icon: "{{ session('status')['message_type'] }}",
                });
            @endif
        });

        function deleteRow(id,dataTabel) {
            swal.fire({
                icon : "warning",
                title: "Caution !",
                text : "Are you sure want to delete this data?",
                showCancelButton: true,
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url : $('#'+id).attr('action'),
                        method: 'DELETE',
                        data : $('#'+id).serialize(),
                        success: function (response) {
                            if(dataTabel) {
                                // Reload Data Table
                                dataTabel.ajax.reload();
                            }

                            // Return Message
                            swal.fire({
                                title: capitalize(response.message_type)+ "!",
                                text: response.message_desc,
                                type: response.message_type,
                            });
                        },
                        error : function (xhr) {}
                    })
                }
            });
        }
    </script>
    @yield('js')
</body>
</html>
