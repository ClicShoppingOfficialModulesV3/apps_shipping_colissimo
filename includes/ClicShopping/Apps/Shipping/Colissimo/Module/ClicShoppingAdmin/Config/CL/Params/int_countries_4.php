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

  class int_countries_4 extends \ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\ConfigParamAbstract
  {
    public $default = 'AS, AQ, AR, AW, AU, BS, BH, BD, BB, BZ, BT, BO, BV, BR, IO, BN, KH, KY, CL, CN, CX, CC, CO, KM, CK, CR, CU, DO';
    public ?int $sort_order = 1260;

    protected function init()
    {
      $this->title = $this->app->getDef('cfg_colissimo_int_countries_4_title');
      $this->description = $this->app->getDef('cfg_colissimo_int_countries_4_desc');
    }
  }
