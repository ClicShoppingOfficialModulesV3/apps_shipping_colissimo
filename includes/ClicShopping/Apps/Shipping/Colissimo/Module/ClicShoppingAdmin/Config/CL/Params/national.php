<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT
   * @licence MIT - Portion of osCommerce 2.4
   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  namespace ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\CL\Params;

  class national extends \ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\ConfigParamAbstract
  {
    public $default = '0.500:5.55, 1:6.80, 2:7.75, 3:8.70, 5:10.60, 7:12.50, 10:15.35, 15:17.45, 30:23.75';
    public $sort_order = 1000;

    protected function init()
    {
      $this->title = $this->app->getDef('cfg_colissimo_national_title');
      $this->description = $this->app->getDef('cfg_colissimo_national_desc');
    }
  }
