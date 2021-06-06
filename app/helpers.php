<?php

function presentPrice($price)
{
  return  number_format($price) . 'đ';
}

function convertNumberFormatToInteger($number_format) {
  return (int) filter_var($number_format, FILTER_SANITIZE_NUMBER_INT);
}
function setActiveCategory($category, $output = 'active')
{
  return request()->category == $category ? $output : '';
}

function parseDate($date) {
  return \Carbon\Carbon::parse($date)->format('d-m-Y');
}

function loadImageViaS3($file, $default = '')
{
  if (!empty($file) && !filter_var($file, FILTER_VALIDATE_URL)) {
    return str_replace('%5C', '/', \Illuminate\Support\Facades\Storage::disk(config('voyager.storage.disk'))->url($file));
  }elseif(filter_var($file, FILTER_VALIDATE_URL)) {
    $out = str_replace('%5C', '/', $file);
    return $out;
  }

  return $default;
}
