<?php require_once('view/header.inc'); ?>
<?php
	require_once('addfbuser.php');
	$fbuser = new fbUser;
	$fbuser->add_user($user_profile);
?>
<div id="lr_content" class="content">
	<div id="lr_add_question" class="lr_add_question">
		<textarea name="ls_add_question_text" id="ls_add_question_text" onfocus="if(this.value == 'Got a question?') {this.value=''}" onblur="if(this.value == ''){this.value ='Got a question?'}">Got a question?</textarea>
			<a id="ls_add_question_submit" class="button" style="display:none;">Ask!</a>
			<a id="ls_add_question_submit_disabled" class="button_inactive">Ask!</a>
		</div>
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
					<li>Subject 1</li>
					<li>Subject 1</li>
					<li>Subject 1</li>
					<li>Subject 1</li>
					<li>Subject 1</li>
					<li>Subject 1</li>
				</ul>
			</div>
		</div>
		<div style="clear:both"></div>
<script src="http://yui.yahooapis.com/3.5.1/build/yui/yui-min.js"></script>
<script type="text/javascript" src="view/js/main.js"></script>
<script type="text/javascript">
YUI().use('lr-question', function (Y) {
    Y.LrQuestion.init();
    var d = new Date();
    Y.Cookie.set("userid", d.getSeconds());
    Y.one('#ls_add_question_text').set('value','Got a question?')
});
</script>
<?php require_once('view/footer.inc'); ?>

