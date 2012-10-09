<?php
require_once("../config.php");

require_once(FILE_ROOT.'data.ini');

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>An Access Controlled Page</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
</head>
<body>
	<div id="lr_content" class="content">
	<div class="row">
		<div id="lr_subject_list" class="dropdown">
			<a id="lr_user_subscriptions" class="btn dropdown-toggle" data-toggle="dropdown" href="#" role="button">My Subjects <span class="caret"></span></a>
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
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
					<h3 id="myModalLabel">Ask a question</h3>
				</div>
				<div class="modal-body">
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
			<div class="title" style="width:100%;">Recent Questions</div>
			<ul>
				Loading Questions...
			</ul>
		</div>
	</div>
	<div style="clear:both"></div>
	<div class="modal hide fade" id="lrAddAnswerForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h3 id="myModalLabel">Post an answer</h3>
		</div>
		<div class="modal-body">
		<div class="alert alert-info" id="lr_modal_question_text"></div>
		<textarea id="lr_add_answer_text" "ls_add_question_text">Write your answer here...</textarea>
		</div>
		<div class="modal-footer form-actions">
			<button id="lr_add_answer_submit" class="btn btn-primary" data-loading-text="Posting..." qid="0">Post</button>
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo APP_ROOT."view/js/jquery-1.8.1.min.js" ?>"></script>
<script type="text/javascript" src="<?php echo APP_ROOT."view/js/questions/main_jq.js" ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
	var question = new Question();
	question.init();
	var d = new Date();
	$('#ls_add_question_text').attr('value','Got a question?');
	//$('#lrAddQuestionForm').modal({show:false});
});
</script>

<div id='fg_membersite_content'>
<h2>This is an Access Controlled Page</h2>
This page can be accessed after logging in only. To make more access controlled pages, 
copy paste the code between &lt;?php and ?&gt; to the page and name the page to be php.
<p>
Logged in as: <?= $fgmembersite->UserFullName() ?>
</p>
<p>
<a href='login-home.php'>Home</a>
</p>
</div>
<?php require_once(FILE_ROOT.'view/footer.inc'); ?>
</body>
</html>
