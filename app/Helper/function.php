<?php

function slug($string)
{
    return  str_replace(["--", "---", "----"],   "-",   strtolower(preg_replace("/[^a-z0-9]/i", "-", $string)));
}
