</div>
</div>

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

	$(document).ready(function () 
	{

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
