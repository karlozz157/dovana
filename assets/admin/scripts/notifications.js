var Notifications = function()
{
    var getNotifications = function()
    {
        $.getJSON(base_url + 'json/notifications', function(result)
        {
            var notifications = result.notifications;

            $('#count-notifications').html(notifications.count);
        
            var li = '<li><p>Tu tienes '+notifications.count+' notificaciones</p></li>';

            notifications.messages.forEach(function(message)
            {
                li += '<li><a href="'+base_url+'admin/purchase_view/'+message.id+'"><span class="subject"><span class="from"> '+message.first_name+' '+message.last_name+'</span><span style="display: block;"><b>Fecha:</b> '+message.date+'</span><span><b>Id PayPal:</b> '+message.txn_id+'</span><span style="display: block;"><b>Precio:</b> $ '+message.total+'</span></span></a></li>';
            });

            $('#notifications-list').html(li);
        });             
    }

    return {
        init : function()
        {
            getNotifications();

            setInterval(function()
            {
                getNotifications();
            }, 30000);
        }
    }
}();
