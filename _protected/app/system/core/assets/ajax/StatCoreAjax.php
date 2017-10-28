<?php
/**
 * @title          Stat Ajax Class
 * @desc           Class of statistical data for the CMS in Ajax.
 *
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2017, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Core / Asset / Ajax
 * @version        0.6
 */

namespace PH7;
defined('PH7') or exit('Restricted access');

use PH7\Framework\Http\Http;
use PH7\Framework\Mvc\Request\Http as HttpRequest;

class StatCoreAjax
{
    /** @var UserCoreModel */
    private $oUserModel;

    /** @var mixed */
    private $mOutput;

    public function __construct()
    {
        $this->oUserModel = new UserCoreModel;
        $this->_init();
    }

    public function display()
    {
        return $this->mOutput;
    }

    private function _init()
    {
        $sType = (new HttpRequest)->post('type');

        switch ($sType) {
            case 'total_users':
                $this->mOutput = $this->oUserModel->total();
                break;

            // If we receive another invalid value, we display a message with a HTTP header.
            default:
                Http::setHeadersByCode(400);
                exit('Bad Request Error!');
        }
    }
}

echo (new StatCoreAjax)->display();
