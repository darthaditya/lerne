YUI().add('lr-question',function(Y){
	Y.namespace('LrQuestion');
	var YAHOO = Y.YUI2;
	var askButton = Y.one('#ls_add_question_submit');
	var askText = Y.one('#ls_add_question_text');
	Y.LrQuestion = {
		init: function(){
				privateFunc.listQuestions();
				Y.on('keyup',privateFunc.enableSubmit,'#ls_add_question_text');
				Y.on('click',privateFunc.addQuestion,"#ls_add_question_submit");
			},
	};

	var privateFunc = {
		enableSubmit : function(){
			var text = Y.Lang.trim(Y.one('#ls_add_question_text').get('value'));
			if (text){
				Y.one('#ls_add_question_submit').setStyle('display','');
				Y.one('#ls_add_question_text').setAttribute('class','textarea-focused'); 
			}else{
				Y.one('#ls_add_question_submit').setStyle('display','none');
				Y.one('#ls_add_question_text').setAttribute('class','');
			}
		},
		addQuestion : function(){
			var text = Y.Lang.trim(Y.one('#ls_add_question_text').get('value'));
			var url = "/question/add";
			var postdata = "text="+text;
			var callback = {
				success:function(id,o,args){
					Y.one("#ls_list_questions ul").set('innerHTML','Loading Questions...');
					privateFunc.listQuestions();
					Y.one('#ls_add_question_text').set('value', 'Got a question?');
					Y.one('#ls_add_question_text').setAttribute('class','');
				},
				failure:function(){}
			};
			var request = YAHOO.util.Connect.asyncRequest('POST', url, callback, postdata); 
		},
		listQuestions : function(){
			var url = "ws/questions_ws.php?action=list";
			var callback = {
				success:function(data) {
					var questionlist = JSON.parse(data.responseText);
					questionlist = questionlist.resultlist;
					Y.one("#ls_list_questions ul").set('innerHTML','');
					for(var i=0;i<questionlist.length;i++){
						Y.one("#ls_list_questions ul").append('<li><div class="lr_user_image"></div><div class="lr_question_text">'+questionlist[i].question_text+'</div></li>');   
					}
				},
				failure:function(){
				}
			};
			var request = YAHOO.util.Connect.asyncRequest('GET', url, callback); 
		}
	};
}, '0.0.1', {requires: ['node','io', 'json-parse','yui2-connection','cookie']})
