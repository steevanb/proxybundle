<?php

namespace steevanb\ProxyBundle\EntityRepository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use steevanb\ProxyBundle\Entity\Proxy as ProxyEntity;

/**
 * Manager for ProxyBundle:Proxy entity
 */
class Proxy extends EntityRepository
{

	/**
	 * Get a random proxy (only enabled ones)
	 *
	 * @return ProxyEntity
	 */
	public function findRandom()
	{
		$rsmb = new ResultSetMappingBuilder($this->_em);
		$rsmb->addRootEntityFromClassMetadata('steevanb\ProxyBundle\Entity\Proxy', 'p');
		$rsmb->addIndexBy('p', 'id');
		$query = $this->_em->createNativeQuery('SELECT * FROM proxy_proxies p WHERE state = ' . ProxyEntity::STATE_ENABLED . ' ORDER BY RAND() LIMIT 1', $rsmb);

		return $query->getSingleResult();
	}

}
