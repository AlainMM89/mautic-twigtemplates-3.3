<?php

/*
 * @copyright   2020 mtcextendee.com All rights reserved
 * @author      Mautic, Inc.
 *
 * @link        https://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticTwigTemplatesBundle\Service;

use Twig\Environment;
use Twig\TwigFilter;

class TwigRender
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        // TWIG filter json_decode
        $twig->addFilter(new TwigFilter('json_decode', function ($string) {
            return json_decode($string, true);
        }));

        $twig->addFilter(new TwigFilter('json_decode_html', function ($string) {
            return json_decode(htmlspecialchars_decode($string), true);
        }));
        $this->twig = $twig;
    }

    /**
     * @return \Twig_Environment
     */
    public function getTwig()
    {
        return $this->twig;
    }
}
