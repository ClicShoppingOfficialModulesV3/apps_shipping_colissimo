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

  class colissimor2_national extends \ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\ConfigParamAbstract {
    public $default = '0.500:7.85, 1:9.10, 2:10.05, 3:11.00, 5:12.90, 7:14.80, 10:17.65, 15:19.75, 30:26.05';
    public $sort_order = 1020;

    protected function init() {
      $this->title = $this->app->getDef('cfg_colissimo_colissimor2_national_title');
      $this->description = $this->app->getDef('cfg_colissimo_colissimor2_national_desc');
    }
  }
