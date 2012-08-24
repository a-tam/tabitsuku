<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_User_agent extends CI_User_agent {

  function __construct()
  {
    parent::__construct();
  }

  /**
   * スマートフォン(iPhone/iPod/iPad/Android)の判別
   *
   * @return type boolean
   */
  function is_smartphone(){

    $ua = $this->agent_string();
    $is_mobile = $this->is_mobile();

    if(preg_match('/iPhone|iPod|iPad|Android/i', $ua )){
      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }

}