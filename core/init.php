<?php
session_start();

spl_autoload_register(function ($class) {
  $parts = explode('\\', $class);
  include_once 'classes/' . end($parts) . '.php';
});
