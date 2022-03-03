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

  class colissimor5_tom extends \ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\ConfigParamAbstract
  {
    public $default = '0.500:16.90, 1:22.00, 2:33.60, 3:45.20, 4:56.80, 5:68.40, 6:80.00, 7:91.60, 8:103.20, 9:114.80, 10:126.40, 15:184.40, 20:242.40, 25:300.40, 30:358.40';
    public ?int $sort_order = 1180;

    protected function init()
    {
      $this->title = $this->app->getDef('cfg_colissimo_colissimor5_tom_title');
      $this->description = $this->app->getDef('cfg_colissimo_colissimor5_tom_desc');
    }
  }
