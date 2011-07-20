<?php

/**
 * affiliate module configuration.
 *
 * @package    jobeet
 * @subpackage affiliate
 * @author     kalimatas
 * @version    SVN: $Id: configuration.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class affiliateGeneratorConfiguration extends BaseAffiliateGeneratorConfiguration
{
    public function getFilterDefaults()
    {
        return array('is_active' => '0');
    }
}
