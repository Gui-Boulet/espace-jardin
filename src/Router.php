<?php
namespace App;

use AltoRouter;

class Router {

  /**
   * @var string
   */
  private $viewPath;
  /**
   * @var AltoRouter
   */
  private $router;

  public function __construct(string $viewPath)
  {
    $this->viewPath = $viewPath;
    $this->router = new AltoRouter();
  }

  public function get(string $url, string $view, ?string $name = null): self
  {
    $this->router->map('GET', $url, $view, $name);
    return $this;
  }

  public function post(string $url, string $view, ?string $name = null): self
  {
    $this->router->map('POST', $url, $view, $name);
    return $this;
  }

  public function url(string $name, array $params = [])
  {
    return $this->router->generate($name, $params);
  }

  public function run(): self
  {
    $match = $this->router->match();
    $view = $match['target'];
    $router = $this;

    ob_start();
    switch ($view){
      case 'access/login':
        require $this->viewPath . DIRECTORY_SEPARATOR . $view . '.php';
        break;
      case 'admin/admin':
      case 'admin/interventions':
      case 'admin/customers':
      case 'admin/services':
      case 'admin/actions/delete':
        $header = 'admin';
        require $this->viewPath . DIRECTORY_SEPARATOR . 'layouts/header.php';
        require $this->viewPath . DIRECTORY_SEPARATOR . $view . '.php';
        break;
      default:
        $header = 'user';
        require $this->viewPath . DIRECTORY_SEPARATOR . 'layouts/header.php';
        require $this->viewPath . DIRECTORY_SEPARATOR . $view . '.php';
        require $this->viewPath . DIRECTORY_SEPARATOR . 'layouts/footer.php';
    }
    $content = ob_get_clean();

    require $this->viewPath . DIRECTORY_SEPARATOR . 'layouts/default.php';
    
    return $this;
  }
}