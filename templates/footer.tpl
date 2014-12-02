<footer>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="list-unstyled">
					<li class="pull-right"><a href="#top">{{ 'mata.global.backtotop'|lang }}</a></li>
					<li><a href="https://github.com/MadnessFreak/Matavior/">GitHub</a></li>
					<li><a href="/contact">Contact</a></li>
					<li><a href="/about">About</a></li>
				</ul>
				{{ 'mata.global.footer'|lang|raw }}
			</div>
			{% if EXCEPTION and ENABLE_DEBUG_MODE %}
			<div class="col-lg-12 exception">
				<p>An UserException has been occurred:</p>
				<pre>{{ EXCEPTION.Message }}</pre>
				<pre>{{ EXCEPTION.StackTrace }}</pre>
			</div>
			{% endif %}
			{% if ENABLE_DEBUG_MODE %}
			<div class="col-lg-12 exception">
				<p>Debug Information:</p>
				<pre>{% for key, value in DEBUG_INFO %}{{ key }}:{{ value }}{% endfor %}</pre>
			</div>
			{% endif %}
		</div>
	</div>
</footer>