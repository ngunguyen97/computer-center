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
