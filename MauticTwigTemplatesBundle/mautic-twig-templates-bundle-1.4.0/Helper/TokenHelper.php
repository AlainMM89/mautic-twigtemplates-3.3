<?php

/*
 * @copyright   2020 mtcextendee.com All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticTwigTemplatesBundle\Helper;

use MauticPlugin\MauticTwigTemplatesBundle\Model\TwigTemplatesModel;

class TokenHelper
{
    /**
     * @var TwigTemplatesModel
     */
    protected $model;


    /**
     * TokenHelper constructor.
     *
     * @param TwigTemplatesModel $model
     */
    public function __construct(TwigTemplatesModel $model)
    {
        $this->model = $model;
    }

    /**
     * @param $content
     * @param $clickthrough
     *
     * @return array
     */
    public function findTwigTokens($content, $clickthrough = [])
    {
        $tokens = [];

        preg_match_all('/{twigtemplate=(.*?)}/', $content, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $key => $twigId) {
                $token = $matches[0][$key];

                if (isset($tokens[$token])) {
                    continue;
                }

                $twigTemplate          = $this->model->getEntity($twigId);
                $tokens[$token] = ($twigTemplate !== null) ? $twigTemplate->getTemplate() : '';
            }
        }

        return $tokens;
    }
}
