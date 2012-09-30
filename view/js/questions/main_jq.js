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
		var subjectName;
		$('#lr_subject_list ul li').each(function(index,value){
			if($(value).hasClass('selected')){
				subjectName = $(value).attr('id');	
			}
		});
		var text = $('#ls_add_question_text').val();//Y.Lang.trim(Y.one('#ls_add_question_text').get('value'));
		var tags = $('#lr_add_question_tags').val();//Y.one('#lr_add_question_tags').get('value');
		var subject = subjectName;
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
		var subjectName;
		if($(this).hasClass('lr_subject_list_item')){
			$('#lr_subject_list ul li').each(function(index,value){
				if($(value).hasClass('selected')){
					$(value).removeClass('selected')
				}
			});
			$(this).addClass('selected');
			subjectName = $(this).attr('id');
			subjectTitle = $(this).html();
			$('#lr_user_subscriptions').html(subjectTitle);
		}else{
			$('#lr_subject_list ul li').each(function(index,value){
				if($(value).hasClass('selected')){
					subjectName = $(value).attr('id');	
					subjectTitle = $(this).html();
					$('#lr_user_subscriptions').html(subjectTitle);
				}
			});
		}
		$('#lr_user_subscriptions').append("<span class='caret'></span>");
		var url = "ws/questions_ws.php?action=list";
		var callback = function(data) {
			var questionlist = data;
			$("#ls_list_questions ul").html('');
			var finalListItems = '';
			if(questionlist.length){
				for(var i=0;i<questionlist.length;i++){
					var qid = questionlist[i].id;
					var tagList = questionlist[i].tags.split(',');
					var tagSpan = '';
	//				for(var j=0;j<tagList.length;j++){
	//					if(tagList[j] && tagList[j] != 'Enter Tags'){
	//						tagSpan += '<li><a href="#">'+tagList[j]+'</a></li> ';
	//					}
	//				}
					var listitem = '<div class="row">'+
					//'<div class="span1"><i class="icon-search"></i></div>'+
					'<div class="span10">'+
					'<li class="lr_question_list_content"><div class="lr_user_image"></div>'+
					'<div class="lr_question_text" id="lr_question_text_'+qid+'">'+
					questionlist[i].question_text+'</div>'+
					'<div class="clear:both"></div>'+
					'<span id="lr_question_answer_link_'+qid+'" questionid="'+qid+'" class="lr_question_answer_link label label-info" value="'+questionlist[i].answer_count+'">'+
					questionlist[i].answer_count+' answers</span>'+
					'<div class="clear:both"></div>'+
			'<a questionid="'+qid+'" href="#lrAddAnswerForm" role="button" class="label label-default lr_question_answer_post_link" data-toggle="modal" id="lr_question_answer_post_link_'+qid+'">'+
					'Answer this question</a>'+
					'<ul id="lr_question_answers_'+questionlist[i].id+'"></ul>'+
					'<ul class="tags">'+tagSpan+'</ul></li>'+
					'</div></div>';
					finalListItems += listitem;
				}
			}else{
				finalListItems = '<div class="alert alert-info">Sorry! No Questions here yet!</div>';
			}
			$("#ls_list_questions ul").html(finalListItems);
			$('#lrAddQuestionForm').modal('hide');
		};
		$.ajax({
			url: url,
			type: 'GET',
			dataType:'json',
			data: 'action=list&subject='+subjectName,
			error:function(e){console.log(e);},
			success:callback
		});
		};
	var listAnswers = function(data){
		var url = "ws/answers_ws.php";
		var questionid = '';
		var incrementCount = 0;
		if(data.qid){
			questionid = data.qid;
			incrementCount = 1;
		}else{
			questionid = $(this).attr('questionid');
		}
console.log(questionid);
		var elementId = $(this).attr('id');
		var data = "action=list&questionid="+questionid;
		$("#lr_question_answers_"+questionid).html('Loading...');
		var callback = function(data) {
			var answerlist = data;
			var finalListItems ='';
			$("#lr_question_answers_"+questionid).html('');
			if(answerlist.length){
				for(var i=0;i< answerlist.length;i++){
					var listitem = '<li class="lr_question_list_content"><div class="lr_user_image"></div><div class="lr_question_text">'+answerlist[i].answer_text+'</div>'+
					'<div style="clear:both"></div>';
					finalListItems += listitem;
					if(incrementCount){
						var qcount = $('#lr_question_answer_link_'+questionid).attr('value');
						qcount++;
						$('#lr_question_answer_link_'+questionid).html(qcount+' answers');
					}
				}
			}else{
				finalListItems = '<div class="alert alert-info">Sorry! No Answers here yet!</div>';
			}
			$("#lr_question_answers_"+questionid).html(finalListItems);
			$('#lrAddAnswerForm').modal('hide');
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
	var addAnswer = function(data){
        var postdata = "action=add&text="+data.answerText+"&questionid="+data.qid;
		var url = "ws/answers_ws.php";
console.log(postdata);
		var qid = data.qid;
        $.ajax({
            url: url,
            type:'POST',
            data: postdata,
            dataType:'json',
            error:function(e){console.log(e);},
            success:function(data){
				var dataObj = {qid:qid};
                listAnswers(dataObj);
            }
        });
    };
	return {
		init: function(){
			listQuestions();
			$('#ls_add_question_text').keyup(enableSubmit);
			$('#ls_add_question_submit').click(addQuestion);
			$('#lr_add_question').click(function(){$('#lr_add_question_form').css('display','block');});
			$('#ls_add_question_cancel').click(function(){$('#lr_add_question_form').css('display','none');});
			$('.lr_question_answer_link').live('click',listAnswers);
			$('.lr_subject_list_item').click(listQuestions);
			$('.lr_question_answer_post_link').live('click',function(){
				var qid = $(this).attr('questionid');
				var qHtml = $("#lr_question_text_"+qid).html();
				$('#lr_modal_question_text').html(qHtml);
				$('#lr_add_answer_submit').attr('qid',qid);
			});
			$('#lr_add_answer_submit').click(function(){
				var text = $('#lr_add_answer_text').val();//Y.Lang.trim(Y.one('#ls_add_question_text').get('value'));
				var questionid = $('#lr_question_id').val();
				var qid = $(this).attr('qid'); 
				addAnswer({qid:qid,answerText:text});
			});
		}
	};
};
