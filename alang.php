<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

require_once(_PS_MODULE_DIR_ . 'alang/classes/helpers/HelperAlang.php');

class ALang extends Module
{
    public $helper;

    public function __construct()
    {
        $this->name = 'alang';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Egor Shubin';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.6.0',
            'max' => _PS_VERSION_,
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Check Translations');
        $this->description = $this->l('Check translations.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        $this->helper = new HelperAlang($this);
    }

    public function enable($force_all = false)
    {
        return (parent::enable($force_all)
            && $this->installTabs()
        );
    }

    public function disable($force_all = false)
    {
        return parent::disable($force_all) && $this->uninstallTabs();
    }

    public function installTabs()
    {
        $res = true;
        $res &= $this->helper->installOneTab('Lang Test', 'AdminAlang');
        return $res;
    }

    public function uninstallTabs()
    {
        $res = true;
        $res &= $this->helper->uninstallOneTab('AdminAlang');
        return $res;
    }

    public function getContent()
    {
        $this->context->smarty->assign(
            [
                'header' => $this->l('I am header'),
                'link' => $this->context->link->getAdminLink('AdminAlang')
            ]
        );

        return $this->display(__FILE__, 'alang.tpl');
    }
}
