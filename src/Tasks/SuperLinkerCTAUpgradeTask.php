<?php

namespace Fromholdio\SuperLinkerCTAs\Tasks;

use Fromholdio\SuperLinkerCTAs\Model\CTA;
use SilverStripe\Control\Director;
use SilverStripe\Dev\BuildTask;
use SilverStripe\ORM\DB;
use SilverStripe\Versioned\Versioned;

class SuperLinkerCTAUpgradeTask extends BuildTask
{

    protected $enabled = true;

    protected $title = 'SuperLinker CTA Upgrade';

    protected $description = 'Upgrade SuperLinker CTAs to version 3';

    private static $segment = 'superlinker-cta-upgrade';

    public function run($request)
    {
        $this->log("Starting upgrade...");

        set_time_limit(0);

        $this->upgradeEmailLinks();
        $this->upgradeExternalLinks();
        $this->upgradeFileLinks();
        $this->upgradeGlobalAnchorLinks();
        $this->upgradePhoneLinks();
        $this->upgradeSiteTreeLinks();
        $this->upgradeSystemLinks();

        $this->cleanupTables();

        $this->log("Upgrade done.");
    }

    private function upgradeFileLinks()
    {
        $this->log("upgrade file links... ", false);
        $query = "SHOW TABLES LIKE 'CTAFile'";
        $tableExists = DB::query($query)->value();
        if ($tableExists != null) {
            $query = <<<EOT
update SuperLink s
LEFT JOIN CTAFile f ON f.ID = s.ID
set
s.ClassName = 'Fromholdio\\\\SuperLinkerCTAs\\\\Model\\\\CTA',
s.LinkType = 'file',
s.FileID = f.FileID,
s.LinkText = s.CustomLinkText,
s.DoOpenInNew = s.DoOpenNewWindow
where s.ClassName = 'Fromholdio\\\\SuperLinkerCTAs\\\\Model\\\\CTAFile';
EOT;
            DB::query($query);
            $query = "DROP TABLE IF EXISTS CTAFile";
            DB::query($query);
            $query = "DROP TABLE IF EXISTS CTAFile_Live";
            DB::query($query);
            $query = "DROP TABLE IF EXISTS CTAFile_Versions";
            DB::query($query);
        }

        $this->log("done.");
    }

    private function upgradeSiteTreeLinks()
    {
        $this->log("upgrade page links... ", false);
        $query = "SHOW TABLES LIKE 'CTASiteTree'";
        $tableExists = DB::query($query)->value();
        if ($tableExists != null) {
            $query = <<<EOT
update SuperLink s
LEFT JOIN CTASiteTree p ON p.ID = s.ID
set
s.ClassName = 'Fromholdio\\\\SuperLinkerCTAs\\\\Model\\\\CTA',
s.LinkType = 'sitetree',
s.SiteTreeID = p.SiteTreeID,
s.LinkText = s.CustomLinkText,
s.DoOpenInNew = s.DoOpenNewWindow
where s.ClassName = 'Fromholdio\\\\SuperLinkerCTAs\\\\Model\\\\CTASiteTree'
EOT;
            DB::query($query);
            $query = "DROP TABLE IF EXISTS CTASiteTree";
            DB::query($query);
            $query = "DROP TABLE IF EXISTS CTASiteTree_Live";
            DB::query($query);
            $query = "DROP TABLE IF EXISTS CTASiteTree_Versions";
            DB::query($query);
        }

        $this->log("done.");
    }

    private function upgradeExternalLinks()
    {
        $this->log("upgrade external links... ", false);
        $query = <<<EOT
update SuperLink
set
ClassName = 'Fromholdio\\\\SuperLinkerCTAs\\\\Model\\\\CTA',
LinkType = 'external',
ExternalURL = concat(URL,CASE WHEN QueryString IS not NULL then concat('?',QueryString) else '' end,CASE WHEN Anchor IS not NULL then concat('#',Anchor) else '' end),
LinkText = CustomLinkText,
DoOpenInNew = DoOpenNewWindow
where ClassName = 'Fromholdio\\\\SuperLinkerCTAs\\\\Model\\\\CTAExternalURL'
EOT;
        DB::query($query);

        $this->log("done.");
    }

