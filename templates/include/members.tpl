{% if REQUEST_ACTION == empty or REQUEST_ACTION == 'page' %}
	{% include 'include/members.list.tpl' %}
{% elseif REQUEST_ACTION == 'profile' %}
	{% include 'include/members.profile.tpl' %}
{% else %}
	{% include 'illegalLink.tpl' %}
{% endif %}