<?php

namespace Fromholdio\SuperLinkerCTAs\Model;

use Fromholdio\SuperLinker\Extensions\SystemLink;

class CTASystemLink extends CTA
{
    private static $table_name = 'CTASystemLink';

    private static $extensions = [
        SystemLink::class
    ];
}
