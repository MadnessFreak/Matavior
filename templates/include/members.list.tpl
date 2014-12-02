<header class="headline">
	<h3>Members <span class="badge">{{ membersCount }}</span></h3>
</header>

{% include 'pagination.tpl' %}

<div class="members">
	{% for member in members|slice(membersStart,membersEnd) %}
	<div>
		<div><img src="/images/avatar/default.png"></div>
		<div><h5><a href="/members/profile/{{ member.username }}">{{ member.username }}</a>&nbsp;<span class="label label-success">Online</span><br><small>{{ member.groupName }}</small></h5></div>
	</div>
	{% endfor %}
</div>

{% include 'pagination.tpl' %}

<style type="text/css">
.members { margin: 10px 0 10px 0; }
.members > div { 
	width: 100%;
	border-top: 1px solid #ddd;
	border-left: 1px solid #ddd;
	border-right: 1px solid #ddd;
	padding: 10px;
	overflow: hidden;
}
.members > div:hover { background-color: #f5f5f5; }
.members > div:first-child { border-radius: 4px 4px 0 0; }
.members > div:last-child { border-radius: 0 0 4px 4px; border-bottom: 1px solid #ddd; }
.members > div > div { float: left; padding: 5px; display: block; }
</style>