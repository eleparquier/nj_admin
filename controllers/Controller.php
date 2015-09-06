<?php
/**
 * Created by IntelliJ IDEA.
 * User: manu
 * Date: 26/08/15
 * Time: 15:11
 */

namespace fr\gilman\nj;


class Controller
{
    /**
     * @var Menu
     */
    protected $menu;

    /**
     * @var array
     */
    protected $data = array();

    /**
     * Controller constructor.
     * @param Menu $menu
     */
    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
        $this->data['BASE_URL'] = Conf::common()['urlAdmin']['base'];
        $this->data['JS_URL'] = Conf::common()['urlAdmin']['js'];
        $this->data['CSS_URL'] = Conf::common()['urlAdmin']['css'];
        $this->data['IMAGES_URL'] = Conf::common()['urlAdmin']['images'];
    }

    /**
     * @param string $view
     * @return void
     */
    public function display($view)
    {
        extract($this->data);
        $menu = $this->menu;
        require_once (dirname(__FILE__).'/../views/'.$view);
    }

    /**
     * @param string $txt
     * @return void
     */
    protected function error($txt)
    {
        $this->data['txt'] = $txt;
        $this->display('error.php');
    }

    /**
     * @return Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * @param Menu $menu
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
    }

    /**
     * Vérifie si l'utilisateur a le dorit requis
     * @param int $droit Le droit requis
     * @return bool
     */
    public function checkDroit($droit)
    {
        if(SessionBusiness::isConnected()) {
            return SessionBusiness::getCookieSession()->getUtilisateur()->getDroitGroupes()->droitExists($droit);
        } else return false;
    }
}