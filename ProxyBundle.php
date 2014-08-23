<?php

namespace steevanb\ProxyBundle;

use kujaff\VersionsBundle\Model\VersionnedBundle;
use kujaff\VersionsBundle\Entity\Version;

class ProxyBundle extends VersionnedBundle
{

	public function __construct()
	{
		$this->version = new Version('1.0.0');
	}

}