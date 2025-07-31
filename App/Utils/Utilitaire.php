<?php
namespace App\Utils;
class Utilitaire{
    public static function sanitize(string $value) {
        return htmlspecialchars(strip_tags(trim($value)), ENT_NOQUOTES);
    }
}
