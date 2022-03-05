<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    {{--
    <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{--
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <!-- Vendor stylesheet files. REQUIRED -->
    <!-- BEGIN: Vendor  -->
    <link rel="stylesheet" href="assets/css/vendor.css">
    <!-- END: Vendor stylesheet files -->

    <!-- Theme main stlesheet files. REQUIRED -->
    <link rel="stylesheet" href="assets/css/chaldene.css">
    <link id="theme-list" rel="stylesheet" href="assets/css/theme-peter-river.css">
    <!-- END: theme main stylesheet files -->

    <!-- theme-switcher stylesheet files. NOT REQUIRED -->
    <link rel="stylesheet" href="assets/css/theme-switcher.css">
    <!-- END: theme-switcher stylesheet file. -->

    <link rel="stylesheet" href="assets/vendor/highlight/styles/atom-one-dark.css">
    <link type="text/css" rel="stylesheet" href="assets/vendor/perfect-scrollbar/perfect-scrollbar.min.css">

    @yield('css')
</head>

<body>

    <!-- begin .app -->
    <div class="app">
        <!-- begin .app-wrap -->
        <div class="app-wrap">
            <!-- begin  .app-heading -->
            @include('components.header-app')
            <!-- END:  .app-heading -->

            <!-- begin .app-container -->
            <div class="app-container">

                <!-- begin .app-main -->
                <div class="app-main">

                    <!-- begin .main-heading -->
                    @include('components.header-menu')
                    <!-- END: .main-heading -->

                    <!-- begin .main-content -->
                    @yield('content')
                    <!-- END: .main-content -->

                    <!-- begin .main-footer -->
                    {{-- <footer class="main-footer bg-white p-a-5">
                        main footer
                    </footer> --}}
                    <!-- END: .main-footer -->

                </div>
                <!-- END: .app-main -->
            </div>
            <!-- END: .app-container -->

            <!-- begin .app-footer -->
            @include('components.footer')
            <!-- END: .app-footer -->

        </div>
        <!-- END: .app-wrap -->
    </div>
    <!-- END: .app -->

    <span class="fa fa-angle-up" id="totop" data-plugin="totop"></span>

    <!-- begin theme-switcher. DEMO ONLY! -->
    <div class="canvas is-right is-fixed bg-white shadow-4dp" id="style-switcher">
        <div class="h1 demo-header shadow-4dp" data-target="#style-switcher" data-toggle="canvas">
            <i class="fa fa-fw fa-cog"></i>
        </div>
        <div class=p-a-15>

            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-bordered nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#page" aria-controls="page" role="tab"
                            data-toggle="tab">Page</a></li>
                    <li role="presentation"><a href="#theme" aria-controls="theme" role="tab"
                            data-toggle="tab">Theme</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="page">
                        <form class="p-a-15" id="page-form">
                            <div class="form-group">
                                <label class="radio-inline">
                                    <input type="radio" name="p-l" value="0" checked> Fluid
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="p-l" value="1"> Fixed
                                </label>
                                <div class="psc collapse">
                                    <fieldset id="plm" disabled>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" id="plmv" value="2"> Main
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" id="plsv" value="3"> Sidebar
                                        </label>
                                    </fieldset>
                                </div>
                            </div>
                            <hr>

                            <div class="nss hidden">
                                <div class="form-group">
                                    <label>Navbar Style</label>
                                </div>
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" name="ns" value="1" checked> Static
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="ns" value="0"> Fixed
                                    </label>
                                </div>
                                <hr class="b-s-dashed">
                            </div>

                            <div class="nbc">
                                <div class="form-group">
                                    <label>Navbar Color</label>
                                </div>
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" name="nc" value="1" checked>White
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="nc" value="0">Inverse
                                    </label>
                                </div>
                                <hr class="b-s-dashed">
                            </div>

                            <div class="psc collapse">
                                <div class="form-group">
                                    <label>Sidebar Hoverable</label>
                                </div>
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" name="hs" value="1" id="hs1"> Add
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="hs" value="0" checked id="hs0"> Remove
                                    </label>
                                </div>

                                <hr class="b-s-dashed">
                            </div>

                            <div class="form-group">
                                <label>Page Width</label>
                            </div>
                            <div class="form-group">
                                <label class="radio-inline">
                                    <input type="radio" name="pw" value="0" checked> Wide
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="pw" value="1"> Boxed
                                </label>
                            </div>

                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="theme">
                        <nav class="theme-list u-flex u-flexWrap u-flexRow u-flexJustifyBetween">
                            <a class="m-v-5" href="#" rel="assets/css/theme-peter-river.css">
                                <img src="assets/img/theme-peter-river.svg" alt="peter-river">
                            </a>
                            <a class="m-v-5" href="#" rel="assets/css/theme-turquoise.css">
                                <img src="assets/img/theme-turquoise.svg" alt="turquoise">
                            </a>
                            <a class="m-v-5" href="#" rel="assets/css/theme-amethyst.css">
                                <img src="assets/img/theme-amethyst.svg">
                            </a>
                            <a class="m-v-5" href="#" rel="assets/css/theme-orange.css">
                                <img src="assets/img/theme-orange.svg" alt="orange">
                            </a>
                            <a class="m-v-5" href="#" rel="assets/css/theme-alizarin.css">
                                <img src="assets/img/theme-alizarin.svg" alt="alizarin">
                            </a>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: theme-switcher. -->


    <!-- Vendor javascript files. REQUIRED -->
    <script src="assets/js/vendor.js"></script>
    <!-- END: Vendor javascript files -->

    <script src="assets/js/chaldene.js"></script>

    <!-- theme-switcher scripts file. NOT REQUIRED -->
    <script src="assets/js/theme-switcher.js"></script>
    <!-- END: theme-switcher scripts file. -->

    <!-- Plugin javascript files. OPTIONAL -->
    <script src="assets/vendor/perfect-scrollbar/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/vendor/highlight/highlight.pack.js"></script>
    <script>
        $(document).ready(function()
    {
      $('pre code').each(function(i, block)
      {
        hljs.highlightBlock(block);
      });
    });

    </script>
    @yield('js')
</body>

</html>