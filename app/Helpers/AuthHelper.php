<?php

function authUserId()
{
    if (auth()->check()) {
        return auth()->user()->user_id;
    }

    return 0;
}
?>