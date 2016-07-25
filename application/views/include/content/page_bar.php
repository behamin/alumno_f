<div class="page-bar">
	
    <ul class="page-breadcrumb">
    	
        <li>
            <a href="<?= site_url() ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        
        <li>
            <span><?= $page ?></span>
            <?php if (isset($subpage)) echo '<i class="fa fa-circle"></i>' ?>
        </li>
        
        <?php if (isset($subpage)): ?>
            
            <li>
	            <span><?= $subpage ?></span>
	        </li>
            
        <?php endif ?>
        
    </ul>
    
    <div class="page-toolbar">
    	
        <div class="pull-right tooltips btn btn-sm">
        	
            <i class="icon-calendar"></i>
            
            <span class="thin uppercase hidden-xs"> 
            	<?php
            		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
					$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
            		echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
            	?>
            </span>
            
        </div>
        
    </div>
    
</div>