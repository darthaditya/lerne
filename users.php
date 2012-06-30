<?php require_once('view/header.inc'); ?>  
<div id="bd">
	<div id="yui-main">
		<div class="yui-b">
			<div class="yui-g">
				<div id="usersearchresults">
				</div>
			</div>
		</div>
	</div>
	<div class="yui-b">
		<input type="text" id="search-user" placeholder="Search a user"/>
	</div>
	
</div>
<script src="http://yui.yahooapis.com/3.4.1/build/yui/yui-min.js"></script>
<script type="text/javascript" src="view/js/constants.js"></script>
<script type="text/javascript" src="view/js/users.js"></script>
<script type="text/javascript">
YUI().use('stock-user',function(Y){
        Y.delegate('keyup',Y.Stock.User.Search,'body',"#search-user");
        Y.delegate('click',Y.Stock.User.follow,"body","#usersearchitem");
});
</script>
<?php require_once('view/footer.inc'); ?>
