  {{--  <!-- DataTables CSS (head section e thakbe ideally) -->
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>

<!-- jQuery must load first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>  --}}








  <!-- Bootstrap JS and others -->
  <script src="{{ asset('Backend') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('Backend') }}/assets/libs/simplebar/simplebar.min.js"></script>
  <script src="{{ asset('Backend') }}/assets/libs/node-waves/waves.min.js"></script>
  <script src="{{ asset('Backend') }}/assets/libs/feather-icons/feather.min.js"></script>
  <script src="{{ asset('Backend') }}/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
  <script src="{{ asset('Backend') }}/assets/js/plugins.js"></script>

  <!-- apexcharts -->
  <script src="{{ asset('Backend') }}/assets/libs/apexcharts/apexcharts.min.js"></script>

  <!-- Vector map -->
  <script src="{{ asset('Backend') }}/assets/libs/jsvectormap/jsvectormap.min.js"></script>
  <script src="{{ asset('Backend') }}/assets/libs/jsvectormap/maps/world-merc.js"></script>

  <!-- Swiper slider -->
  <script src="{{ asset('Backend') }}/assets/libs/swiper/swiper-bundle.min.js"></script>

  <!-- Dashboard init -->
  <script src="{{ asset('Backend') }}/assets/js/pages/dashboard-ecommerce.init.js"></script>

  <!-- App js (must load last after all dependencies) -->
  <script src="{{ asset('Backend') }}/assets/js/app.js"></script>

  <!-- DataTables djasklfhsdkjfh CSS -->
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

  <!-- jQuery and DataTables JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>



<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


  @stack('scripts')
