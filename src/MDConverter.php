<?php

namespace dement0r\MDConverter;

use Exception;

class MDConverter
{
    public static function convert(string $md): string
    {
        $html = $md;
        $html = preg_replace('/^# (.*)/m', '<h1>$1</h1>', $html);
        $html = preg_replace('/^## (.*)/m', '<h2>$1</h2>', $html);
        $html = preg_replace('/^### (.*)/m', '<h3>$1</h3>', $html);
        $html = preg_replace('/\*\*(.*)\*\*/', '<strong>$1</strong>', $html);
        $html = preg_replace('/_(.*)_/', '<i>$1</i>', $html);
        $html = preg_replace('/\*(.*)\*/', '<em>$1</em>', $html);
        $html = preg_replace('/\[(.*)\]\((.*)\)/', '<a href="$2">$1</a>', $html);
        $html = preg_replace('/^\* (.*)/m', '<ul><li>$1</li></ul>', $html); // todo lists fix
        $html = preg_replace('/^\d\. (.*)/m', '<ol><li>$1</li></ol>', $html); // todo lists fix
        $html = preg_replace('/^> (.*)/m', '<blockquote>$1</blockquote>', $html);
        $html = preg_replace('/```(.*)```/s', '<pre><code>$1</code></pre>', $html);
        // при необходимости, можно обработать остальную разметку
        // lists fix:
        $html = preg_replace('/<\/ul>\s*<ul>/', '', $html);
        $html = preg_replace('/<\/ol>\s*<ol>/', '', $html);
        return $html;
    }
}
