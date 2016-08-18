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
use Voonne\Voonne\Content\ContentManager;
use Voonne\Voonne\Layouts\Layout;


class Layout21 extends Layout
{

	/**
	 * @var ContentManager
	 */
	private $contentManager;


	public function __construct(ContentManager $contentManager, ITranslator $translator)
	{
		parent::__construct($translator);

		$this->contentManager = $contentManager;
	}


	public function render()
	{
		$this->template->setFile(__DIR__ . '/Layout21.latte');

		$this->template->elements = $elements = $this->contentManager->getPanels();

		foreach($elements[ContentManager::POSITION_LEFT] as $index => $panel) {
			$this->setupPanel($panel);
		}

		foreach($elements[ContentManager::POSITION_RIGHT] as $index => $panel) {
			$this->setupPanel($panel);
		}

		$this->template->render();
	}

}
