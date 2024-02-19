<?php 

namespace App\Enums;

use App\Traits\EnumToArray;

enum UserType: string {
  use EnumToArray;
  case USER = 'user';
  case ADMIN = 'admin';
}