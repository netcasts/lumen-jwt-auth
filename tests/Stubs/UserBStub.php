<?php
/**
 * @copyright Copyright (c) 2016 Canis.io
 * @license   MIT
 */
namespace CanisUnit\Lumen\Jwt\Stubs;

use Canis\Lumen\Jwt\Contracts\Subject as JwtSubjectInterface;
use Illuminate\Http\Request;

class UserBStub implements JwtSubjectInterface
{
    public function getJWTClaims()
    {
        return [
            'test' => 'claim'
        ];
    }

    public function getJWTSubject()
    {
        return 'user-test-2';
    }

    public function getJWTClaimValidation()
    {
        return [];
    }
}