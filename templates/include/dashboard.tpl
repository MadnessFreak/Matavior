{% include 'pageHeader.tpl' with { 'pageTitle' : 'Dashboard' } %}

<div class="dashboard row">
	<div class="col-lg-4">
		<div class="media well">
			<a class="media-left framed" href="/members/profile/{{ account.username }}"><img src="/images/avatar/default-big.png" alt="User Avatar" style="width:80px; height:80px;"></a>
			<div class="media-body">
				<h4 class="media-heading">
					<a href="/members/profile/{{ account.username }}">{{ account.username }}</a><br>
					<small>Administrator</small>
				</h4>
				<div style="position:absolute; top:78px;">
					<a href="/account" class="btn btn-default btn-xs" role="button">{{ 'mata.global.manageAccount'|lang }}</a>
				</div>
			</div>
			<!--<hr>
			<div class="media-body">
				<h4 class="media-heading">Statistics</h4>
				<p>Bla</p>
			</div>-->
		</div>
		<div class="list-group">
			<a href="/members/profile/{{ account.username }}" class="list-group-item active">{{ 'mata.global.profile'|lang }}</a>
			<a href="/notifications" class="list-group-item">{{ 'mata.global.notifications'|lang }} <span class="badge">0</span></a>
			<a href="/messages" class="list-group-item">{{ 'mata.global.messages'|lang }} <span class="badge">2</span></a>
			<a href="/logout" class="list-group-item">{{ 'mata.global.logout'|lang }}</a>
		</div>
	</div>
	<div class="col-lg-8">
		<div class="well">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<br><br>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.<br><br>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.<br><br>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.<br><br>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis.<br><br>At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, At accusam aliquyam diam diam dolore dolores duo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet clita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero voluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur</div>
	</div>
</div>

<style type="text/css">
.dashboard hr {
	margin: 10px 0;
	border-top: 1px solid #ddd;
}
.framed > img {
	background-color: #ffffff;
	border: 1px solid #cccccc;
	padding: 1px;
}
</style>