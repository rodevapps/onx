<?php

class Pipeline
{
    public static function make(...$args)
    {
        return function($arg) use ($args) {
          $res = $arg;

          foreach($args as $f) {
            $res = $f($res);
          }

          return $res;
        };
    }
}

$res = Pipeline::make(function($var) { return $var * 3; }, function($var) { return $var + 1; }, function($var) { return $var / 2; });
print $res(3) . "\n";
