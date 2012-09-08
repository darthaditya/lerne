<?php 
	require_once('../config.php');
	require_once(FILE_ROOT.'/view/header.inc'); 
?>
<?php
	require_once(FILE_ROOT.'/addfbuser.php');
	require_once(FILE_ROOT.'/data.ini');
	$fbuser = new fbUser;
	$fbuser->add_user($user_profile);
	require_once(FILE_ROOT.'/ws/controllers/questions.php');
	$request = new question_WS;
	$questioninfo = $request->questionInfo($_REQUEST,'1');
?>
<div id="lr_content" class="content">
<div id="lr_question_text" class="lr_question_info" questionid="<?php echo $questioninfo['id']?>">
	<?php
		echo $questioninfo['question_text'];
	?>
	</div>		
	<div id="lr_list_answers" class="ls_list_questions">
		<ul>
		</ul>
	</div>
	<div style="clear:both"></div>
	<div class="lr_add_answer"><a id="lr_add_question" class="button_action">Add Answer</a></div>
	<div style="clear:both"></div>
	<div id="lr_add_question_form" class="form lr_add_question_form">
		<textarea id="lr_add_answer_text" onfocus="if(this.value == 'Answer here') {this.value=''}" cols="68" onblur="if(this.value == ''){this.value ='Answer here'}">Answer here</textarea>
		<br />
		<br />
		<input type="hidden" value="<?php echo $_REQUEST['id']; ?>" id="lr_question_id"/>
		<div>
			<a id="lr_add_answer_submit" class="button float-left" style="display:none;">Answer!</a>
			<a id="lr_add_answer_submit_disabled" class="button_inactive float-left">Answer!</a>
		</div>
		<div style="clear:both"></div>
	</div>
<?php require_once(FILE_ROOT.'view/js/constants.php'); ?>
<script type="text/javascript" src="<?php echo APP_ROOT."/view/js/jquery-1.8.1.min.js" ?>"></script>
<script type="text/javascript" src="<?php echo APP_ROOT."/view/js/answers/main_jq.js" ?>"></script>
<script type="text/javascript">
//YUI().use('lr-answer', function (Y) {
//    Y.LrAnswer.init();
//    Y.one('#lr_add_answer_text').set('value','Answer here')
//});	
$(document).ready(function(){
	var answer = new Answer();
	answer.init();
	$('#lr_add_answer_text').attr('value','Answer here')
});
</script>
<?php require_once(FILE_ROOT.'view/footer.inc'); ?>
