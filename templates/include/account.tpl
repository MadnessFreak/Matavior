<header class="headline">
	<h3>Account</h3>
	<hr>
</header>

<div class="row">
	<div class="col-lg-12">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#general" data-toggle="tab">{{ 'mata.global.general'|lang }}</a></li>
			<li><a href="#security" data-toggle="tab">{{ 'mata.global.security'|lang }}</a></li>
		</ul>
		<form class="form-horizontal tab-content" role="form" method="post">
			<div class="tab-pane fade in active" id="general">
				{% include 'include/account.general.tpl' %}
			</div>
			<div class="tab-pane fade" id="security">
				{% include 'include/account.security.tpl' %}
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">{{ 'mata.global.button.submit'|lang }}</button>
					<button type="reset" class="btn btn-default">{{ 'mata.global.button.reset'|lang }}</button>
				</div>
			</div>
		</form>
	</div> <!-- col -->
</div> <!-- row -->