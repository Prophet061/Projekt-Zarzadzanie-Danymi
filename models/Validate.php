<?php namespace app\models;
      use Yii;

class Validate{
  public static function validate($text, $type, $min = false, $max = false){
    $result = true;
    if($min != false && strlen($text) < $min ) $result =  false;
    if($max != false && strlen($text) > $max ) $result =  false;

    switch ($type) {
      case 'url':
        $test = filter_var($text, FILTER_VALIDATE_URL);
        if(!$test) $result =  false;
        break;

      case 'password':
        $uppercase = preg_match('/[A-ZĘÓĄŚŁŻŹĆŃ]/', $text);
        $lowercase = preg_match('/[a-zęóąśłżźćń]/', $text);
        $number    = preg_match('/[0-9]/', $text);
        if(!$uppercase || !$lowercase || !$number || strlen($text) < 8) $result =  false;
        break;

      case 'date':
        $date = explode("-", $text);
        $test = checkdate((int)$date[1], (int)$date[2], (int)$date[0]);
        if(!$test) $result =  false;
        break;

      case 'time':
        $test = preg_match('/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/', $text);
        if(!$test) $result =  false;
        break;

      case 'email':
        $test = filter_var($text, FILTER_VALIDATE_EMAIL);
        if(!$test) $result =  false;
        break;

      case 'mobile':
        $test = preg_match('/[+48] [0-9]{3} [0-9]{3} [0-9]{3}/', $text);
        if(!$test) $result =  false;
        break;

      case 'zipcode':
        $test = preg_match('/[0-9]{2}[-]{1}[0-9]{3}/', $text);
        if(!$test) $result =  false;
        break;

      case 'city':
        $test = preg_match('/[^a-zA-ZęóąśłżźćńĘÓĄŚŁŻŹĆŃ\s\-]/', $text);
        if($test && strlen($test) > 0) $result =  false;
        break;

      case 'street':
        $test = preg_match('/[^a-zA-Z0-9ęóąśłżźćńĘÓĄŚŁŻŹĆŃ\s\-.\/]/', $text);
        if($test && strlen($test) > 0) $result =  false;
        break;

      case 'name':
        $test = preg_match('/[^0-9a-zA-ZęóąśłżźćńĘÓĄŚŁŻŹĆŃ\s\-.]/', $text);
        if($test && strlen($test) > 0) $result =  false;
        break;

      case 'first_name':
        $test = preg_match('/[^a-zA-ZęóąśłżźćńĘÓĄŚŁŻŹĆŃ\s\-]/', $text);
        if($test && strlen($test) > 0) $result =  false;
        break;

      case 'last_name':
        $test = preg_match('/[^a-zA-ZęóąśłżźćńĘÓĄŁŚŻŹĆŃ\s\-]/', $text);
        if($test && strlen($test) > 0) $result =  false;;
        break;

      case 'number':
        $test = is_numeric($text);
        if(!$test) $result =  false;
        break;
    }


    return $result;
  }
}
