<?php
namespace Craft;

class MavrxPlugin extends BasePlugin
{
    public function getName()
    {
         return Craft::t('Mavrx');
    }

    public function getVersion()
    {
        return '0.1.0';
    }

    public function getDeveloper()
    {
        return 'Mavrx';
    }

    public function getDeveloperUrl()
    {
        return 'http://mavrx.io';
    }

    public function hasCpSection()
    {
        return false;
    }

    public function hookAddTwigExtension()
    {
        Craft::import('plugins.mavrx.twigextensions.MavrxTwigExtension');

        return new MavrxTwigExtension();
    }
}
