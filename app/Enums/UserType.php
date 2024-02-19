<?php 

namespace App\Enums;

use App\Traits\EnumToArray;

enum UserType: string {
  use EnumToArray;
  case USER = 'user';
  case ADMIN = 'admin';

  public function toString(): string {
    return match($this){
      self::USER => 'user',
      self::ADMIN => 'admin'
    };
  }
}