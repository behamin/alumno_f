<div class="col-md-12">
						
	<div class="portlet light bordered">
	
		<div class="portlet-body">
			
			<div class="table-toolbar">
				
		    	<div class="row">
		    		
		    		<div class="col-md-6">
		    			
		                <div class="btn-group">
		
		                    <?= anchor($main_lang.'/'.$param.'/add', 'Añadir <span class="fa fa-plus"></span>','id="sample_editable_1_new" class="btn sbold green"') ?>
		                    
		                </div>
		                
		            </div>
		            
		            <div class="col-md-6">
		            	
		                <div class="btn-group pull-right">
		                	
		                    <button data-toggle="dropdown" class="btn green  btn-outline dropdown-toggle" aria-expanded="false">Herramientas
		                        <i class="fa fa-angle-down"></i>
		                    </button>
		                    
		                    <ul class="dropdown-menu pull-right">
		                    	
		                        <li>
		                            <a href="javascript:;">
		                                <i class="fa fa-print"></i> Print </a>
		                        </li>
		                        
		                        <li>
		                            <a href="javascript:;">
		                                <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
		                        </li>
		                        
		                        <li>
		                            <a href="javascript:;">
		                                <i class="fa fa-file-excel-o"></i> Export to Excel </a>
		                        </li>
		                    </ul>
		                    
		                </div>
		            </div>
		
		    	</div>
		    	
		    </div>
			
			<?php $this->load->view('include/table') ?>
			
		</div>
		
	</div>

</div>