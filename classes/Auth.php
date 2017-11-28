<?php

class Auth{

  public static function login($array,$identity_token,$access_level=0){
    session_start();
    foreach($array as $key=>$value){
      $_SESSION[$key]=$value;
    }
    $_SESSION['identity_token']=$identity_token;
    $_SESSION['access_level'] = $access_level;
    return true;
  }

  public static function is_logged_in($session_array){
    if (isset($session_array['identity_token']) && isset($session_array['access_level']) ) return true;
    return false;
  }

  public static function logout(){
    session_start();
    session_destroy();
    return true;
  }

}
