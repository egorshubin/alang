<?php

class HelperAlang
{
    public $module;

    public function __construct($module)
    {
        $this->module = $module;
    }

    public function installOneTab($name, $className, $isActive = 0)
    {
        $tab = new Tab();
        $tab->name = array();

        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = $name;
        }
        $tab->class_name = $className;
        $tab->module = $this->module->name;
        $tab->active = $isActive;
        if (version_compare(_PS_VERSION_, '1.7.0.0', '>=') && $isActive) {
            $tab->id_parent = (int)Tab::getIdFromClassName('Improve');
        }

        return $tab->add();
    }

    public function uninstallOneTab($className)
    {
        $idtab = Tab::getIdFromClassName($className);
        try {
            $tab = new Tab((int)$idtab);
            return $tab->delete();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function makeWord()
    {
        return $this->module->l('Helper Word!');
    }
}