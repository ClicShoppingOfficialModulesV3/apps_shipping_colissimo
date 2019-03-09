<?php
  /**
 *
 *  @copyright 2008 - https://www.clicshopping.org
 *  @Brand : ClicShopping(Tm) at Inpi all right Reserved
 *  @Licence GPL 2 & MIT
 *  @licence MIT - Portion of osCommerce 2.4
 *  @Info : https://www.clicshopping.org/forum/trademark/
 *
 */

  namespace ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\CL\Params;

  class colissimor1_dom extends \ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\ConfigParamAbstract {
    public $default = '0.500:10.75, 1:15.00, 2:19.65, 3:24.30, 4:28.95, 5:33.60, 6:38.25, 7:42.90, 8:47.55, 9:52.20, 10:56.85, 15:80.05, 20:103.25, 25:126.45, 30:149.65';
    public $sort_order = 1080;

    protected function init() {
      $this->title = $this->app->getDef('cfg_colissimo_colissimor1_dom_title');
      $this->description = $this->app->getDef('cfg_colissimo_colissimor1_dom_desc');
    }
  }
