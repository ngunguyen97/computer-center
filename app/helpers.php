<?php

function presentPrice($price)
{
  return  number_format($price) . 'đ';
}
function setActiveCategory($category, $output = 'active')
{
  return request()->category == $category ? $output : '';
}
