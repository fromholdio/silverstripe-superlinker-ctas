<?php

namespace Fromholdio\SuperLinkerCTAs\Model;

use Fromholdio\SuperLinker\Extensions\FileLink;

class CTAFile extends CTA
{
    private static $table_name = 'CTAFile';

    private static $extensions = [
        FileLink::class
    ];
}
