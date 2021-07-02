<?php

$dir_iterator = new RecursiveDirectoryIterator("blocks/");
$iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);
// could use CHILD_FIRST if you so wish

foreach ($iterator as $file) {
    if (!preg_match('#.scss$#si', $file)) {
        continue;
    }

    //$file = 'blocks/catalog/catalog.scss';

    print 'SCSS: ' . $file . "\n";
    $blockDir = dirname(substr($file, strpos($file, '/') + 1));
    print 'Block dir: ' . $blockDir . "\n";

    $imageDir = 'new/img/' . $blockDir;
    print 'Image dir: ' . $imageDir . "\n";
    @mkdir($imageDir, 0777, true);

    $images = glob(dirname($file) . '/assets/img/*');

    foreach ($images as $image) {
        copy($image, $imageDir . '/' . basename($image));
    }

    $scss = file_get_contents($file);
    $scss = preg_replace_callback('#url\((.*)\)#siuU', function ($matches) use ($blockDir) {
        $file = trim($matches[1], '\'"');
        $file = basename($file);//str_replace('assets/img', '', $file);
        $file = 'url(img/' . $blockDir . '/' . $file . ')';

        return $file;
    }, $scss);

    $scss = trim(preg_replace('#^@import.*$#smiuU', '', $scss));
    //print $scss;
    file_put_contents('new/scss/' . basename($file), $scss);

    /*$newFile = substr($file, strpos($file, '/') + 1);
    $newDir = 'new/img/' . str_replace('assets/img', '', dirname($newFile));

    @mkdir($newDir, 0777, true);
    print $file . ' ' . $newDir . basename($file) . "\n";
    copy($file, $newDir . basename($file));*/
    print "\n";
}
