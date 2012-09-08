function Question(){
	var enableSubmit = function(){
		//var text = Y.Lang.trim(Y.one('#ls_add_question_text').get('value'));
		var text = $('#ls_add_question_text').val();
		if (text){
			$('#ls_add_question_submit').css('display','');
			$('#ls_add_question_submit_disabled').css('display','none');
			$('#ls_add_question_text').attr('class','textarea-focused');
		}else{
			$('#ls_add_question_submit').css('display','none');
			$('#ls_add_question_submit_disabled').css('display','');
			$('#ls_add_question_text').attr('class','');
		}
	};
	var addQuestion = function(){
		var text = $('#ls_add_question_text').val();//Y.Lang.trim(Y.one('#ls_add_question_text').get('value'));
  var tags = $('#lr_add_question_tags').val();//Y.one('#lr_add_question_tags').get('value');
  var subject = $('#lr_subject_list').val();//Y.one('#lr_subject_list').get('value');
  var postdata = "text="+text+"&tags="+tags+"&subject="+subject;
  var url = "ws/questions_ws.php?action=add";
		$.ajax({
			url: url,
			type:'POST',
			data: postdata,
			dataType:'json',
			error:function(e){console.log(e);},
			success:function(data){console.log(data);}
		});	
};
	return {
		init: function(){
			$('#ls_add_question_text').keyup(enableSubmit);
			$('#ls_add_question_submit').click(addQuestion);
			$('#lr_add_question').click(function(){$('#lr_add_question_form').css('display','block');});
			$('#ls_add_question_cancel').click(function(){$('#lr_add_question_form').css('display','none');});
		}
	};
};
