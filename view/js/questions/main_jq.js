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
			success:function(data){
				listQuestions();
			}
		});	
	};
	var listQuestions = function(){
   var url = "ws/questions_ws.php?action=list";
   var callback = function(data) {
     var questionlist = data;//jQuery.parseJSON(data);//.responseText);
     //questionlist = questionlist;//.resultlist;
     $("#ls_list_questions ul").html('');
					var finalListItems = '';
     for(var i=0;i<questionlist.length;i++){
     //for(var i=0;i<2;i++){
      var tagList = questionlist[i].tags.split(',');
      var tagSpan = '';
      for(var j=0;j<tagList.length;j++){
       if(tagList[j]){
        tagSpan += '<li><a href="#">'+tagList[j]+'</a></li> ';
       }
      }
      var listitem = '<li class="lr_question_list_content"><div class="lr_user_image"></div><div class="lr_question_text">'+questionlist[i].question_text+'</div>'+
          '<ul><a href="question/index.php?id='+questionlist[i].id+'"><li class="lr_question_answer_link">Answer this question</li></a></ul>'+
          '<div style="clear:both"></div>'+
          '<ul class="tags">'+tagSpan+'</ul><div style="clear:both"></li>';
						finalListItems += listitem;
     }
					$("#ls_list_questions ul").html(finalListItems);
   };
			$.ajax({
				url: url,
				type: 'GET',
				dataType:'json',
				data: 'action=list',
				error:function(e){console.log(e);},
				success:callback
			});
 };
	return {
		init: function(){
			listQuestions();
			$('#ls_add_question_text').keyup(enableSubmit);
			$('#ls_add_question_submit').click(addQuestion);
			$('#lr_add_question').click(function(){$('#lr_add_question_form').css('display','block');});
			$('#ls_add_question_cancel').click(function(){$('#lr_add_question_form').css('display','none');});
		}
	};
};
