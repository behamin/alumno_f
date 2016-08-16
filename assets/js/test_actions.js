var TestActions = {

	TipoTest : function(){

		$('.testType').click(function(){

	      var type = $(this).val();
        $('input[name="param1"]').val($(this).val());

        if(type == 1 || type == 3){

          $("#gTest").show();
          $("#typeQuestion").hide();

        }else if(type == 2){

          $("#gTest").hide();
          $("#typeQuestion").show();

        }

		});

  },

  GeneratedTest : function(){

    $('#gTest').click(function(){

      var param1 = $('input[name="param1"]').val();
      var param2 = $('input[name="param2"]').val();

      var type = 'POST';
      var url = site_url+'/test/generated';
    	var data = {'param1':param1,'param2':param2};
			var returndata = ActionAjax(type,url,data,null,null,true,false);
			window.location = returndata;

    });

  },

}

$(window).load(TestActions.TipoTest);
$(window).load(TestActions.GeneratedTest);
