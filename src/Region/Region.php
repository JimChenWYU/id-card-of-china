<?php

declare(ticks=1);

namespace JimChen\IdentityCard\China\Region;

class Region implements RegionInterface
{
    /**
     * All regions data.
     * 
     * @var array
     */
    protected static $regions = [];

    /**
     * The Init Region Code.
     * 
     * @var int
     */
    protected $code;

    /**
     * Create A Region instance.
     * 
     * @param int $regionCode The Instance Init Region Code.
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function __construct(int $regionCode)
    {
        if (empty(static::$regions)) {
            // Seting regions to [static::$regions],
            // Using `json_decode` function decode json RAW string.
            static::$regions = json_decode(
                // Using `file_get_contents` function read
                // `medz/gb-t-2600` package data provided.
                file_get_contents(MEDZ_GBT2260_RAW_PATH), true
            );
        }

        // Setting init region code.
        $this->code = (string) $regionCode;
    }

    /**
     * Get the Region Code.
     * 
     * @return int
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function code()
    {
        return (int) $this->code;
    }

    /**
     * Get Province Of The Region.
     * 
     * @return string
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function province()
    {
        $provinceCode = substr($this->code, 0, 2).'0000';

        return static::$regions[$provinceCode];
    }

    /**
     * Get City Of The Region.
     * 
     * @return string
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function city()
    {
        // Get city code of the region.
        $cityCode = substr($this->code, 0, 4).'00';

        if (isset(static::$regions[$cityCode])) {
            return static::$regions[$cityCode];
        }

        return '';
    }

    /**
     * Get County Of The Region.
     * 
     * @return string
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function county()
    {
        return static::$regions[$this->code];
    }

    /**
     * Get The Region Tree.
     * 
     * @return array
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function tree()
    {
        return array_values(array_filter([
            $this->province(),
            $this->city(),
            $this->county(),
        ]));
    }

    /**
     * Get The Region Tree String.
     * 
     * @param string $glue Join Array Elements With A Glue String
     * @return string
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function treeString($glue = '')
    {
        return implode($glue, $this->tree());
    }
}
