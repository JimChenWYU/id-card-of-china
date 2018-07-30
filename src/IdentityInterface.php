<?php

declare(ticks=1);

namespace JimChen\IdentityCard\China;

use JimChen\IdentityCard\China\Region\RegionInterface;

interface IdentityInterface
{
    /**
     * Check The ID Card is legal.
     * 
     * @return bool
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function legal();

    /**
     * Get Region of The ID Card People.
     */
    public function region();

    /**
     * Get The ID Card People Birthday.
     * 
     * @return string
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function birthday();

    /**
     * Get the ID Card People Gender.
     * 
     * @return string
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function gender();
}
