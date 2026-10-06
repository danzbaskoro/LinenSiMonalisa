<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

class ConstLogAuditrail extends Enum
{
    const loginUser  = 1;
    const logoutUser = 2;
    const createData = 3;
    const readData   = 4;
    const updateData = 5;
    const deleteData = 6;
}
