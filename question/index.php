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
	<div class="lr_add_answer"><a id="lr_add_question" class="button_action">Add Answer</a></div>
	<div style="clear:both"></div>
	<div id="lr_add_question_form" class="form lr_add_question_form" style="display:none;">
		<textarea id="ls_add_question_text" onfocus="if(this.value == 'Got a question?') {this.value=''}" cols="68" onblur="if(this.value == ''){this.value ='Got a question?'}">Got a question?</textarea>
		<br />
		<br />
		<input type="text" id="lr_add_question_tags"  value="Enter Tags" class="textbox lr_add_question_tags" onfocus="if(this.value == 'Enter Tags') {this.value=''}" onblur="if(this.value == ''){this.value ='Enter Tags'}" size="57"/>
		<div>
			<a id="ls_add_question_submit" class="button float-left" style="display:none;">Ask!</a>
			<a id="ls_add_question_submit_disabled" class="button_inactive float-left">Ask!</a>
			<a id="ls_add_question_cancel" class="button float-left">Cancel</a>
		</div>
		<div style="clear:both"></div>
	</div>

<script src="http://yui.yahooapis.com/3.5.1/build/yui/yui-min.js"></script>
<script type="text/javascript" src="/view/js/main.js"></script>
<script type="text/javascript">
</script>
<?php require_once(FILE_ROOT.'view/footer.inc'); ?>
