<?php

namespace Config;

class Config
{
  private function __construct()
  {
  }

  public static function get($file = '')
  {
    if ($file) {
      $polje = require 'config/' . $file . '.php';
      return $polje;
    }

    return false;
  }
}
