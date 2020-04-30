</div>
</div>

<script>
	$('#myModal').on('shown.bs.modal', function ()
    {
		$('#myInput').trigger('focus')
	})
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
	$(document).ready(function () {
		$('#sidebarCollapse').on('click', function () {
			$('#sidebar, #content').toggleClass('active');
			$('.collapse.in').toggleClass('in');
			$('a[aria-expanded=true]').attr('aria-expanded', 'false');
		});
	});
</script>

</body>

</html>
