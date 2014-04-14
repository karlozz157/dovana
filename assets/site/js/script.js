// JavaScript Document
var envolturas = function()
{
	$.ajax({
		url     : base_url + 'json/getEnvolturas',
		type    : 'GET',
		async   : false,
		success : function(result)
		{	
			var result     = $.parseJSON(result);
			var envolturas = result['envolturas'];
			 envoltura = '';
			for(var i = 0; i < envolturas.length; i ++)
			{
				envoltura += '<option value="'+envolturas[i]['price']+'">'+envolturas[i]['name'].toUpperCase()+'</option>';
			}
		}
	});	
}

var Cart = function()
{
	var listCart = function()
	{
		var items    = $.parseJSON(localStorage.simpleCart_items);
		var maxTotal = 0;
		var count    = 0;

		for(item in items)
		{
			//json
			var cart  = items[item];
			var total = (parseFloat(cart.productPrice) + cart.productEnvoltura) * parseInt(cart.productQuantity);
			maxTotal += total;

			//var string
			var products = '';

			//thead
			products += '<tr><td rowspan="2"><img src="'+base_url+'assets/media/img/'+cart.productImage+'" style="display:inline-block;float:left;height:140px;margin-top:-7px;margin-bottom: 7px;vertical-align:top;width:140px;" /></td><td class="thead">PRODUCTO</td><td class="thead">CÓDIGO</td><td class="thead">PRECIO</td><td class="thead">CANTIDAD</td><td class="thead">ENVOLTURA</td><td class="thead">TOTAL</td></tr>';


			//name
			products += '<tr><td>'+cart.productName+'</td>';
			
			//sku
			products += '<td>'+cart.productSKU+'</td>';
			
			//unitary price
			products += '<td>$'+parseFloat(cart.productPrice)+'.00</td>';
			
			//stock
			products += '<td><select class="quantity-cart" id="quantity'+count+'" data-select="'+cart.productQuantity+'" data-item="'+item+'">';
			for(var i = 1; i <= cart.productStock; i++)
				products += '<option value="'+i+'">'+i+'</option>';
			
			products += '</select></td>';
			
			//envolturas
			products += '<td><select class="envoltura-cart" id="envoltura'+count+'" data-value="'+cart.productEnvoltura+'" data-item="'+item+'">';
			products += '<option value="0">SELECCIONA UNO</option>'
			products += '</select></td>';

			//total
			products += '<td><div>$'+total+'.00</div><a class="remove-cart" data-item="'+item+'" href="#"><span>ELIMINAR</span></a></td></tr>';
			
			products += '<tr class="line"><td colspan="7"></td></tr>';

			//append de products to the table
			$('#list-cart').append(products);




			//Objects combo
			var updateCombo    = $('#quantity' + count)[0];
			var envolturaCombo = $('#envoltura' + count)[0];

			$(envolturaCombo).append(envoltura);
			//set the index of the combo
			if(updateCombo)
				updateCombo.selectedIndex = ($(updateCombo).attr('data-select') -1);


				if(envolturaCombo)
					for(var i = 0; i < envolturaCombo.length; i ++)
						if(envolturaCombo.getAttribute('data-value') == envolturaCombo[i].value)
							envolturaCombo.selectedIndex = i;
			

			count++;
		}
		
		$('#total').html('TOTAL: $'+maxTotal+'.00');		
	}

	var addCart = function()
	{
        $('.add-to-cart').live('click', function(event)
        {
			event.preventDefault();        	
        	var element = $(this);

			alertify.confirm('', function (e)
			{
				if (e)
				{
					var quantity = undefined != $('#quantity').val() ? $('#quantity').val() : 1;
					var items    = $.parseJSON(localStorage.simpleCart_items);

					if(!$.isEmptyObject(items) )
					{
						for(item in items)
						{
							if(element.attr('data-product-id') == items[item].productId)
							{
								items[item].productQuantity = parseInt(items[item].productQuantity) + parseInt(quantity);
								cart = JSON.stringify(items);
								delete(localStorage.simpleCart_items);
								localStorage.simpleCart_items = cart;
							}
							else
							{
								simpleCart.add({
									productId       : element.attr('data-product-id'),
									productName     : element.attr('data-product-name'),
									productImage    : element.attr('data-product-image'),
									productSKU      : element.attr('data-product-sku'),
									productPrice    : element.attr('data-product-price'),
									productStock    : element.attr('data-product-stock'),
									productEnvoltura: 0,
									productQuantity : quantity,
								});	
							}
							break;
						}						
					}
					else
					{
						simpleCart.add({
							productId       : element.attr('data-product-id'),
							productName     : element.attr('data-product-name'),
							productImage    : element.attr('data-product-image'),
							productSKU      : element.attr('data-product-sku'),
							productPrice    : element.attr('data-product-price'),
							productStock    : element.attr('data-product-stock'),
							productEnvoltura: 0,
							productQuantity : quantity,
						});	
					}
					countItems();
				}
			});
        });		
	}

	var updateCart = function()
	{
		$('.quantity-cart').live('change',function()
		{
			var items = $.parseJSON(localStorage.simpleCart_items);
			var item  = items[$(this).attr('data-item')];
			item.productQuantity = parseInt($(this).val());
			cart = JSON.stringify(items);
			delete(localStorage.simpleCart_items);
			localStorage.simpleCart_items = cart;
			window.location.reload();
		});

		$('.envoltura-cart').live('change',function()
		{
			var items = $.parseJSON(localStorage.simpleCart_items);
			var item  = items[$(this).attr('data-item')];
			item.productEnvoltura = parseInt($(this).val());
			$(this).attr('data-value', item.productEnvoltura);
			cart = JSON.stringify(items);
			delete(localStorage.simpleCart_items);
			localStorage.simpleCart_items = cart;
			window.location.reload();
		});
	}

	var removeCart = function()
	{
		$('.remove-cart').live('click', function(event)
		{
			event.preventDefault();
			
			var items = $.parseJSON(localStorage.simpleCart_items);
			delete(items[$(this).attr('data-item')]);
			$(this).parent().parent().remove();
		    cart = JSON.stringify(items);
		    delete(localStorage.simpleCart_items);
		    localStorage.simpleCart_items = cart;
		    window.location.reload();
		});		
	}

	var countItems = function()
	{
		var items    = $.parseJSON(localStorage.simpleCart_items);
		var products = 0;

		for(item in items)
			products += parseInt(items[item].productQuantity);

		$('#cart-count').html('+' + products);
	}

	return {
		init : function()
		{
			addCart();
			countItems();
			updateCart();
			removeCart();
			listCart();
		}
	}

}();



jQuery(document).ready(function()
{
	envolturas();
	alertify.set({ buttonReverse: true });
	Cart.init();



	$.getJSON(base_url+'json/getEstados', function(result)
	{
		var option = '';
		var estado = result['estados'];

		for(var i = 0; i < estado.length; i++)
		{
			option += '<option value="'+estado[i]['clave']+'">'+estado[i]['nombre']+'</option>';
		}

		$('#estado').append(option);
	});

	$('#estado').live('change', function()
	{
		$.getJSON(base_url+'json/getMunicipios/'+$(this).val(), function(result)
		{
			$('#municipio').empty().append('<option value="">SELECCIONE UNO</option>');

			result['locations'].forEach(function(estado)
			{
				$('#municipio').append('<option value="'+estado.id+'">'+estado.nombre+'</option>');
			});
		});
	});

});