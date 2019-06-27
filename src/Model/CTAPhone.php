<?php

namespace Fromholdio\SuperLinkerCTAs\Model;

use Fromholdio\SuperLinker\Extensions\PhoneLink;

class CTAPhone extends CTA
{
    private static $table_name = 'CTAPhone';

    private static $extensions = [
        PhoneLink::class
    ];
}
