<?php

/**
 * This file is part of the Voonne platform (http://www.voonne.org)
 *
 * Copyright (c) 2016 Jan Lavička (mail@janlavicka.name)
 *
 * For the full copyright and license information, please view the file licence.md that was distributed with this source code.
 */

namespace Voonne\Voonne\Panels\Renderers\PanelRenderer;

use Nette\Localization\ITranslator;
use Voonne\Voonne\Controls\Control;
use Voonne\Voonne\Panels\Panel;
use Voonne\Voonne\Panels\Renderers\RendererManager;


class PanelRenderer extends Control
{

	/**
	 * @var RendererManager
	 */
	private $rendererManager;

	/**
	 * @var Panel
	 */
	private $panel;


	public function __construct(Panel $panel, RendererManager $rendererManager, ITranslator $translator)
	{
		parent::__construct($translator);

		$this->panel = $panel;
		$this->rendererManager = $rendererManager;
	}


	public function beforeRender()
	{
		$rendererFactory = $this->rendererManager->getRendererFactory($this->panel);

		$this->addComponent($rendererFactory->create($this->panel), 'renderer');
	}


	public function render()
	{
		$this->template->setFile(__DIR__ . '/PanelRenderer.latte');

		$this->template->render();
	}

}
