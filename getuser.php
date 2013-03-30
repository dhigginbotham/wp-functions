<?php

function get_user($type = 'ID')
{
     global $current_user;
     get_currentuserinfo();

     switch ($type)
     {
          case 'ID':
               return $current_user->ID;
               break;
          case 'displayname':
               return $current_user->display_name;
               break;
          case 'username':
               return $current_user->user_login;
               break;
          case 'firstname':
               return $current_user->user_firstname;
               break;
          case 'lastname':
               return $current_user->user_lastname;
               break;
          case 'level':
               return $current_user->user_level;
               break;
          case 'email':
               return $current_user->user_email;
               break;
          default:
               return;
     }
}