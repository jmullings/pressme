#!/usr/bin/php
<?php

require __DIR__ . '/../src/pressme.php';

$pressMe = new pressme();

$compressor = $pressMe->fileCompressor('text.txt');

print_r(serialize($compressor));