<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="author" content="{{ PAGE_AUTHOR }}">
    <meta name="keywords" content="{{ PAGE_KEYWORDS }}">
    <meta name="description" content="{{ PAGE_DESCRIPTION }}">

    <!-- Title -->
    <title>{{ REQUEST_PAGE|capitalize ~ ' - ' ~ PAGE_TITLE }}</title>

    <!-- Icon -->
    <link rel="icon" href="/favicon.ico">
    <link rel="shortcut icon" href="/favicon.ico">

    <link rel="apple-touch-icon" href="/images/apple-touch-icon.png">

    <!-- Boostrap stylesheet -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom stylesheet -->
    <link href="/css/matavior.css" rel="stylesheet">
  </head>
  <body>
  	{% include 'navigation.tpl' %}

  	{% include 'page.tpl' %}

  	{% include 'footer.tpl' %}

    {% include 'javascript.tpl' %}
  </body>
</html>