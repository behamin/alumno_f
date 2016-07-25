<div class="col-md-3">
	
	<div class="portlet light bordered">
		
		<div class="portlet-title">
			
			<div class="caption font-dark">

                <i class="fa fa-flag font-dark"></i>
                
                <span class="caption-subject bold uppercase"> IDIOMAS</span>
                
            </div>
			
		</div>
		
		<div class="portlet-body todo-project-list-content" style="height: auto;">
			
            <div class="todo-project-list">
            	
                <ul class="nav nav-stacked">
                	
                	<?php foreach ($this->Main_model->get_languages() as $key => $value): ?>
						
						<li><a href="<?= site_url($value->iso_language.'/'.$param.'/edit/') ?>"><span class="badge badge-success"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></span> <?= $value->name_iso_language ?> </a></li>
						
					<?php endforeach ?>
                	
                    
                    
                </ul>
                
            </div>
            
        </div>
		
	</div>
	
</div>