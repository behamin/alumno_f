var MainActions = {

    OpenFileW: function() {

    	$( ".open-file" ).click(function() {

			  var cdm = $(this).attr('cmd');
    		$('input[name="'+cdm+'"]').trigger('click');

    	});

    	$('input[type="file"]').change(function() {

			  var cdm = $(this).attr('cmd');
    		$( 'form[name="form-'+cdm+'"]' ).submit();

    	});

    },

	CheckAction: function() {

    	$( ".md-check" ).click(function() {

			var multi = $(this).attr('multi');
			var field = $(this).attr('field');
			var table = $(this).attr('table');
			var id = $(this).attr('key');
    	var vl = 0;

			if(multi == 'false'){

				if($(this).is(":checked")){vl = 1;}

			}else{

				vl = "";
				$('input[name="'+field+'[]"]:checked').each(function() {
					vl += $(this).val() + ",";
				});
				//eliminamos la última coma.
				vl = vl.substring(0, vl.length-1);
			}

			  var type = 'POST';
        var url = site_url+'/main_controler/update_ajax';
    		var data = {'field':field,'table':table,'vl':vl,'id':id,'lang':lang};
			  var returndata = ActionAjax(type,url,data,null,null,true,false);
        if(returndata != ""){
          $(this).prop('checked', false);
          message(returndata);
        }

    	});

    },

	SelectAction: function(){

    	$( ".md-select" ).change(function() {

			var field = $(this).attr('field');
			var table = $(this).attr('table');
			var id = $(this).attr('key');
    	var vl = $(this).val();

			var type = 'POST';
        	var url = site_url+'/main_controler/update_ajax';
    		var data = {'field':field,'table':table,'vl':vl,'id':id,'lang':lang};
			ActionAjax(type,url,data,null,null,false,false);

    	});
    },

	TextAction: function(){

    	$(".md-text").keyup(function() {

			var field = $(this).attr('field');
			var table = $(this).attr('table');
			var id = $(this).attr('key');
    	var vl = $(this).val();

			action = setTimeout(function(){

  				var type = 'POST';
        		var url = site_url+'/ajax_actions/update_ajax';
    			var data = {'field':field,'table':table,'vl':vl,'id':id,'lang':lang};
				ActionAjax(type,url,data,null,null,false,false);

  			}, 2000);

    	});
    },

	ShootForm: function(){

    	$( ".md-shoot-form" ).change(function() {

			$( "#shoot" ).submit();

    	});
    },

	//// These isn't generics actions
	UpdateProductAttribute: function(){

    	$(".impact-attribute").click(function() {

			var id = $(this).attr('id');
			var id_product = $("#attribute-value-"+id).attr('key');
			var id_attribute = $("#attribute-value-"+id).attr('attribute');
			var id_attribute_value = $("#attribute-value-"+id).attr('attribute_value');
			var impact = $("#attribute-value-"+id).val();

			var type = 'POST';
        	var url = site_url+'/productos/update_product_attribute';
    		var data = {'id_product':id_product,'id_attribute':id_attribute,'id_attribute_value':id_attribute_value,'impact':impact};
			ActionAjax(type,url,data,null,null,false,false);

    	});
  },

	GeneratePass : function(){

		$('.md-get-pass').click(function(){

	      var type = 'POST';
        var url = site_url+'/usuarios/generate_pass';
    		var data = {};
        var email = $('.email').val();
        var returndata = ActionAjax(type,url,data,null,null,true,false);
    		result = JSON.parse(returndata);

    		$('.pass').val(result);

		});

  },


}

function message(message){

  Command: toastr["error"](message)

  toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "10000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
}

$(window).load(MainActions.OpenFileW);
$(window).load(MainActions.CheckAction);
$(window).load(MainActions.SelectAction);
$(window).load(MainActions.TextAction);
$(window).load(MainActions.ShootForm);
$(window).load(MainActions.UpdateProductAttribute);
$(window).load(MainActions.GeneratePass);
