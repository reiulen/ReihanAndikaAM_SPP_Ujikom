

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugin/datatables/datatables.min.css') }}" />
@endpush

@push('script')
    <!-- DataTables  & plugin -->
    <<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
    <script type="text/javascript" src="{{ asset('assets/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugin/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
@endpush
