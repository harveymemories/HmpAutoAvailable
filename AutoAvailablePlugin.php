<?php

class AutoAvailablePlugin extends Omeka_Plugin_AbstractPlugin
{
  protected $_hooks = array('after_save_item');

  public function hookAfterSaveItem($args)
  {
        $db = get_db();
        $elementTable = $db->getTable('Element');
        $availableElement = $elementTable->findByElementSetNameandElementName('Dublin Core', 'Date Available');

        $item = $args['record'];

        if (!($item->getElementTexts('Dublin Core', 'Date Available')) && $item->public) {
            $item->addTextForElement($availableElement, date('Y-m-d'));
            $item->saveElementTexts();
        }

  }

}

