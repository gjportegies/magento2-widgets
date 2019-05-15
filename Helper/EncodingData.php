<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Widgets\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class EncodingData extends AbstractHelper
{
    const SAFE_FIELDS_KEY = '_safeFields';

    /**
     * @param string $value
     * @return string
     */
    public function decodeValue($value)
    {
        return base64_decode(strtr($value, ':_-', '+/='));
    }

    /**
     * @param array $params
     * @param string $key
     * @return string
     */
    public function decodeParam($params, $key)
    {
        if ($this->getIsSafeParam($params, $key)) {
            return $this->decodeValue($params[$key]);
        }

        return $params[$key];
    }

    /**
     * @param array $array
     * @return array
     */
    public function decodeArray($array)
    {
        foreach ($array as $key => $value) {
            if ($this->getIsSafeParam($array, $key)) {
                $array[$key] = $this->decodeValue($value);
            }
        }

        return $array;
    }

    /**
     * @param string $value
     * @return string
     */
    public function encodeValue($value)
    {
        return strtr(base64_encode($value), '+/=', ':_-');
    }

    /**
     * @param array $params
     * @param string $key
     * @return string
     */
    public function encodeParam($params, $key)
    {
        if ($this->getIsSafeParam($params, $key)) {
            return $this->encodeValue($params[$key]);
        }

        return $params[$key];
    }

    /**
     * @param array $array
     * @return array
     */
    public function encodeArray($array)
    {
        foreach ($array as $key => $value) {
            if ($this->getIsSafeParam($array, $key)) {
                $array[$key] = $this->encodeValue($value);
            }
        }

        return $array;
    }

    /**
     * @param array $params
     * @param string $paramKey
     * @return bool
     */
    public function getIsSafeParam($params, $paramKey)
    {
        $safeParamsKeys = $this->getSafeParamsKeysNames($params);

        return in_array($paramKey, $safeParamsKeys);
    }

    /**
     * @param array $params
     * @return array
     */
    public function getSafeParamsKeysNames($params)
    {
        if (!isset($params[self::SAFE_FIELDS_KEY])) return [];

        return array_map('trim', explode(',', $params[self::SAFE_FIELDS_KEY]));
    }
}
