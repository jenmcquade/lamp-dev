<?php

namespace Application\Model\Note;

use Application\Model\Note\Base\Note as BaseNote;
use Propel\Runtime\Connection\ConnectionInterface;


/**
 * Skeleton subclass for representing a row from the 'note' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Note extends BaseNote
{
  public function preInsert(ConnectionInterface $con = null) {
    $this->setCreatedAt(time());
    return true;
  }
}
