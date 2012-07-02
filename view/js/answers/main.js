YUI().add('lr-answer',function(Y){
	Y.namespace('LrAnswer');
	var YAHOO = Y.YUI2;
	Y.LrAnswer = {
		init: function(){
			privateFunc.listAnswers();
			Y.on('keyup',privateFunc.enableSubmit,'#lr_add_answer_text');
			Y.on('click',privateFunc.addAnswer,"#lr_add_answer_submit");
		}
	};	
	var privateFunc = {
		enableSubmit : function(){
			var text = Y.Lang.trim(Y.one('#lr_add_answer_text').get('value'));
			if (text){
				Y.one('#lr_add_answer_submit').setStyle('display','');
				Y.one('#lr_add_answer_submit_disabled').setStyle('display','none');
				Y.one('#lr_add_answer_text').setAttribute('class','textarea-focused');
			}else{
				Y.one('#lr_add_answer_submit').setStyle('display','none');
				Y.one('#lr_add_answer_submit_disabled').setStyle('display','');
				Y.one('#lr_add_answer_text').setAttribute('class','');
			}
		},
		addAnswer: function(){
			var text = Y.Lang.trim(Y.one('#lr_add_answer_text').get('value'));
			var questionid = Y.one('#lr_question_id').get('value');
			var postdata = "text="+text+"&questionid="+questionid;
			var url = LrConstants.approot+"ws/answers_ws.php?action=add";
			var callback = {
				success:function(id,o,args){
					Y.one("#lr_list_answers ul").set('innerHTML','Loading Questions...');
					privateFunc.listAnswers();
					Y.one('#lr_add_answer_text').set('value', 'Got a question?');
					//Y.one('#ls_add_answer_text').setAttribute('class','');
				},
				failure:function(){}
			};
			var request = YAHOO.util.Connect.asyncRequest('POST', url, callback, postdata);
		},
		listAnswers: function(){
			var url = LrConstants.approot+"ws/answers_ws.php?action=list";
			var callback = {
				success:function(data) {
					var answerlist = JSON.parse(data.responseText);
					answerlist = answerlist.resultlist;
					Y.one("#lr_list_answers ul").set('innerHTML','');
					for(var i=0;i< answerlist.length;i++){
						var listitem = '<li class="lr_question_list_content"><div class="lr_user_image"></div><div class="lr_question_text">'+answerlist[i].answer_text+'</div>'+
										'<div style="clear:both"></div>';
						Y.one("#lr_list_answers ul").append(listitem);
					}
				},
				failure:function(){
				}
			};
			var request = YAHOO.util.Connect.asyncRequest('GET', url, callback);
		}
	};
}, '0.0.1', {requires: ['node','io', 'json-parse','yui2-connection']});
