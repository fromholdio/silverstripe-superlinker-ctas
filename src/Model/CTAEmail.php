<?php

namespace Fromholdio\SuperLinkerCTAs\Model;

use Fromholdio\SuperLinker\Extensions\EmailLink;

class CTAEmail extends CTA
{
    private static $table_name = 'CTAEmail';

    private static $extensions = [
        EmailLink::class
    ];
}
