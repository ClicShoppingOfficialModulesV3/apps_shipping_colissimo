<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT

   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  namespace ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\CL\Params;

  class int_cost_2 extends \ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\ConfigParamAbstract
  {
    public $default = '1:19.40, 2:21.30, 3:25.75, 4:30.20, 5:34.65, 6:39.10, 7:43.55, 8:48.00, 9:52.45, 10:56.90, 15:67.10, 20:77.30';
    public ?int $sort_order = 1230;

    protected function init()
    {
      $this->title = $this->app->getDef('cfg_colissimo_int_cost_2_title');
      $this->description = $this->app->getDef('cfg_colissimo_int_cost_2_desc');
    }
  }
