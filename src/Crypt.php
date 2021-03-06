<?php
namespace FMUP;

use FMUP\Crypt\Factory;

class Crypt
{
    protected $driver;
    private $driverInterface = null;
    protected $factory;

    public function __construct($driver = Factory::DRIVER_MD5)
    {
        $this->driver = $driver;
    }

    /**
     *
     * @return \FMUP\Crypt\CryptInterface
     */
    public function getDriver()
    {
        if (!is_null($this->driverInterface)) {
            return $this->driverInterface;
        }
        $this->driverInterface = $this->getFactory()->create($this->driver);
        return $this->driverInterface;
    }

    /**
     *
     * @param \FMUP\Crypt\CryptInterface $driver
     * @return \FMUP\Crypt
     */
    public function setDriver(Crypt\CryptInterface $driver)
    {
        $this->driverInterface = $driver;
        return $this;
    }

    /**
     * @return Factory
     */
    public function getFactory()
    {
        if (!isset($this->factory)) {
            $this->factory = Factory::getInstance();
        }
        return $this->factory;
    }

    /**
     * Get driver name
     * @return string
     */
    public function getDriverName()
    {
        return $this->driver;
    }

    /**
     * Hash a string
     * @param string $string
     * @return string
     */
    public function hash($string)
    {
        return $this->getDriver()->hash($string);
    }

    /**
     * Unhash a string
     * @param string $string
     * @return string
     */
    public function unHash($string)
    {
        return $this->getDriver()->unHash($string);
    }

    /**
     * Check if a clear string is equivalent to a hashed one
     * @param  string $password
     * @param  string $hashedPassword
     * @return boolean
     */
    public function verify($password, $hashedPassword)
    {
        return (bool)($this->hash($password) == $hashedPassword);
    }
}
