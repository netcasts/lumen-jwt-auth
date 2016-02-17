<?php
/**
 * @copyright Copyright (c) 2016 Canis.io
 * @license   MIT
 */
namespace Canis\Lumen\Jwt\Adapters\Lcobucci;

use Canis\Lumen\Jwt\Token;
use Canis\Lumen\Jwt\Contracts\Processor as ProcessorContract;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Parser;

class Processor
    extends HelperBase
    implements ProcessorContract
{
    /**
     * Parses and validates token
     * @param  string $tokenString
     * @return Token
     */
    final public function __invoke($tokenString)
    {
        $token = (new Parser())->parse((string) $tokenString);
        $signer = new Sha256();
        if (!$token->verify($signer, $this->config['secret'])) {
            return false;
        }
        if (!$this->checkRequiredClaims(array_keys($token->getClaims()))) {
            return false;
        };
        $data = new ValidationData();
        if (isset($this->config['issuer'])) {
            $data->setIssuer($this->config['issuer']);
        }
        if (isset($this->config['audience'])) {
            $data->setAudience($this->config['audience']);
        }
        if (!$token->validate($data)) {
            return false;
        }
        return new Token((string) $token, $token->getClaims());
    }
}
