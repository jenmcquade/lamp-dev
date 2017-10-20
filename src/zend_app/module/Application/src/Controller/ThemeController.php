<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Application\Model\Theme\Theme;
use Application\Model\Theme\ThemeQuery;
use Application\Controller\IndexController;

/**
 * Class ThemeController 
 * Manage Theme through URL calls
 * 
 * @category Controllers
 * @package  Application
 * @author   bistorm.info@gmail.com <bistorm.info@gmail.com>
 * @license  MIT  https://en.wikipedia.org/wiki/MIT_License
 * @link     http://github.com/zendframework/ZendSkeletonApplication
 */
class ThemeController extends AbstractActionController
{
    /**
     * Lists all Themes
     *
     * @return object $result
     */
    public function listAllAction()
    {
        $q = new ThemeQuery();
        $data = $q->find();

        $result = new JsonModel(
            array(
                'data' => $data->toJSON(),
            )
        );

        return $result;
    }

    /**
     * Add a Theme through Post
     *
     * @return object $result
     */
    public function addAction() 
    {
        if (empty($this->params()->fromPost())) {
            return new JsonModel(
                array(
                    'error' => 'No data was posted.',
                )
            );
        }

        // Get properties from host
        $postThemeName = $this->params()->fromPost('name', '');
        $postHeight = $this->params()->fromPost('height', '240');
        $postWidth = $this->params()->fromPost('width', '240'); 
        $postBgColor = $this->params()->fromPost('backgroundColor', 'white');
        $postTextColor = $this->params()->fromPost('textColor', 'black');

        // Create new Theme
        $theme = new Theme();
        $theme->setName($postThemeName);
        $theme->setHeight($postHeight);
        $theme->setWidth($postWidth);
        $theme->setBackgroundColor($postBgColor);
        $theme->setColor($postTextColor);

        $theme->save();
        if (!is_null($theme->getId())) {
            $redirectAction =  $this->redirect();
            $redirectAction->toUrl('/');
        }

        return new JsonModel(
            array(
                'data' => $theme->toArray(),
            )
        );
    }

}
