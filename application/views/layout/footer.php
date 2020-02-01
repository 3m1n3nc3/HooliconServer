
			<footer class="main-footer">
				<!-- To the right -->
				<div class="float-right d-none d-sm-inline">
					Anything you want
				</div>
				<!-- Default to the left -->
				<strong>Copyright &copy; <?php echo date('Y'); ?> <a href="<?php echo base_url(); ?>"><?php echo $this->my_config->item('site_name'); ?></a>.</strong> All rights reserved.
			</footer>
			<!-- <aside class="control-sidebar control-sidebar-dark"> -->

		</div>

		<!-- jQuery UI -->
		<script src="<?php echo base_url(); ?>backend/plugins/jquery/jquery-ui.min.js"></script>
		<!-- Bootstrap Bundle -->
		<script src="<?php echo base_url(); ?>backend/plugins/bootstrap/js/bootstrap.bundle.js"></script>
		<!-- Datatables -->
		<?php if (isset($use_table) && $use_table): ?>
			<script src="<?php echo base_url(); ?>backend/plugins/datatables/jquery.dataTables.min.js"></script>
			<script src="<?php echo base_url(); ?>backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
			<!-- page script -->
			<script>
			  $(function () {
			    $('#products_table').DataTable({  
			        "scrollX": true,  	
			    	"pageLength" : 10,
			     	"serverSide": true,
			     	"order": [[0, "asc" ]],
			     	"ajax":{
			            url :  '<?php echo site_url('tables/datatables/'.$table_method); ?>',
			            type : 'POST'
			        },
			        rowId: 20
			    }) 
			  })
			</script>
		<?php endif ?>
		<?php if (isset($use_chart) && $use_chart): ?>
			<script src="<?php echo base_url(); ?>backend/plugins/chart.js/Chart.min.js"></script>
		<?php endif ?>
		<!-- FastClick -->
		<script src="<?php echo base_url(); ?>backend/plugins/fastclick/fastclick.js"></script>
		<!-- Hoolicon -->
		<script src="<?php echo base_url(); ?>backend/plugins/customz/hoolicon.js"></script>
		<!-- Sortable -->
		<script src="<?php echo base_url(); ?>backend/plugins/customz/sortable.js"></script>
		<!-- AdminLTE App -->
		<script src="<?php echo base_url(); ?>backend/adminLTE/js/adminlte.min.js"></script> 
	</body>
</html>
