<?php
require_once 'core/init.php';

use Config\Config;
use DB\DB;

echo '<pre>';
var_dump(Config::get('baza'));
echo '</pre>';

$bazaSingleton = DB::getInstance(Config::get('baza'));

echo '<pre>';
var_dump($bazaSingleton->getConnection());
echo '</pre>';

echo '<pre>';
var_dump($bazaSingleton->getTasks());
echo '</pre>';

$bazaSingleton->createTask('Platiti račun u pošti');
