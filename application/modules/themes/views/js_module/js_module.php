<script src="<?= base_url('assets/js/library/bootstrap-treeview.js') ?>" type="text/javascript"></script>
<script type="text/javascript">

	$(function(){
		
		var defaultData = [
			{
				text: 'I. INTRODUCCION. PROCESO CONSTITUYENTE',
				href: '#parent1',
				tags: ['4'],
				nodes: [
					{
						text: 'La Transición al sistema Constitucional',
						href: '#child1',
						tags: ['2'],
						nodes: [
							{
								text: 'Grandchild 1',
								href: '#grandchild1',
								tags: ['0']
							},
							{
								text: 'Grandchild 2',
								href: '#grandchild2',
								tags: ['0']
							}
						]
					},
					{
						text: 'Child 2',
						href: '#child2',
						tags: ['0']
					}
				]
			},
			{
				text: 'II. LA CONSTITUCION ESPAÑOLA DE 1978. ESTRUCTURA Y CONTENIDO.',
				href: '#parent2',
				tags: ['0']
			},
			{
				text: 'Parent 3',
				href: '#parent3',
				 tags: ['0']
			},
			{
				text: 'Parent 4',
				href: '#parent4',
				tags: ['0']
			},
			{
				text: 'Parent 5',
				href: '#parent5'  ,
				tags: ['0']
			}
		];

		$('#treeview1').treeview({
			data: defaultData
		});

	});

</script>
