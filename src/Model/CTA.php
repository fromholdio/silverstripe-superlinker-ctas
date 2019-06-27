<?php

namespace Fromholdio\SuperLinkerCTAs\Model;

use Fromholdio\SuperLinker\Model\SuperLink;

class CTA extends SuperLink
{
    private static $table_name = 'CTA';
    private static $singular_name = 'Call to Action';
    private static $plural_name = 'Calls to Action';

    private static $summary_fields = [
        'Title' => 'Link',
        'Link' => 'URL'
    ];
}
