# SilverStripe SuperLinker CTAs

Call-to-Action / Button DataObjects built on SuperLinker foundation.

## Status

**Note**: This module has been superseded by SuperLinker v3+. For new projects, it's recommended to create custom SuperLink subclasses as needed rather than using this module.

This module remains available for existing sites that depend on it.

## Overview

Provides a `CTA` class that extends `SuperLink` with pre-configured defaults suitable for call-to-action buttons and promotional links.

## Requirements

* SilverStripe Framework ^6.0
* fromholdio/silverstripe-superlinker ^4.0.0

## Installation

```bash
composer require fromholdio/silverstripe-superlinker-ctas
```

## Usage

### Basic Usage

```php
use Fromholdio\SuperLinkerCTAs\Model\CTA;

class HomePage extends Page
{
    private static $has_one = [
        'PrimaryCTA' => CTA::class,
        'SecondaryCTA' => CTA::class
    ];

    private static $owns = [
        'PrimaryCTA',
        'SecondaryCTA'
    ];
}
```

### CMS Fields

```php
use Fromholdio\HasOneEdit\HasOneMiniGridField;

public function getCMSFields(): FieldList
{
    $fields = parent::getCMSFields();

    $fields->addFieldsToTab('Root.Main', [
        HasOneMiniGridField::create('PrimaryCTA', 'Primary CTA', $this),
        HasOneMiniGridField::create('SecondaryCTA', 'Secondary CTA', $this)
    ]);

    return $fields;
}
```

### Templates

```html
<% if $PrimaryCTA %>
    <a href="$PrimaryCTA.URL" class="btn btn-primary" $PrimaryCTA.AttributesHTML>
        $PrimaryCTA.Title
    </a>
<% end_if %>

<% if $SecondaryCTA %>
    <a href="$SecondaryCTA.URL" class="btn btn-secondary" $SecondaryCTA.AttributesHTML>
        $SecondaryCTA.Title
    </a>
<% end_if %>
```

## Alternative for New Projects

Instead of using this module, create your own CTA class:

```php
namespace App\Model;

use Fromholdio\SuperLinker\Model\SuperLink;

class CTA extends SuperLink
{
    private static $table_name = 'App_CTA';

    private static $singular_name = 'Call to Action';
    private static $plural_name = 'Calls to Action';

    // Add any custom fields or methods here
}
```

This gives you full control over the CTA implementation without an extra dependency.

## Documentation

For complete SuperLinker documentation, see:
- [SuperLinker README](../silverstripe-superlinker/README.md)
- [SuperLinker Technical Guide](../silverstripe-superlinker/augment.md)

## License

BSD-3-Clause

## Support

- **GitHub**: https://github.com/fromholdio/silverstripe-superlinker-ctas
- **Issues**: https://github.com/fromholdio/silverstripe-superlinker-ctas/issues
