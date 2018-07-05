<?php
/*
* 2007-2018 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2018 PrestaShop SA
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class testhookcmscategories extends Module
{
    public $name = 'testhookcmscategories';
    public $tab = 'administration';
    public $version = '1.0.0';
    public $author = 'Matt75';
    public $need_instance = 0;

    /**
     * Call to Module::__construct() and translate displayName & description
     */
    public function __construct()
    {
        parent::__construct();
        $this->displayName = $this->l('Test ObjectModel hooks execution on delete CMSCategory');
        $this->description = $this->l('Adds capabilities to log calls to ObjectModel hooks execution on delete CMSCategory.');
    }

    /**
     * Call to Module::install() and registerHook
     * @return bool
     * @throws PrestaShopException
     */
    public function install()
    {
        return parent::install()
            && $this->registerHook('actionObjectDeleteBefore')
            && $this->registerHook('actionObjectDeleteAfter')
            && $this->registerHook('actionObjectCMSDeleteBefore')
            && $this->registerHook('actionObjectCMSDeleteAfter')
            && $this->registerHook('actionObjectCMSCategoryDeleteBefore')
            && $this->registerHook('actionObjectCMSCategoryDeleteAfter');
    }

    /**
     * Before delete an ObjectModel
     * @param array $params
     */
    public function hookActionObjectDeleteBefore($params)
    {
        $object = $params['object'];
        $class = get_class($object);

        if (in_array($class, array('CMS', 'CMSCategory'), true)) {
            PrestaShopLogger::addLog(
                'Hook actionObjectDeleteBefore',
                1,
                null,
                $class,
                $object->id
            );
        }
    }

    /**
     * After delete an ObjectModel
     * @param array $params
     */
    public function hookActionObjectUpdateAfter($params)
    {
        $object = $params['object'];
        $class = get_class($object);

        if (in_array($class, array('CMS', 'CMSCategory'), true)) {
            PrestaShopLogger::addLog(
                'Hook actionObjectDeleteAfter',
                1,
                null,
                $class,
                $object->id
            );
        }
    }

    /**
     * Before delete CMS
     * @param array $params
     */
    public function hookActionObjectCMSDeleteBefore($params)
    {
        $object = $params['object'];
        $class = get_class($object);

        PrestaShopLogger::addLog(
            'Hook actionObjectCMSDeleteBefore',
            1,
            null,
            $class,
            $object->id
        );
    }

    /**
     * After delete CMS
     * @param array $params
     */
    public function hookActionObjectCMSDeleteAfter($params)
    {
        $object = $params['object'];
        $class = get_class($object);

        PrestaShopLogger::addLog(
            'Hook actionObjectCMSDeleteAfter',
            1,
            null,
            $class,
            $object->id
        );
    }

    /**
     * Before delete CMSCategory
     * @param array $params
     */
    public function hookActionObjectCMSCategoryDeleteBefore($params)
    {
        $object = $params['object'];
        $class = get_class($object);

        PrestaShopLogger::addLog(
            'Hook actionObjectCMSCategoryDeleteBefore',
            1,
            null,
            $class,
            $object->id
        );
    }

    /**
     * After delete CMSCategory
     * @param array $params
     */
    public function hookActionObjectCMSCategoryDeleteAfter($params)
    {
        $object = $params['object'];
        $class = get_class($object);

        PrestaShopLogger::addLog(
            'Hook actionObjectCMSCategoryDeleteAfter',
            1,
            null,
            $class,
            $object->id
        );
    }
}
