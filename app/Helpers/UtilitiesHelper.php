<?php

// If title is blank then use date as slug
function generateSlug( $title ) {
    if ($title) {
        return Str::slug($title, '-');
    }
    return now()->format('Y-m-d-His');
}

function readMore($text, $maxLength = 100, $suffix = '...') {
    $text = strip_tags($text);
    $truncatedText = mb_substr($text, 0, $maxLength);
    if (mb_strlen($text) > $maxLength) {
        $truncatedText .= $suffix;
    }
    return $truncatedText;
}

?>