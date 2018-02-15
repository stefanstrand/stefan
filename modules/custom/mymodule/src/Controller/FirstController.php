<?php

/**
 * @file
 * Contains \Drupal\mymodule\Controller\MyModuleController.
 */

namespace Drupal\mymodule\Controller;

use Drupal\Core\Controller\ControllerBase;

class FirstController extends ControllerBase {

  public function content() {
    return array(
      '#type' => 'markup',
      '#markup' => $this->t('This is my menu linked custom page.'),
    );
  }

  public function secret($count) {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('This is a secret page with something from the url: %count', array('%count' => $count)),
    ];
  }

}
