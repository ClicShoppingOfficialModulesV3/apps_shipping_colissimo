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

  class colissimor2_dom extends \ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\ConfigParamAbstract
  {
    public $default = '0.500:11.65, 1:15.90, 2:20.55, 3:25.20, 4:29.85, 5:34.50, 6:39.15, 7:43.80, 8:48.45, 9:53.10, 10:57.75, 15:80.95, 20:104.15, 25:127.35, 30:150.55';
    public ?int $sort_order = 1090;

    protected function init()
    {
      $this->title = $this->app->getDef('cfg_colissimo_colissimor2_dom_title');
      $this->description = $this->app->getDef('cfg_colissimo_colissimor2_dom_desc');
    }
  }
