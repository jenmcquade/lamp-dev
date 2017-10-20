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
use Application\Model\Note\Note;
use Application\Model\Note\NoteQuery;
use Application\Model\Position\Position;

/**
 * Class NoteController 
 * Manage notes through URL calls
 * 
 * @category Controllers
 * @package  Application
 * @author   bistorm.info@gmail.com <bistorm.info@gmail.com>
 * @license  MIT  https://en.wikipedia.org/wiki/MIT_License
 * @link     http://github.com/zendframework/ZendSkeletonApplication
 */
class NotesController extends AbstractActionController
{
    /**
     * Lists all Notes
     *
     * @return object $result
     */
    public function listAllAction()
    {
        $q = new NoteQuery();
        $data = $q->returnAll();

        $result = new JsonModel(
            array(
                'data' => $data,
            )
        );

        return $result;
    }

    /**
     * Add a Note through Post
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

        // Set the X Y Z coordinates for the new note
        $position = new Position();
        $position->setXPos(240);
        $position->setYPos(240);
        $position->setZPos(99);
        $position->save();

        // Get properties from host
        $postTitle = $this->params()->fromPost('title', 'Note Title');
        $postContent = $this->params()->fromPost('content', 'Note Content'); 
        $postThemeId = $this->params()->fromPost('theme', '1');

        // Create new note
        $note = new Note();
        $note->setTitle($postTitle);
        $note->setContent($postContent);
        $note->setThemeId($postThemeId);
        $note->setPositionId($position->getId());
        $note->save();

        // Redirect to index if we were successful
        if (!is_null($note->getId())) {
            $redirectAction = $this->redirect();
            $redirectAction->toUrl('/');
        }

        return new JsonModel(
            array(
                'data' => $note->toArray(),
            )
        );
    }

}