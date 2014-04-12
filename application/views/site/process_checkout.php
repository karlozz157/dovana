<script type="text/javascript">
	var items = $.parseJSON(localStorage.simpleCart_items);

	var xhr = $.post(base_url + 'cart/addCart/', {items:items}, function(result)
	{
		var result = $.parseJSON(result);
		window.location.href = base_url + 'cart/checkout';
	});

	xhr.error(function(result)
	{
		console.log(result.responseText);
	});
</script>
<noscript>
	<h1>Your browser does not support JavaScript!</h1>
</noscript>