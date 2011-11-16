$(document).ready(function()
{
	$('input[type!="submit"]').focusin(function()
	{
		element = $(this);
		if(element.attr('value') == element.attr('title'))
		{
			element.attr('value', '');
			element.css('color', '#333');
		}
	});
	$('input[type!="submit"]').focusout(function()
	{
		element = $(this);
		if(element.attr('value') == '')
		{
			element.attr('value', element.attr('title'));
			element.css('color', '#ccc');
		}
	});
});