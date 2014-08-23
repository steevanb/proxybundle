<?php

namespace steevanb\ProxyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Edit proxies from http://www.freeproxylists.net
 */
class FreeProxyListsController extends Controller
{

    public function indexAction()
    {
        $curl = curl_init('http://www.freeproxylists.net/fr/?pr=HTTP&a[]=1&a[]=2&u=90&s=u');
        curl_setopt_array($curl, array(
            CURLOPT_TIMEOUT => 10,
            CURLOPT_RETURNTRANSFER => true
        ));
        $html = curl_exec($curl);
        curl_close($curl);

        preg_match('|<td><script type="text/javascript">IPDecode("(.*?)")</script></td><td align="center">(.*?)</td>|', $html, $proxies);

        d($proxies);
    }
}