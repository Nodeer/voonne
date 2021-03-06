<?php

/**
 * This file is part of the Voonne platform (http://www.voonne.org)
 *
 * Copyright (c) 2016 Jan Lavička (mail@janlavicka.name)
 *
 * For the full copyright and license information, please view the file licence.md that was distributed with this source code.
 */

namespace Voonne\Voonne\AdminModule\Presenters;

use Nette\Application\BadRequestException;
use Voonne\Voonne\Content\ContentForm;
use Voonne\Voonne\Layouts\LayoutManager;
use Voonne\Voonne\Pages\Page;
use Voonne\Voonne\Pages\PageManager;
use Voonne\Voonne\Panels\Renderers\RendererManager;


class ContentPresenter extends BaseAuthorizedPresenter
{

	/**
	 * @var PageManager
	 * @inject
	 */
	public $pageManager;

	/**
	 * @var LayoutManager
	 * @inject
	 */
	public $layoutManager;

	/**
	 * @var RendererManager
	 * @inject
	 */
	public $rendererManager;

	/**
	 * @var ContentForm
	 * @inject
	 */
	public $contentForm;

	/**
	 * @var Page
	 */
	public $page;

	/**
	 * @var string
	 * @persistent
	 */
	public $groupName;

	/**
	 * @var string
	 * @persistent
	 */
	public $pageName;


	public function actionDefault()
	{
		$groups = $this->pageManager->getGroups();

		if (!isset($groups[$this->groupName]) || !isset($groups[$this->groupName]->getPages()[$this->pageName])) {
			throw new BadRequestException('Not found', 404);
		}

		$this->template->page = $this->page = $groups[$this->groupName]->getPages()[$this->pageName];

		$this->page->injectPrimary(
			$this->layoutManager,
			$this->rendererManager,
			$this->contentForm
		);

		$this->addComponent($this->page, 'page');

		/* content form */

		$this->addComponent($this->contentForm, 'form');
	}

}
