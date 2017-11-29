<?php

class Auth{

  public static function login($array,$identity_token,$access_level=0){
    session_start();
    foreach($array as $key=>$value){
      $_SESSION['auth'][$key]=$value;
    }
    $_SESSION['auth']['identity_token']=$identity_token;
    $_SESSION['auth']['access_level'] = $access_level;
    return true;
  }

  public static function is_logged_in(){
    session_start();
    if (isset($_SESSION['auth']['identity_token']) && isset($_SESSION['auth']['access_level']) ) return true;
    return false;
  }

  public static function logout(){
    session_start();
    unset($_SESSION['auth'])
    return true;
  }

}
