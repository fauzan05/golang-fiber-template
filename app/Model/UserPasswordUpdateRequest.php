<?php

namespace Fauzannurhidayat\Php\TokoOnline\Model;

class UserPasswordUpdateRequest
{
    public ?string $username = null;
    public ?string $oldPassword = null;
    public ?string $newPassword = null;
}