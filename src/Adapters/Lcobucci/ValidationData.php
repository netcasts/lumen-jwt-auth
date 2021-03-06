<?php
/**
 * @copyright Copyright (c) 2016 Canis.io
 * @license   MIT
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Canis\Lumen\Jwt\Adapters\Lcobucci;

/**
 * Class that wraps validation values
 * Jacob added the ability to override just the expiration validator
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 * @author Jacob Morrison <jacob@canis.io>
 */
class ValidationData 
    extends \Lcobucci\JWT\ValidationData
{
    /**
     * The list of things to be validated
     *
     * @var array
     */
    private $items;

    /**
     * Initializes the object
     *
     * @param int $currentTime
     */
    public function __construct($currentTime = null)
    {
        $currentTime = $currentTime ?: time();

        $this->items = [
            'jti' => null,
            'iss' => null,
            'aud' => null,
            'sub' => null,
            'iat' => $currentTime,
            'nbf' => $currentTime,
            'exp' => $currentTime
        ];
    }

    /**
     * Configures the id
     *
     * @param string $id
     */
    public function setId($id)
    {
        $this->items['jti'] = (string) $id;
    }

    /**
     * Configures the issuer
     *
     * @param string $issuer
     */
    public function setIssuer($issuer)
    {
        $this->items['iss'] = (string) $issuer;
    }

    /**
     * Configures the audience
     *
     * @param string $audience
     */
    public function setAudience($audience)
    {
        $this->items['aud'] = (string) $audience;
    }

    /**
     * Configures the subject
     *
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->items['sub'] = (string) $subject;
    }

    /**
     * Configures the time that "iat", "nbf" and "exp" should be based on
     *
     * @param int $currentTime
     */
    public function setCurrentTime($currentTime)
    {
        $this->items['iat'] = (int) $currentTime;
        $this->items['nbf'] = (int) $currentTime;
        $this->items['exp'] = (int) $currentTime;
    }

    /**
     * Configures the time that "exp" should be based on
     *
     * @param int $currentTime
     */
    public function setExpiration($currentTime)
    {
        $this->items['exp'] = (int) $currentTime;
    }

    /**
     * Returns the requested item
     *
     * @param string $name
     *
     * @return mixed
     */
    public function get($name)
    {
        return isset($this->items[$name]) ? $this->items[$name] : null;
    }

    /**
     * Returns if the item is present
     *
     * @param string $name
     *
     * @return boolean
     */
    public function has($name)
    {
        return !empty($this->items[$name]);
    }
}