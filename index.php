<?php  
	require_once('config.php');
	require_once(FILE_ROOT.'addfbuser.php');
	require_once(FILE_ROOT.'view/header.inc'); ?>
<?php
	require_once(FILE_ROOT.'data.ini');
	$fbuser = new fbUser;
	$fbuser->add_user($user_profile);
?>
<div id="lr_content" class="content">
	<div class="lr_add_question"><a id="lr_add_question" class="button_action">Add Question</a></div>
	<div style="clear:both"></div>
	<div id="lr_add_question_form" class="form lr_add_question_form" style="display:none;">
		<div class="ls_add_question_text_div">
		<textarea id="ls_add_question_text"  "ls_add_question_text" onfocus="if(this.value == 'Got a question?') {this.value=''}" cols="54" onblur="if(this.value == ''){this.value ='Got a question?'}">Got a question?</textarea>
		</div>
		<div class="lr_all_subject_list_div">
			<select id="lr_subject_list" class="lr_all_subject_list">
				<?php
					$subject = explode(',',SUBJECT_LIST);
					foreach($subject as $value){
						echo '<option>'.$value.'</option>';
					}
				?>
			</select>
		</div>
		<div class="lr_add_question_tags_div">
			<input type="text" id="lr_add_question_tags"  value="Enter Tags" class="textbox lr_add_question_tags" onfocus="if(this.value == 'Enter Tags') {this.value=''}" onblur="if(this.value == ''){this.value ='Enter Tags'}" size="57"/>
		</div>
		<div class="lr_add_question_buttons_div">
			<a id="ls_add_question_submit" class="button float-left" style="display:none;">Ask!</a>
			<a id="ls_add_question_submit_disabled" class="button_inactive float-left">Ask!</a>
			<a id="ls_add_question_cancel" class="button float-left">Cancel</a>
		</div>
		<div style="clear:both"></div>
	</div>
	<div style="clear:both"></div>
	<div class="ls_sub_content">
		<div id="ls_list_questions" class="ls_list_questions">
			<div id="lr_user_subscriptions" class="title">Recent Questions</div>
			<ul>
				Loading Questions...
			</ul>
		</div>
		<div id="lr_subject_list" class="lr_subject_list">
			<div id="lr_user_subscriptions" class="title">My Subjects</div>
			<ul>
			<?php
				$subject = explode(',',SUBJECT_LIST);
				foreach($subject as $value){
					echo '<li>'.$value.'</li>';
				}
			?>
			</ul>
		</div>
	</div>
	<div style="clear:both"></div>
<script src="http://yui.yahooapis.com/3.5.1/build/yui/yui-min.js"></script>
<script type="text/javascript" src="<?php echo APP_ROOT."/view/js/questions/main_jq.js" ?>"></script>
<script type="text/javascript">
//YUI().use('lr-question', function (Y) {
//    Y.LrQuestion.init();
//    var d = new Date();
//    Y.Cookie.set("userid", d.getSeconds());
//    Y.one('#ls_add_question_text').set('value','Got a question?')
//});
$(document).ready(function(){
	var question = new Question();
	question.init();
	var d = new Date();
	$('#ls_add_question_text').attr('value','Got a question?');
});
</script>
<?php require_once(FILE_ROOT.'view/footer.inc'); ?>

