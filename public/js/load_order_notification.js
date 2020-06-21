window.onload = function ()
{

    $('#order_notification').load(document.getElementById('updateNotificationCounter').value).fadeIn("slow");


    $('#order_notification1').load(document.getElementById('updateNotificationCounter').value).fadeIn("slow");

    $('#order_notification_dropdown').load(document.getElementById('ordersNotification').value).fadeIn("slow");

}

var auto_refresh = setInterval(function ()
{
    $('#order_notification').load(document.getElementById('updateNotificationCounter').value).fadeIn("slow");


    $('#order_notification1').load(document.getElementById('updateNotificationCounter').value).fadeIn("slow");

    $('#order_notification_dropdown').load(document.getElementById('ordersNotification').value).fadeIn("slow");
},4000);
