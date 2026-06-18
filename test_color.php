<?php
ini_set('memory_limit', '256M');
$im = imagecreatefrompng('public/assets/01-logo-suryapainting18.png');
$width = imagesx($im);
$height = imagesy($im);
$colors = [];
for($x = 0; $x < $width; $x+=10) {
    for($y = 0; $y < $height; $y+=10) {
        $rgb = imagecolorat($im, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        $hex = sprintf("#%02x%02x%02x", $r, $g, $b);
        // ignore black, white, grays
        if (abs($r - $g) > 20 || abs($r - $b) > 20 || abs($g - $b) > 20) {
            if (!isset($colors[$hex])) $colors[$hex] = 0;
            $colors[$hex]++;
        }
    }
}
arsort($colors);
$top = array_slice($colors, 0, 5);
print_r($top);
