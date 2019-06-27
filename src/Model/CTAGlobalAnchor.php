<?php

namespace Fromholdio\SuperLinkerCTAs\Model;

use Fromholdio\GlobalAnchors\GlobalAnchors;
use Fromholdio\SuperLinker\Extensions\GlobalAnchorLink;

class CTAGlobalAnchor extends CTA
{
    private static $table_name = 'CTAGlobalAnchor';

    private static $extensions = [
        GlobalAnchorLink::class,
        GlobalAnchors::class
    ];
}
