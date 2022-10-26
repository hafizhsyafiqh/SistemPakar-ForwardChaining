
	<nav class="p-3 bg-white border">
		<center>
			<small><?php echo date('Y') ?> - SELAMAT DATANG DI APLIKASI DIAGNOSA KERUSAKAN HANDPHONE DENGAN ALGORITMA C.45</small>
		</center>
	</nav>

	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/plugin/datatables/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugin/datatables/js/dataTables.bootstrap4.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$("input").attr("autocomplete","off");
			$("#tableku").DataTable();
		});
	</script>
</body>
</html>
