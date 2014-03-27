<?php 
namespace Craft;

use Twig_Extension;
use Twig_Filter_Method;

class MavrxTwigExtension extends \Twig_Extension
{
    public function getName()
    {
        return 'Mavrx';
    }

    public function getFilters()
    {
        return array(
            'urlize'   => new Twig_Filter_Method($this, 'urlize'),
            'phoneize' => new Twig_Filter_Method($this, 'phoneize'),
        );
    }

    public function urlize($url, $forDisplay = false)
    {
        $hasMatch = preg_match('#^(https?://)#', $url, $matches);

        if ($hasMatch) {
            $url = str_replace($matches[1], '', $url);
        }

        if ($forDisplay) {
            return $url;
        }

        return ($hasMatch ? $matches[1] : 'http://') . $url;
    }

    public function phoneize($phone, $forDisplay = false)
    {
        $ext   = '';

        $phone = preg_replace('/[^0-9x]+/', '', $phone);

        $parts = explode('x', $phone);
        if (count($parts) > 1) {
            $phone = $parts[0];
            $ext = ($forDisplay ? ' x ' : 'x') . $parts[1];
        }

        if ($forDisplay) {
            $len = strlen($phone);

            // assume area code 509 if not provided
            if ($len == 7) {
                $phone = '509' . $phone;
            }
            if ($len == 10) {
                $phone = preg_replace('/(\d{3})(\d{3})(\d{4})/', '+$1.$2.$3', $phone);
            }
            return $phone . $ext;
        }

        return $phone . $ext;
    }
}
