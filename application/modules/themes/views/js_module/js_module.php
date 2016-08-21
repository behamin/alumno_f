<?php if($tree != null): ?>
<script src="<?= base_url('assets/js/library/bootstrap-treeview.js') ?>" type="text/javascript"></script>
<script type="text/javascript">

	$(function(){

		var defaultData = [

				<?php

					echo $tree;

				?>

		];

		$('#treeview1').treeview({
			data: defaultData
		});

	});

</script>
<?php endif ?>
