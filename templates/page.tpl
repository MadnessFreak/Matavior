{% if EXCEPTION and EXCEPTION.Class != 'NotFoundException' %}
<div class="container">
  <div class="alert alert-dismissable alert-info">
    {{ EXCEPTION.Message|raw }}
  </div>
</div>
{% else%}
<div class="container" id="content">
	{% include [ 'include/' ~ REQUEST_PAGE ~ '.tpl', 'error/notfound.tpl'] %}
</div>
{% endif %}