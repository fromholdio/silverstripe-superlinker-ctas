<?php

namespace Fromholdio\SuperLinkerCTAs\Model;

use Fromholdio\GlobalAnchors\GlobalAnchors;
use Fromholdio\SuperLinker\Extensions\SiteTreeLink;

class CTASiteTree extends CTA
{
    private static $table_name = 'CTASiteTree';

    private static $extensions = [
        SiteTreeLink::class,
        GlobalAnchors::class
    ];
}
