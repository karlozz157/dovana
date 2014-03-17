	var Chart = function()
	{
		return {
			init: function()
			{
				var options = {
					series: {
						pie: {
							show: true,
				        	radius: 1,
				        	label: {
				        		show: true,
				               	formatter: function (label, series) {
				                	return '<div style="background:rgba(0, 0, 0, .5);font-size:8pt;text-align:center;padding:2px 5px;color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
				            	},
				        	},
				    	},
				    	legend: {
				    		show: true
				    	},
					},
				}

				$.plot('#chart-products', chartProduct, options);
			}
		}
	}();

	var Validate = function()
	{
		return {
			init: function()
			{
				$('#validate-form').validationEngine();
			}
		}
	}();


	var Product = function()
	{
		return {
			init: function()
			{
				$('.delete-image-product').on('click', function()
				{
					var element = $(this);

					$.post(base_url + 'admin/deleteImageProduct/' + $(this).attr('data-id'), function(data)
					{
						var data = $.parseJSON(data);
						
						if(data.success)
							element.parent().remove();

					});
				});
			}
		}
	}();