<?php

namespace steevanb\ProxyBundle\Service\Install;

use kujaff\VersionsBundle\Model\Install as BaseInstall;
use kujaff\VersionsBundle\Model\BundleNameFromClassName;
use kujaff\VersionsBundle\Model\DoctrineHelper;
use Symfony\Component\DependencyInjection\ContainerAware;
use kujaff\VersionsBundle\Entity\Version;

class Install extends ContainerAware implements BaseInstall
{

	use BundleNameFromClassName;
    use DoctrineHelper;

    /**
     * @return Version
     */
	public function install()
	{
		$this->_dropTables(array('proxy_proxies'));
		$this->_executeSQL('
			CREATE TABLE proxy_proxies (
				id INT AUTO_INCREMENT NOT NULL,
				address VARCHAR(45) NOT NULL,
				port INT UNSIGNED NOT NULL,
				state SMALLINT UNSIGNED NOT NULL,
				date DATETIME NOT NULL,
				errors SMALLINT UNSIGNED NOT NULL,
				lastErrorDate DATETIME DEFAULT NULL,
				PRIMARY KEY(id)
			) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
		');

		return new Version('1.0.0');
	}

}
