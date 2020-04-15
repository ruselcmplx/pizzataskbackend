<?php

namespace App\Traits;

trait RegisterUser
{
   public function registerUser($fields)
   {
      $user = \App\User::create([
         'name'      => $fields->name,
         'phone'     => $fields->phone,
         'password'  => $fields->password
      ]);
      return $user;
   }
}