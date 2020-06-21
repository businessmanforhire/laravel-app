window.onload = function ()
{

    $('#review_notification').load(document.getElementById('updateReviewCounter').value).fadeIn("slow");


    $('#review_notification').load(document.getElementById('updateReviewCounter').value).fadeIn("slow");

    $('#review_notification_dropdown').load(document.getElementById('reviewNotification').value).fadeIn("slow");

}

var auto_refresh = setInterval(function ()
{
    $('#review_notification').load(document.getElementById('updateReviewCounter').value).fadeIn("slow");


    $('#review_notification1').load(document.getElementById('updateReviewCounter').value).fadeIn("slow");

    $('#review_notification_dropdown').load(document.getElementById('reviewNotification').value).fadeIn("slow");
},4000);
