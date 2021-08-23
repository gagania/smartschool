<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.head')
    <title>Smart School</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="app">
    @include('template.navbar')
    <sidebar></sidebar>
    <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <router-view :key="$route.fullPath"></router-view>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
    
        <!-- Preloader -->
    </div>
</body>
<script src="{{ mix('js/app.js') }}"></script>
</html>