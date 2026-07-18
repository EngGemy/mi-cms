<?php

$root = dirname(__DIR__);
$dir = $root . '/storage/app/public/settings';
if (! is_dir($dir)) {
    mkdir($dir, 0775, true);
}

$w = 600;
$h = 200;
$im = imagecreatetruecolor($w, $h);
imagesavealpha($im, true);
$transparent = imagecolorallocatealpha($im, 0, 0, 0, 127);
imagefill($im, 0, 0, $transparent);

$red = imagecolorallocate($im, 200, 16, 46);
$white = imagecolorallocate($im, 255, 255, 255);

imagefilledrectangle($im, 40, 50, 160, 150, $red);
imagestring($im, 5, 72, 90, 'MI', $white);
imagestring($im, 5, 190, 90, 'MI', $red);

$path = $dir . '/logo.png';
if (! imagepng($im, $path)) {
    fwrite(STDERR, "Failed to write {$path}\n");
    exit(1);
}

imagedestroy($im);
echo "wrote {$path} (" . filesize($path) . " bytes)\n";
