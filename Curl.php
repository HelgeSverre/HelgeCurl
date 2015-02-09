<?php

namespace Helge;


/**
 * Convenience wrapper for cURL, makes using curl a little bit easier.
 * Class cURL
 * @package Helge
 */
class cURL
{

    private $handle;
    private $options = array(CURLOPT_RETURNTRANSFER => true);


    /**
     * @param string $url the host/location to connect to
     * @param array $options optional curl options to set.
     */
    public function __construct($url = null, array $options = array())
    {
        // array_merge() does not work as it does not preserve the key values of the arrays.
        $this->options += $options;
        $this->options += array(CURLOPT_URL => $url);
        $this->handle = curl_init($url);
    }


    /**
     * @param int $option CURLOPT option to change value for
     * @param mixed $value the value to set to the curl option.
     * @return bool TRUE on success or FALSE on failure
     */
    public function setOption($option, $value)
    {
        return curl_setopt($this->handle, $option, $value);
    }


    /**
     * Sets multiple curl options with an array of options and values
     * @param array $options array of options and values to set.
     * @return bool TRUE on success or FALSE on failure
     */
    public function setOptions(array $options = null)
    {
        return curl_setopt_array($this->handle, $options);
    }


    /**
     * Sets the postfields for curl in an array.
     * @param array $postFields array of post fields to set
     */
    public function setPostFields(array $postFields = null)
    {
        $this->setOption(CURLOPT_POSTFIELDS, $postFields);
    }


    /**
     * Perform a curl session.
     * @param string $url The URL to fetch data from
     * @return mixed the data form the session on success or false on failure.
     */
    public function Execute($url = null)
    {
        $this->setOption(CURLOPT_URL, $url);
        $this->setOptions($this->options);
        return curl_exec($this->handle);
    }


    /**
     * @param string $host the ip address or hostname of the proxy.
     * @param string $username the username of the proxy if necessary
     * @param string $password the password of the proxy if necessary
     */
    public function setProxy($host, $username = null, $password = null)
    {
        $this->setOption(CURLOPT_PROXY, $host);

        if ($username && $password) {
            $this->setOption(CURLOPT_PROXYUSERPWD, $username . ":" . $password);
        }
    }


    /**
     * @param string $useragent the useragent to use.
     */
    public function setUserAgent($useragent)
    {
        $this->setOption(CURLOPT_USERAGENT, $useragent);
    }


    /**
     * Closes the curl session.
     */
    public function Close()
    {
        curl_close($this->handle);
    }
}