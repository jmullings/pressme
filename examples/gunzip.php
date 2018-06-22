#!/usr/bin/php
<?php

require __DIR__ . '/../src/pressme.php';

$pressMe = new pressme();

$decompress = $pressMe->fileDecompressor('text.1529603706.txt');

print_r(serialize($decompress));