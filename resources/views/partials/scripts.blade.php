

    <!-- plugins:js -->

    <script src={{asset("vendors/base/vendor.bundle.base.js")}}></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src={{asset("vendors/chart.js/Chart.min.js")}}></script>
    <script src={{asset("vendors/datatables.net/jquery.dataTables.js")}}></script>
    <script src={{asset("vendors/datatables.net-bs4/dataTables.bootstrap4.js")}}></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src={{asset("js/off-canvas.js")}}></script>
    <script src={{asset("js/hoverable-collapse.js")}}></script>
    <script src={{asset("js/template.js")}}></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src={{asset("js/dashboard.js")}}></script>
    <script src={{asset("js/data-table.js")}}></script>
    <script src={{asset("js/jquery.dataTables.js")}}></script>
    <script src={{asset("js/dataTables.bootstrap4.js")}}></script>
    <!-- End custom js for this page-->
  
    <script src={{asset("js/jquery.cookie.js")}} type="text/javascript"></script>
    <script>
  
  $(document).ready( function () {
      $('#myTable').DataTable();
      setTimeout(() => {
        $(".alert-info").slideUp(500);
      }, 1000);
  } );


  
    </script>
  
  