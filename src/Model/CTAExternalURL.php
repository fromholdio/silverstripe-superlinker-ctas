<?php

namespace Fromholdio\SuperLinkerCTAs\Model;

use Fromholdio\SuperLinker\Extensions\ExternalURLLink;

class CTAExternalURL extends CTA
{
    private static $table_name = 'CTAExternalURL';

    private static $extensions = [
        ExternalURLLink::class
    ];
}
