<?php

/**
 * This file is part of the Voonne platform (http://www.voonne.org)
 *
 * Copyright (c) 2016 Jan Lavička (mail@janlavicka.name)
 *
 * For the full copyright and license information, please view the file licence.md that was distributed with this source code.
 */

namespace Voonne\Voonne\Forms;

use Nette\Localization\ITranslator;


class FormFactory
{

	/**
	 * @var ITranslator
	 */
	protected $translator;


	public function __construct(ITranslator $translator)
	{
		$this->translator = $translator;
	}


	/**
	 * @return Form
	 */
	public function create()
	{
		$form = new Form;

		$form->getElementPrototype()->novalidate = 'novalidate';
		$form->setTranslator($this->translator);

		return $form;
	}

}
