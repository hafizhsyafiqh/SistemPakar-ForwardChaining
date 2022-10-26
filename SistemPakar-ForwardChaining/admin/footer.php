</div>
<nav class="p-3 bg-white border mt-5">
  <center>
    <small><?php echo date('Y') ?> - SISTEM PAKAR KERUSAKAN HANDPHONE MENGGUNAKAN FORWARD CHAINING</small>
  </center>
</nav>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/plugin/datatables/js/jquery.dataTables.min.js"></script>
<script src="../assets/plugin/datatables/js/dataTables.bootstrap4.min.js"></script>

<script src="../assets/plugin/chart.js/Chart.min.js"></script>


<script>
  $(document).ready(function(){

    $('#table-datatable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      "pageLength": 20
    });

  });

</script>


</body>
</html>