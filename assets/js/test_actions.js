var TestActions = {

	TipoTest : function(){

		$('.testType').click(function(){

	      var type = $(this).val();
        $('input[name="param1"]').val($(this).val());

        if(type == 1 || type == 3){

          $("#gTest").show();
					$("#themes").hide();
          $("#typeQuestion").hide();

        }else if(type == 2){

          $("#gTest").hide();
          $("#typeQuestion").show();

        }

		});

  },

	TipoQt : function(){

		$('.typeQ').click(function(){

	      var type = $(this).val();
        $('input[name="param2"]').val($(this).val());

        if(type == 1){

          $("#gTest").show();
          $("#themes").show();

        }else if(type == 2){

          $("#gTest").hide();
          $("#themes").show();

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

	GetResponse : function(){

    $('input[name="response"]').click(function(){

			$('.modal').show();
			$('.content-preload').text('Guardando tu respuesta...');

      var value = $(this).val();
			var evaluacionId = $(this).attr('evalId');
			var questionId = $(this).attr('quId');

      var type = 'POST';
      var url = site_url+'/test/get_response';
    	var data = {'value':value,'evaluacionId':evaluacionId,'questionId':questionId};
			ActionAjax(type,url,data,null,null,false,false);

			setTimeout(function(){

				$('.modal').hide();
				$('.content-preload').text('');

			}, 2000);

    });

  },

	EndTest : function(){

    $('.endTest').click(function(){

			$('.modal').show();
			$('.content-preload').text('Estamos corrgiendo tu Test. Un momento por favor.');

			var evaluacionId = $(this).attr('evalId');
			var testId = $(this).attr('testId');
			var timeR = $(this).attr('timeR');


      var type = 'POST';
      var url = site_url+'/test/evaluation_test';
    	var data = {'evaluacionId':evaluacionId,'testId':testId,'timeR':timeR};
			var returndata = ActionAjax(type,url,data,null,null,true,false);

			setTimeout(function(){

				$('.modal').hide();
				$('.content-preload').text('');
				window.location.href = returndata;

			}, 2000);

    });

  },

}

$(window).load(TestActions.TipoTest);
$(window).load(TestActions.GeneratedTest);
$(window).load(TestActions.TipoQt);
$(window).load(TestActions.GetResponse);
$(window).load(TestActions.EndTest);
