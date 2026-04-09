<!DOCTYPE html>


<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template">
<!-- head -->
@include('layouts.blocks.head')
<!-- / head -->
<body
 
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
  
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar  ">
  <div class="layout-container">

<!-- aside -->
@include('layouts.blocks.aside')
<!-- / aside -->

<!-- Layout container -->
        <div class="layout-page">   
<!-- Navbar -->
@include('layouts.blocks.nav')
<!-- / Navbar -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
    <!-- Content -->   
    <div class="container-xxl flex-grow-1 container-p-y">
        @yield('content')
    </div>
    <!-- / Content -->

<!-- Footer -->
@include('layouts.blocks.footer')
<!-- / Footer -->

          
    <div class="content-backdrop fade"></div>
     </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    
    
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    
    
    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
    
  </div>
  <!-- / Layout wrapper -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  
  <script src="../vendor/libs/jquery/jquery.js"></script>
  <script src="../vendor/libs/popper/popper.js"></script>
  <script src="../vendor/js/bootstrap.js"></script>
  <script src="../vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="../vendor/libs/hammer/hammer.js"></script>
  <script src="../vendor/libs/i18n/i18n.js"></script>
  <script src="../vendor/libs/typeahead-js/typeahead.js"></script>
  <script src="../vendor/js/menu.js"></script>
  
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="../vendor/libs/apex-charts/apexcharts.js"></script>

  <!-- Main JS -->
  <script src="../assets/js/main.js"></script>
  

  <!-- Page JS -->
  <script src="../assets/js/dashboards-analytics.js"></script>
  
</body>


<!-- Mirrored from demos.pixinvent.com/frest-html-admin-template/html/vertical-menu-template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 10 Jul 2024 11:58:46 GMT -->
</html>

<!-- beautify ignore:end -->
