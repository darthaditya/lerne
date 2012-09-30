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
	<div class="row">
		<div id="lr_subject_list" class="dropdown">
			<h3><a id="lr_user_subscriptions" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">My Subjects</a></h3>
			<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
			<?php
				$i=0;
				$class;
				foreach($GLOBALS['SUBJECT_LIST'] as $subject => $value){
					if($i==0){
						$class='selected';
					}else{
						$class='';
					}
					echo '<li id="'.$subject.'" class="lr_subject_list_item '.$class.'"><a href="#">'.$value.'</a></li>';
					$i++;
				}
			?>
			</ul>
		</div>
		<div>
			<a href="#lrAddQuestionForm" role="button" class="btn" data-toggle="modal" id="lr_add_question">Ask a question</a>
			<div class="modal hide fade" id="lrAddQuestionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">Ask a question</h3>
				</div>
				<div class="modal-body">
					<p>One fine body…</p>
				<textarea id="ls_add_question_text"  "ls_add_question_text" onfocus="if(this.value == 'Got a question?') {this.value=''}" cols="54" onblur="if(this.value == ''){this.value ='Got a question?'}">Got a question?</textarea>
				</div>
				<div class="modal-footer form-actions">
					<button id="ls_add_question_submit" class="btn btn-primary" data-loading-text="Posting...">Ask!</button>
					<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div style="clear:both"></div>
	<div class="ls_sub_content row">
		<div id="ls_list_questions" class="ls_list_questions">
			<div id="lr_user_subscriptions" class="title">Recent Questions</div>
			<ul>
				Loading Questions...
			</ul>
		</div>
	</div>
	<div style="clear:both"></div>
<script type="text/javascript" src="<?php echo APP_ROOT."view/js/jquery-1.8.1.min.js" ?>"></script>
<script type="text/javascript" src="<?php echo APP_ROOT."view/js/questions/main_jq.js" ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
	var question = new Question();
	question.init();
	var d = new Date();
	$('#ls_add_question_text').attr('value','Got a question?');
	$('#lrAddQuestionForm').modal({show:false});
});
</script>
<?php require_once(FILE_ROOT.'view/footer.inc'); ?>
