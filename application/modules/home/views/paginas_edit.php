<div class="col-md-9">
	
	<div class="portlet light bordered">
		
		<div class="portlet-title">
			
			<?php $this->load->view('include/actions_edit') ?>
			
		</div>
		
		<div class="portlet-body form">
			
			<form role="form">
				
				<div class="form-body">
					
					<?php $this->load->view('include/form') ?>

				</div>
				
				<div class="form-actions">
					
                    <div class="row">
                    	
                        <div class="col-md-12">
                        	
                            <button name="submit_form" class="btn dark" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                            
                        </div>
                        
                    </div>
                    
                </div>
				
			</form>
			
		</div>
		
	</div>
	
</div>

<?php if (count($this->Main_model->get_languages() > 1)): ?>
	
	<?php $this->load->view('include/nav_lang') ?>
	
<?php endif ?>