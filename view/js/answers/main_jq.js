function Answer(){
	var enableSubmit = function(){
		//var text = Y.Lang.trim(Y.one('#ls_add_question_text').get('value'));
		var text = $('#lr_add_answer_text').val();
		if (text){
			$('#lr_add_answer_submit').css('display','');
			$('#lr_add_answer_submit_disabled').css('display','none');
			$('#lr_add_answer_text').attr('class','textarea-focused');
		}else{
			$('#lr_add_answer_submit').css('display','none');
			$('#lr_add_answer_submit_disabled').css('display','');
			$('#lr_add_answer_text').attr('class','');
		}
	};
	var addAnswer = function(){
		var text = $('#lr_add_answer_text').val();//Y.Lang.trim(Y.one('#ls_add_question_text').get('value'));
		var questionid = $('#lr_question_id').val();
		var postdata = "action=add&text="+text+"&questionid="+questionid;
  var url = LrConstants.approot+"ws/answers_ws.php";
		$.ajax({
			url: url,
			type:'POST',
			data: postdata,
			dataType:'json',
			error:function(e){console.log(e);},
			success:function(data){
				listAnswers();
			}
		});	
	};
	var listAnswers = function(){
		var url = LrConstants.approot+"ws/answers_ws.php";
		var questionid = $('#lr_question_text').attr('questionid');
		var data = "action=list&questionid="+questionid;
		var callback = function(data) {
			var answerlist = data;
			$("#ls_list_questions ul").html('');
			var finalListItems = '';
			$("#lr_list_answers ul").html('');
			if(answerlist.length){
				for(var i=0;i< answerlist.length;i++){
					var listitem = '<li class="lr_question_list_content"><div class="lr_user_image"></div><div class="lr_question_text">'+answerlist[i].answer_text+'</div>'+
					'<div style="clear:both"></div>';
					finalListItems += listitem;
				}
				$("#lr_list_answers ul").html(finalListItems);
			}else{
				$("#lr_list_answers ul").html('No answers yet!');
			}
		};
		$.ajax({
			url: url,
			type: 'GET',
			dataType:'json',
			data: data,
			error:function(e){console.log(e);},
			success:callback
		});
	 };
	return {
		init: function(){
			listAnswers();
			$('#lr_add_answer_text').keyup(enableSubmit);
			$('#lr_add_answer_submit').click(addAnswer);
		}
	};
};
