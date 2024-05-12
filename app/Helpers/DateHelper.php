<?php
function dateFormat($date)
{
    return date("d/m/Y", strtotime($date));
}
function datetimeFormat($datetime)
{
    return date("d/m/Y h:i A", strtotime($datetime));
}
?>