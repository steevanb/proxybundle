<?php

namespace steevanb\ProxyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use steevanb\ProxyBundle\Entity\Proxy;

/**
 * Edit proxies from http://www.freeproxylists.net
 */
class FreeProxyListsController extends Controller
{

	/**
	 * Find proxies in text
	 *
	 * @param string $text
	 * @return Proxy[]
	 */
	private function _findProxies($text)
	{
		$return = array();
		$lines = explode("\n", str_replace("\r", null, $text));
		$proxiesInDB = \Repository::ProxyBundle__Proxy()->findAll();

		foreach ($lines as $line) {
			// not a proxy line
			if (strlen($line) <= 10) {
				continue;
			}

			$proxyInfos = explode("\t", $line);

			$proxy = new Proxy();
			// proxy already exists
			foreach ($proxiesInDB as $proxyInDB) {
				if ($proxyInDB->getAddress() == $proxyInfos[0] && $proxyInDB->getPort() == $proxyInfos[1]) {
					$proxy = $proxyInDB;
				}
			}
			$proxy->setState(Proxy::STATE_ENABLED);
			$proxy->setDate(new \DateTime());
			$proxy->setAddress($proxyInfos[0]);
			$proxy->setPort($proxyInfos[1]);
			$return[] = $proxy;
		}

		return $return;
	}

	/**
	 * Affiche l'iframe de freeproxylists
	 *
	 * @Template()
	 * @return array
	 */
	public function indexAction()
	{
		return array(
			'findAllUrl' => $this->generateUrl('proxy_freeproxylists_findall'),
			'saveAllUrl' => $this->generateUrl('proxy_freeproxylists_saveall')
		);
	}

	/**
	 * Find proxies in text
	 *
	 * @Template()
	 * @param Request $request
	 * @return array
	 */
	public function findAllAction(Request $request)
	{
		$proxies = $this->_findProxies($request->get('proxiesText'));

		return array('proxies' => $proxies);
	}

	/**
	 * Save all proxies
	 *
	 * @Template()
	 * @param Request $request
	 * @return array
	 */
	public function saveAllAction(Request $request)
	{
		$proxies = $this->_findProxies($request->get('proxiesText'));

		foreach ($proxies as $proxy) {
			_persist($proxy);
		}
		_flush();

		return array('proxies' => $proxies);
	}

}