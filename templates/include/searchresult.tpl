<header class="headline">
	<h3>Search Results</h3>
	<hr>
</header>

{% include 'pagination.tpl' %}

<div class="table-responsive searchresult">
	<div>
		<div><a href="#"><h4>Lorem ipsum dolor sit amet</h4></a></div>
		<div><p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p></div>
	</div>
	<div>
		<div><a href="#"><h4>Lorem ipsum dolor sit amet</h4></a></div>
		<div><p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p></div>
	</div>
</div>

{% include 'pagination.tpl' %}

<style type="text/css">
.searchresult { margin: 10px 0 10px 0; }
.searchresult > div { 
	width: 100%;
	border-top: 1px solid #ddd;
	border-left: 1px solid #ddd;
	border-right: 1px solid #ddd;
	padding: 10px;
	overflow: hidden;
}
.searchresult > div:hover { background-color: #f5f5f5; }
.searchresult > div:first-child { border-radius: 4px 4px 0 0; }
.searchresult > div:last-child { border-radius: 0 0 4px 4px; border-bottom: 1px solid #ddd; }
.searchresult > div > div { float: left; padding: 5px; display: block; }
</style>