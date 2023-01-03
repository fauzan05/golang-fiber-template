<?php

namespace Fauzannurhidayat\Php\TokoOnline\Model;

class UserPasswordUpdateRequest
{
    public ?string $id = null;
    public ?string $oldPassword = null;
    public ?string $newPassword = null;
}