<?php 
	require_once('../config.php');
	require_once(FILE_ROOT.'/view/header.inc'); 
?>
<?php
	require_once(FILE_ROOT.'/addfbuser.php');
	require_once(FILE_ROOT.'/data.ini');
	$fbuser = new fbUser;
	$fbuser->add_user($user_profile);
	require_once(FILE_ROOT.'/ws/questions_ws.php');
?>
<div id="lr_content" class="content">
	<div id="lr_question_text" class="lr_question_info">
	<?php
		$request = new WS;
		$questioninfo = $request->questionInfo($_REQUEST,'1');
		echo $questioninfo['resultlist'][0]['question_text'];
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
<script src="http://yui.yahooapis.com/3.5.1/build/yui/yui-min.js"></script>
<script type="text/javascript" src="<?php echo APP_ROOT."/view/js/answers/main.js" ?>"></script>
<script type="text/javascript">
YUI().use('lr-answer', function (Y) {
    Y.LrAnswer.init();
    Y.one('#lr_add_answer_text').set('value','Answer here')
});	
</script>
<?php require_once(FILE_ROOT.'view/footer.inc'); ?>
