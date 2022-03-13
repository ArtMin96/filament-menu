<?php

if (!function_exists('wireKey')) {
    function wireKey(?string $id = null): ?string
    {
        return time() . mt_rand(1000000000, 9999999999) . $id ?: null;
    }
}
