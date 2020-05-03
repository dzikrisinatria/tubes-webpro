</div>
</div>

<!-- Bootstrap JavaScript-->
<script src="<?= base_url('assets/');?>js/jquery.js"></script>
<script src="<?= base_url('assets/');?>js/bootstrap.bundle.min.js"></script>

<!-- Datatables JavaSript -->
<script src="<?= base_url('assets/');?>datatables/js/datatables.min.js"></script>
<!-- <script src="<?= base_url('assets/');?>datatables/js/jquery.dataTables.min.js"></script> -->
<script src="<?= base_url('assets/');?>datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/');?>datatables/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/');?>datatables/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/');?>datatables/js/buttons.flash.min.js"></script>
<script src="<?= base_url('assets/');?>datatables/js/pdfmake.min.js"></script>
<script src="<?= base_url('assets/');?>datatables/js/jszip.min.js"></script>
<script src="<?= base_url('assets/');?>datatables/js/vfs_fonts.js"></script>

<script>

	// JAVASCRIPT UNTUK MODAL
	$('#myModal').on('shown.bs.modal', function ()
    {
		$('#myInput').trigger('focus')
	})

	// JAVASCRIPT UNTUK TOOLTIP BUTTON
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})

	$(document).ready(function () {

		<?php foreach ($pemesananPagination as $p) : ?>
			$("#table<?= $p['id_pemesanan']; ?>").hide();
			$("#toggle<?= $p['id_pemesanan']; ?>").click(function(){
				$("#table<?= $p['id_pemesanan']; ?>").toggle();
				$(this).text($(this).text() == 'Lihat Detail' ? 'Sembunyikan' : 'Lihat Detail'); 
			});
		<?php endforeach; ?>

		//JAVASCRIPT UNTUK DATATABLES
		$('#datatables').DataTable( {
			dom: 'Bfrtip',
			buttons: [
				{
					extend: 'copyHtml5',
					exportOptions: {
						columns: [ 0,1,2,3,4,5,6 ]
					}
				},
				{
					extend: 'excelHtml5',
					exportOptions: {
						columns: [ 0,1,2,3,4,5,6 ]
					}
				},
				{
					extend: 'pdfHtml5',
					exportOptions: {
						columns: [ 0,1,2,3,4,5,6 ]
					}
				}
			]
		});

		// JAVASCRIPT UNTUK SIDEBAR COLLAPSE
		$('#sidebarCollapse').on('click', function () {
			$('#sidebar, #content').toggleClass('active');
			$('.collapse.in').toggleClass('in');
			$('a[aria-expanded=true]').attr('aria-expanded', 'false');
		});
	});
</script>

</body>

</html>
