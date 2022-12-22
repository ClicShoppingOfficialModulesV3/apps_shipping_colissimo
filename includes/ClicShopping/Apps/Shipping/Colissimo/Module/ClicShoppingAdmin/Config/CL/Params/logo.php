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

  class logo extends \ClicShopping\Apps\Shipping\Colissimo\Module\ClicShoppingAdmin\Config\ConfigParamAbstract
  {
    public $default = 'colissimo.png';
    public ?int $sort_order = 30;

    protected function init()
    {
      $this->title = $this->app->getDef('cfg_colissimo_logo_title');
      $this->description = $this->app->getDef('cfg_colissimo_logo_desc');
    }
  }
