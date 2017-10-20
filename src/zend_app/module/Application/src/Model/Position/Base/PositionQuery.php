<?php

namespace Application\Model\Position\Base;

use \Exception;
use \PDO;
use Application\Model\Note\Note;
use Application\Model\Position\Position as ChildPosition;
use Application\Model\Position\PositionQuery as ChildPositionQuery;
use Application\Model\Position\Map\PositionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'position' table.
 *
 *
 *
 * @method     ChildPositionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPositionQuery orderByXpos($order = Criteria::ASC) Order by the xpos column
 * @method     ChildPositionQuery orderByYpos($order = Criteria::ASC) Order by the ypos column
 * @method     ChildPositionQuery orderByZpos($order = Criteria::ASC) Order by the zpos column
 *
 * @method     ChildPositionQuery groupById() Group by the id column
 * @method     ChildPositionQuery groupByXpos() Group by the xpos column
 * @method     ChildPositionQuery groupByYpos() Group by the ypos column
 * @method     ChildPositionQuery groupByZpos() Group by the zpos column
 *
 * @method     ChildPositionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPositionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPositionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPositionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPositionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPositionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPositionQuery leftJoinNote($relationAlias = null) Adds a LEFT JOIN clause to the query using the Note relation
 * @method     ChildPositionQuery rightJoinNote($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Note relation
 * @method     ChildPositionQuery innerJoinNote($relationAlias = null) Adds a INNER JOIN clause to the query using the Note relation
 *
 * @method     ChildPositionQuery joinWithNote($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Note relation
 *
 * @method     ChildPositionQuery leftJoinWithNote() Adds a LEFT JOIN clause and with to the query using the Note relation
 * @method     ChildPositionQuery rightJoinWithNote() Adds a RIGHT JOIN clause and with to the query using the Note relation
 * @method     ChildPositionQuery innerJoinWithNote() Adds a INNER JOIN clause and with to the query using the Note relation
 *
 * @method     \Application\Model\Note\NoteQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPosition findOne(ConnectionInterface $con = null) Return the first ChildPosition matching the query
 * @method     ChildPosition findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPosition matching the query, or a new ChildPosition object populated from the query conditions when no match is found
 *
 * @method     ChildPosition findOneById(int $id) Return the first ChildPosition filtered by the id column
 * @method     ChildPosition findOneByXpos(int $xpos) Return the first ChildPosition filtered by the xpos column
 * @method     ChildPosition findOneByYpos(int $ypos) Return the first ChildPosition filtered by the ypos column
 * @method     ChildPosition findOneByZpos(int $zpos) Return the first ChildPosition filtered by the zpos column *

 * @method     ChildPosition requirePk($key, ConnectionInterface $con = null) Return the ChildPosition by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPosition requireOne(ConnectionInterface $con = null) Return the first ChildPosition matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPosition requireOneById(int $id) Return the first ChildPosition filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPosition requireOneByXpos(int $xpos) Return the first ChildPosition filtered by the xpos column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPosition requireOneByYpos(int $ypos) Return the first ChildPosition filtered by the ypos column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPosition requireOneByZpos(int $zpos) Return the first ChildPosition filtered by the zpos column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPosition[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPosition objects based on current ModelCriteria
 * @method     ChildPosition[]|ObjectCollection findById(int $id) Return ChildPosition objects filtered by the id column
 * @method     ChildPosition[]|ObjectCollection findByXpos(int $xpos) Return ChildPosition objects filtered by the xpos column
 * @method     ChildPosition[]|ObjectCollection findByYpos(int $ypos) Return ChildPosition objects filtered by the ypos column
 * @method     ChildPosition[]|ObjectCollection findByZpos(int $zpos) Return ChildPosition objects filtered by the zpos column
 * @method     ChildPosition[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PositionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Application\Model\Position\Base\PositionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Application\\Model\\Position\\Position', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPositionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPositionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPositionQuery) {
            return $criteria;
        }
        $query = new ChildPositionQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPosition|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PositionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PositionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPosition A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `xpos`, `ypos`, `zpos` FROM `position` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildPosition $obj */
            $obj = new ChildPosition();
            $obj->hydrate($row);
            PositionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildPosition|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildPositionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PositionTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPositionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PositionTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPositionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PositionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PositionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PositionTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the xpos column
     *
     * Example usage:
     * <code>
     * $query->filterByXpos(1234); // WHERE xpos = 1234
     * $query->filterByXpos(array(12, 34)); // WHERE xpos IN (12, 34)
     * $query->filterByXpos(array('min' => 12)); // WHERE xpos > 12
     * </code>
     *
     * @param     mixed $xpos The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPositionQuery The current query, for fluid interface
     */
    public function filterByXpos($xpos = null, $comparison = null)
    {
        if (is_array($xpos)) {
            $useMinMax = false;
            if (isset($xpos['min'])) {
                $this->addUsingAlias(PositionTableMap::COL_XPOS, $xpos['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($xpos['max'])) {
                $this->addUsingAlias(PositionTableMap::COL_XPOS, $xpos['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PositionTableMap::COL_XPOS, $xpos, $comparison);
    }

    /**
     * Filter the query on the ypos column
     *
     * Example usage:
     * <code>
     * $query->filterByYpos(1234); // WHERE ypos = 1234
     * $query->filterByYpos(array(12, 34)); // WHERE ypos IN (12, 34)
     * $query->filterByYpos(array('min' => 12)); // WHERE ypos > 12
     * </code>
     *
     * @param     mixed $ypos The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPositionQuery The current query, for fluid interface
     */
    public function filterByYpos($ypos = null, $comparison = null)
    {
        if (is_array($ypos)) {
            $useMinMax = false;
            if (isset($ypos['min'])) {
                $this->addUsingAlias(PositionTableMap::COL_YPOS, $ypos['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ypos['max'])) {
                $this->addUsingAlias(PositionTableMap::COL_YPOS, $ypos['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PositionTableMap::COL_YPOS, $ypos, $comparison);
    }

    /**
     * Filter the query on the zpos column
     *
     * Example usage:
     * <code>
     * $query->filterByZpos(1234); // WHERE zpos = 1234
     * $query->filterByZpos(array(12, 34)); // WHERE zpos IN (12, 34)
     * $query->filterByZpos(array('min' => 12)); // WHERE zpos > 12
     * </code>
     *
     * @param     mixed $zpos The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPositionQuery The current query, for fluid interface
     */
    public function filterByZpos($zpos = null, $comparison = null)
    {
        if (is_array($zpos)) {
            $useMinMax = false;
            if (isset($zpos['min'])) {
                $this->addUsingAlias(PositionTableMap::COL_ZPOS, $zpos['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($zpos['max'])) {
                $this->addUsingAlias(PositionTableMap::COL_ZPOS, $zpos['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PositionTableMap::COL_ZPOS, $zpos, $comparison);
    }

    /**
     * Filter the query by a related \Application\Model\Note\Note object
     *
     * @param \Application\Model\Note\Note|ObjectCollection $note the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPositionQuery The current query, for fluid interface
     */
    public function filterByNote($note, $comparison = null)
    {
        if ($note instanceof \Application\Model\Note\Note) {
            return $this
                ->addUsingAlias(PositionTableMap::COL_ID, $note->getPositionId(), $comparison);
        } elseif ($note instanceof ObjectCollection) {
            return $this
                ->useNoteQuery()
                ->filterByPrimaryKeys($note->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNote() only accepts arguments of type \Application\Model\Note\Note or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Note relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPositionQuery The current query, for fluid interface
     */
    public function joinNote($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Note');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Note');
        }

        return $this;
    }

    /**
     * Use the Note relation Note object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Application\Model\Note\NoteQuery A secondary query class using the current class as primary query
     */
    public function useNoteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinNote($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Note', '\Application\Model\Note\NoteQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPosition $position Object to remove from the list of results
     *
     * @return $this|ChildPositionQuery The current query, for fluid interface
     */
    public function prune($position = null)
    {
        if ($position) {
            $this->addUsingAlias(PositionTableMap::COL_ID, $position->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the position table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PositionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PositionTableMap::clearInstancePool();
            PositionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PositionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PositionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PositionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PositionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PositionQuery
