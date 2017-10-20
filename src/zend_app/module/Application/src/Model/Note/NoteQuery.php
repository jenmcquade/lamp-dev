<?php

namespace Application\Model\Note;

use Application\Model\Note\Base\NoteQuery as BaseNoteQuery;

/**
 * Skeleton subclass for performing query and update operations on the 'note' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class NoteQuery extends BaseNoteQuery
{
  public function returnAll() {
    $notes = NoteQuery::create()->find();
    return $notes;
  }

  public function getLatestNote() {
    $latest = NoteQuery::create()->
      orderById('desc')->
      limit(1)->
      find();
    return $latest;
  }
}
