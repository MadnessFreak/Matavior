/* Matavior JavaScript */

/* http://jquery-howto.blogspot.de/2009/09/get-url-parameters-values-with-jquery.html */
function getUrlQuery()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function scrollTo(element, shift){
     $('html, body').animate({ scrollTop: ($(element).offset().top + shift)}, 'slow');
};

function notyflyout() {
	event.preventDefault();

	var notification = $(event.target).data('object-id');
	var link = $(event.target).attr('href');
	var jqxhr = $.ajax({
		type: "POST",
		url: '/notifications',
		data: 'readnoty=true&notificationID=' + notification,
		dataType: 'json'
	})
	.always(function(response) {
		if (response.sucess == true) {
			document.location.href = link;
		} else {
			console.log("Ajax Request Failed");
			console.log("Error Type: " + response.error.type)
			console.log("Error Code: " + response.error.code);
			console.log("Error Message: " + response.error.message);
			delete window.alert;
			alert("An error occurred while processing your request");
		}
	})
	.done(function() {
		//console.log('done');
	})
	.fail(function() {
		//console.log('fail');
	});
};

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

$(document).ready(function() {
	/*var hash = document.location.hash;
	if (hash) {
		$('.nav-tabs a[href="' + hash + '"]').tab('show');
	}*/

	var hash = getUrlQuery();
	if (hash["tab"]) {
		$('.nav-tabs a[href="#' + hash["tab"] + '"]').tab('show');

		if (hash["tab"] == "wall") {
			var anchor = $('.tab-content #wall .entry[data-object-id="' + hash["entry"] + '"]');
			scrollTo(anchor, -75);
			anchor.addClass('highlight');
		}
	}
});