<?php

/**
 * This file is part of the Voonne platform (http://www.voonne.org)
 *
 * Copyright (c) 2016 Jan Lavička (mail@janlavicka.name)
 *
 * For the full copyright and license information, please view the file licence.md that was distributed with this source code.
 */

namespace Voonne\Voonne\Layouts\Layout21;

use Nette\Localization\ITranslator;
use Voonne\Voonne\Content\ContentForm;
use Voonne\Voonne\Content\ContentManager;
use Voonne\Voonne\Controls\PanelControl;
use Voonne\Voonne\Layouts\LayoutControl;


class Layout21Control extends LayoutControl
{

	/**
	 * @var ContentManager
	 */
	private $contentManager;

	/**
	 * @var ContentForm
	 */
	private $contentForm;


	public function __construct(ContentManager $contentManager, ContentForm $contentForm, ITranslator $translator)
	{
		parent::__construct($translator);

		$this->contentManager = $contentManager;
		$this->contentForm = $contentForm;
	}


	public function render()
	{
		$this->template->setFile(__DIR__ . '/Layout21Control.latte');

		$this->template->elements = $elements = $this->contentManager->getPanels();

		foreach($elements[ContentManager::POSITION_LEFT] as $index => $factory) {
			/** @var PanelControl $panel */
			$panel = $factory->create();

			$panel->setTemplateFactory($this->getTemplateFactory());
			$panel->setupForm($this->contentForm);

			$this['element_left_' . $index] = $panel;
		}

		foreach($elements[ContentManager::POSITION_RIGHT] as $index => $factory) {
			/** @var PanelControl $panel */
			$panel = $factory->create();

			$panel->setTemplateFactory($this->getTemplateFactory());
			$panel->setupForm($this->contentForm);

			$this['element_right_' . $index] = $panel;
		}

		$this->template->render();
	}

}
