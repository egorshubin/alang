<?php

class AdminAlangController extends ModuleAdminController
{
    public function __construct()
    {
        $this->bootstrap = true;

        parent::__construct();
    }

    public function initContent()
    {
        $this->context->smarty->assign(
            [
                'controllerWord' => $this->l('I am controller word'),
                'helperWord' => $this->module->helper->makeWord(),
            ]
        );

        $this->content .= $this->context->smarty->fetch('module:' . $this->module->name . '/views/templates/hook/contr.tpl');

        parent::initContent();
    }
}
