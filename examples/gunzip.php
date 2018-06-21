<?php

require __DIR__ . '/../src/pressme.php';

$pressMe = new pressme();

$decompress = $pressMe->fileDecompressor('text.1529585704.txt');

var_dump($decompress);