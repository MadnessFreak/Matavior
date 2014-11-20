<footer>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="list-unstyled">
					<li class="pull-right"><a href="#top">Back to top</a></li>
					<li><a href="https://github.com/MadnessFreak/Matavior/">GitHub</a></li>
					<li><a href="/contact">Contact</a></li>
					<li><a href="/about">About</a></li>
				</ul>
				<p>Made with love by <a href="http://github.com/MadnessFreak" target="_blank">MadnessFreak</a>.</p>
				<p>Based on <a href="http://getbootstrap.com" target="_blank">Bootstrap</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/" target="_blank">Font Awesome</a>. Web fonts from <a href="http://www.google.com/webfonts" target="_blank">Google</a>.</p>
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