<?php

class Utils{

  /*** USE YOUR OWN ENCRYPTION ***/
  public static function encryptPassword($password){
    return md5($password);
  }


  public static function passwordStrength($password,$strength_index=0){
    $isStrong = false;
    switch ($strength_index){
      case 0:
        $isStrong = true;
        break;
      case 1:
        # length >= 8
        if (strlen($password)>=8) $isStrong = true;
        break;
      case 2:
        # length >= 8
        # has both numbers and characters
        if (preg_match('/[A-Za-z]/', $password) && preg_match('/[0-9]/', $password)) $isStrong = true;
        break;
      case 3:
        # length >= 8
        # has both numbers and characters and a special char (symbols)
        if (preg_match('/[A-Za-z]/', $password) && preg_match('/[0-9]/', $password) && preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password)) $isStrong = true;
        break;
      default:
        break;
    }
    return $isStrong;
  }

  public static function passwordStrengthMessage($strength_index){
    $msg = "";
    switch($strength_index){
      case 1:
        $msg = "Your password must be at least 8 characters long.";
        break;
      case 2:
        $msg = "Your password must be at least 8 characters long, and contain at least one number and one letter.";
        break;
      case 3:
        $msg = "Your password must be at least 8 characters long, contain at least one number and one letter, and at least one special character or symbol.";
        break;
    }
    return $msg;
  }



  public static function getRandKey($length=8){
      if($length>0){
          $rand_id="";
          for($i=1; $i<=$length; $i++){
             mt_srand((double)microtime() * 1000000);
             $num = mt_rand(1,36);
             $rand_id .= self::randKeyAssoc($num);
          }
      }
      return $rand_id;
  }

  public static function randKeyAssoc($num){
      // accepts 1 - 36
      switch($num){
          case "1":
              $rand_value = "a";
              break;
          case "2":
              $rand_value = "b";
              break;
          case "3":
              $rand_value = "c";
              break;
          case "4":
              $rand_value = "d";
              break;
          case "5":
              $rand_value = "e";
              break;
          case "6":
              $rand_value = "f";
              break;
          case "7":
              $rand_value = "g";
              break;
          case "8":
              $rand_value = "h";
              break;
          case "9":
              $rand_value = "i";
              break;
          case "10":
              $rand_value = "j";
              break;
          case "11":
              $rand_value = "k";
              break;
          case "12":
              $rand_value = "l";
              break;
          case "13":
              $rand_value = "m";
              break;
          case "14":
              $rand_value = "n";
              break;
          case "15":
              $rand_value = "o";
              break;
          case "16":
              $rand_value = "p";
              break;
          case "17":
              $rand_value = "q";
              break;
          case "18":
              $rand_value = "r";
              break;
          case "19":
              $rand_value = "s";
              break;
          case "20":
              $rand_value = "t";
              break;
          case "21":
              $rand_value = "u";
              break;
          case "22":
              $rand_value = "v";
              break;
          case "23":
              $rand_value = "w";
              break;
          case "24":
              $rand_value = "x";
              break;
          case "25":
              $rand_value = "y";
              break;
          case "26":
              $rand_value = "z";
              break;
          case "27":
              $rand_value = "0";
              break;
          case "28":
              $rand_value = "1";
              break;
          case "29":
              $rand_value = "2";
              break;
          case "30":
              $rand_value = "3";
              break;
          case "31":
              $rand_value = "4";
              break;
          case "32":
              $rand_value = "5";
              break;
          case "33":
              $rand_value = "6";
              break;
          case "34":
              $rand_value = "7";
              break;
          case "35":
              $rand_value = "8";
              break;
          case "36":
              $rand_value = "9";
              break;
      }
      return $rand_value;
  }


}