    private function upgradeEmailLinks()
    {
        $this->log("upgrade email links... ", false);
        $query = "SHOW TABLES LIKE 'CTAEmail'";
        $tableExists = DB::query($query)->value();
        if ($tableExists != null) {
            $query = <<<EOT
update SuperLink s
LEFT JOIN CTAEmail e ON e.ID = s.ID
set
s.ClassName = 'Fromholdio\\\\SuperLinkerCTAs\\\\Model\\\\CTA',
s.LinkType = 'email',
s.Email = e.Email,
s.EmailCC = e.EmailCC,
s.EmailBCC = e.EmailBCC,
s.EmailSubject = e.Subject,
s.EmailBody = e.Body,
s.LinkText = s.CustomLinkText,
s.DoOpenInNew = s.DoOpenNewWindow
where s.ClassName = 'Fromholdio\\\\SuperLinkerCTAs\\\\Model\\\\CTAEmail'
EOT;
            DB::query($query);
            $query = "DROP TABLE IF EXISTS CTAEmail";
            DB::query($query);
            $query = "DROP TABLE IF EXISTS CTAEmail_Live";
            DB::query($query);
            $query = "DROP TABLE IF EXISTS CTAEmail_Versions";
            DB::query($query);
        }

        $this->log("done.");
    }

    private function upgradePhoneLinks()
    {
        $this->log("upgrade phone links... ", false);
        $query = "SHOW TABLES LIKE 'CTAPhone'";
        $tableExists = DB::query($query)->value();
        if ($tableExists != null) {
            $query = <<<EOT
update SuperLink s
LEFT JOIN CTAPhone p ON p.ID = s.ID
set
s.ClassName = 'Fromholdio\\\\SuperLinkerCTAs\\\\Model\\\\CTA',
s.LinkType = 'phone',
s.PhoneNumber = p.Phone,
s.LinkText = s.CustomLinkText,
s.DoOpenInNew = s.DoOpenNewWindow
where s.ClassName = 'Fromholdio\\\\SuperLinkerCTAs\\\\Model\\\\CTAPhone'
EOT;
            DB::query($query);
            $query = "DROP TABLE IF EXISTS CTAPhone";
            DB::query($query);
            $query = "DROP TABLE IF EXISTS CTAPhone_Live";
            DB::query($query);
            $query = "DROP TABLE IF EXISTS CTAPhone_Versions";
            DB::query($query);
        }

        $this->log("done.");
    }

    private function upgradeGlobalAnchorLinks()
    {
        $this->log("upgrade global anchor links... ", false);
        $query = <<<EOT
update SuperLink
set
ClassName = 'Fromholdio\\\\SuperLinkerCTAs\\\\Model\\\\CTA',
LinkType = 'globalanchor',
GlobalAnchorKey = Anchor,
LinkText = CustomLinkText,
DoOpenInNew = DoOpenNewWindow
where ClassName = 'Fromholdio\\\\SuperLinkerCTAs\\\\Model\\\\CTAGlobalAnchor'
EOT;
        DB::query($query);

        $this->log("done.");
    }

    private function upgradeSystemLinks()
    {
        $this->log("upgrade system links... ", false);
        $query = "SHOW TABLES LIKE 'CTASystemLink'";
        $tableExists = DB::query($query)->value();
        if ($tableExists != null) {
            $query = <<<EOT
update SuperLink s
LEFT JOIN CTASystemLink p ON p.ID = s.ID
set
s.ClassName = 'Fromholdio\\\\SuperLinkerCTAs\\\\Model\\\\CTA',
s.LinkType = 'system',
s.SystemLinkKey = p.Key,
s.LinkText = s.CustomLinkText,
s.DoOpenInNew = s.DoOpenNewWindow
where s.ClassName = 'Fromholdio\\\\SuperLinkerCTAs\\\\Model\\\\CTASystemLink'
EOT;
            DB::query($query);
            $query = "DROP TABLE IF EXISTS CTASystemLink";
            DB::query($query);
            $query = "DROP TABLE IF EXISTS CTASystemLink_Live";
            DB::query($query);
            $query = "DROP TABLE IF EXISTS CTASystemLink_Versions";
            DB::query($query);
        }

        $this->log("done.");
    }

    private function cleanupTables()
    {
        $this->log("clean up tables... ", false);

        if (!CTA::has_extension(Versioned::class)) {
            $query = "DROP TABLE IF EXISTS CTA_Live";
            DB::query($query);
            $query = "DROP TABLE IF EXISTS CTA_Versions";
            DB::query($query);
        }

        $this->log("done.");
    }

    public function log($message, $newLine = true)
    {
        if (Director::is_cli()) {
            echo "{$message}" . ($newLine ? "\n" : "");
        } else {
            echo "{$message}" . ($newLine ? "<br />" : "");
        }
        flush();
    }
}
