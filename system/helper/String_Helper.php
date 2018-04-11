<?php  if(!defined('PATH_SYSTEM')) die('Bad request!');

//Convert character to number

function string_to_int($str) {
  return sprintf("%u", crc32($str));
}
