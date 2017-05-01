<?php

namespace Entities\Base;

use \Exception;
use \PDO;
use Entities\Leaderboard as ChildLeaderboard;
use Entities\LeaderboardQuery as ChildLeaderboardQuery;
use Entities\Map\LeaderboardTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'leaderboard' table.
 *
 * 
 *
 * @method     ChildLeaderboardQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildLeaderboardQuery orderByPoints($order = Criteria::ASC) Order by the points column
 * @method     ChildLeaderboardQuery orderByWin($order = Criteria::ASC) Order by the win column
 * @method     ChildLeaderboardQuery orderByDraw($order = Criteria::ASC) Order by the draw column
 * @method     ChildLeaderboardQuery orderByLose($order = Criteria::ASC) Order by the lose column
 * @method     ChildLeaderboardQuery orderByUserid($order = Criteria::ASC) Order by the userid column
 *
 * @method     ChildLeaderboardQuery groupById() Group by the id column
 * @method     ChildLeaderboardQuery groupByPoints() Group by the points column
 * @method     ChildLeaderboardQuery groupByWin() Group by the win column
 * @method     ChildLeaderboardQuery groupByDraw() Group by the draw column
 * @method     ChildLeaderboardQuery groupByLose() Group by the lose column
 * @method     ChildLeaderboardQuery groupByUserid() Group by the userid column
 *
 * @method     ChildLeaderboardQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLeaderboardQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLeaderboardQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLeaderboardQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLeaderboardQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLeaderboardQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLeaderboard findOne(ConnectionInterface $con = null) Return the first ChildLeaderboard matching the query
 * @method     ChildLeaderboard findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLeaderboard matching the query, or a new ChildLeaderboard object populated from the query conditions when no match is found
 *
 * @method     ChildLeaderboard findOneById(int $id) Return the first ChildLeaderboard filtered by the id column
 * @method     ChildLeaderboard findOneByPoints(int $points) Return the first ChildLeaderboard filtered by the points column
 * @method     ChildLeaderboard findOneByWin(int $win) Return the first ChildLeaderboard filtered by the win column
 * @method     ChildLeaderboard findOneByDraw(int $draw) Return the first ChildLeaderboard filtered by the draw column
 * @method     ChildLeaderboard findOneByLose(int $lose) Return the first ChildLeaderboard filtered by the lose column
 * @method     ChildLeaderboard findOneByUserid(int $userid) Return the first ChildLeaderboard filtered by the userid column *

 * @method     ChildLeaderboard requirePk($key, ConnectionInterface $con = null) Return the ChildLeaderboard by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaderboard requireOne(ConnectionInterface $con = null) Return the first ChildLeaderboard matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLeaderboard requireOneById(int $id) Return the first ChildLeaderboard filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaderboard requireOneByPoints(int $points) Return the first ChildLeaderboard filtered by the points column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaderboard requireOneByWin(int $win) Return the first ChildLeaderboard filtered by the win column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaderboard requireOneByDraw(int $draw) Return the first ChildLeaderboard filtered by the draw column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaderboard requireOneByLose(int $lose) Return the first ChildLeaderboard filtered by the lose column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaderboard requireOneByUserid(int $userid) Return the first ChildLeaderboard filtered by the userid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLeaderboard[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLeaderboard objects based on current ModelCriteria
 * @method     ChildLeaderboard[]|ObjectCollection findById(int $id) Return ChildLeaderboard objects filtered by the id column
 * @method     ChildLeaderboard[]|ObjectCollection findByPoints(int $points) Return ChildLeaderboard objects filtered by the points column
 * @method     ChildLeaderboard[]|ObjectCollection findByWin(int $win) Return ChildLeaderboard objects filtered by the win column
 * @method     ChildLeaderboard[]|ObjectCollection findByDraw(int $draw) Return ChildLeaderboard objects filtered by the draw column
 * @method     ChildLeaderboard[]|ObjectCollection findByLose(int $lose) Return ChildLeaderboard objects filtered by the lose column
 * @method     ChildLeaderboard[]|ObjectCollection findByUserid(int $userid) Return ChildLeaderboard objects filtered by the userid column
 * @method     ChildLeaderboard[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LeaderboardQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Entities\Base\LeaderboardQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Entities\\Leaderboard', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLeaderboardQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLeaderboardQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLeaderboardQuery) {
            return $criteria;
        }
        $query = new ChildLeaderboardQuery();
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
     * @return ChildLeaderboard|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LeaderboardTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LeaderboardTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLeaderboard A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, points, win, draw, lose, userid FROM leaderboard WHERE id = :p0';
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
            /** @var ChildLeaderboard $obj */
            $obj = new ChildLeaderboard();
            $obj->hydrate($row);
            LeaderboardTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLeaderboard|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLeaderboardQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LeaderboardTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLeaderboardQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LeaderboardTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildLeaderboardQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeaderboardTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeaderboardTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeaderboardTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the points column
     *
     * Example usage:
     * <code>
     * $query->filterByPoints(1234); // WHERE points = 1234
     * $query->filterByPoints(array(12, 34)); // WHERE points IN (12, 34)
     * $query->filterByPoints(array('min' => 12)); // WHERE points > 12
     * </code>
     *
     * @param     mixed $points The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLeaderboardQuery The current query, for fluid interface
     */
    public function filterByPoints($points = null, $comparison = null)
    {
        if (is_array($points)) {
            $useMinMax = false;
            if (isset($points['min'])) {
                $this->addUsingAlias(LeaderboardTableMap::COL_POINTS, $points['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($points['max'])) {
                $this->addUsingAlias(LeaderboardTableMap::COL_POINTS, $points['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeaderboardTableMap::COL_POINTS, $points, $comparison);
    }

    /**
     * Filter the query on the win column
     *
     * Example usage:
     * <code>
     * $query->filterByWin(1234); // WHERE win = 1234
     * $query->filterByWin(array(12, 34)); // WHERE win IN (12, 34)
     * $query->filterByWin(array('min' => 12)); // WHERE win > 12
     * </code>
     *
     * @param     mixed $win The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLeaderboardQuery The current query, for fluid interface
     */
    public function filterByWin($win = null, $comparison = null)
    {
        if (is_array($win)) {
            $useMinMax = false;
            if (isset($win['min'])) {
                $this->addUsingAlias(LeaderboardTableMap::COL_WIN, $win['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($win['max'])) {
                $this->addUsingAlias(LeaderboardTableMap::COL_WIN, $win['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeaderboardTableMap::COL_WIN, $win, $comparison);
    }

    /**
     * Filter the query on the draw column
     *
     * Example usage:
     * <code>
     * $query->filterByDraw(1234); // WHERE draw = 1234
     * $query->filterByDraw(array(12, 34)); // WHERE draw IN (12, 34)
     * $query->filterByDraw(array('min' => 12)); // WHERE draw > 12
     * </code>
     *
     * @param     mixed $draw The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLeaderboardQuery The current query, for fluid interface
     */
    public function filterByDraw($draw = null, $comparison = null)
    {
        if (is_array($draw)) {
            $useMinMax = false;
            if (isset($draw['min'])) {
                $this->addUsingAlias(LeaderboardTableMap::COL_DRAW, $draw['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($draw['max'])) {
                $this->addUsingAlias(LeaderboardTableMap::COL_DRAW, $draw['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeaderboardTableMap::COL_DRAW, $draw, $comparison);
    }

    /**
     * Filter the query on the lose column
     *
     * Example usage:
     * <code>
     * $query->filterByLose(1234); // WHERE lose = 1234
     * $query->filterByLose(array(12, 34)); // WHERE lose IN (12, 34)
     * $query->filterByLose(array('min' => 12)); // WHERE lose > 12
     * </code>
     *
     * @param     mixed $lose The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLeaderboardQuery The current query, for fluid interface
     */
    public function filterByLose($lose = null, $comparison = null)
    {
        if (is_array($lose)) {
            $useMinMax = false;
            if (isset($lose['min'])) {
                $this->addUsingAlias(LeaderboardTableMap::COL_LOSE, $lose['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lose['max'])) {
                $this->addUsingAlias(LeaderboardTableMap::COL_LOSE, $lose['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeaderboardTableMap::COL_LOSE, $lose, $comparison);
    }

    /**
     * Filter the query on the userid column
     *
     * Example usage:
     * <code>
     * $query->filterByUserid(1234); // WHERE userid = 1234
     * $query->filterByUserid(array(12, 34)); // WHERE userid IN (12, 34)
     * $query->filterByUserid(array('min' => 12)); // WHERE userid > 12
     * </code>
     *
     * @param     mixed $userid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLeaderboardQuery The current query, for fluid interface
     */
    public function filterByUserid($userid = null, $comparison = null)
    {
        if (is_array($userid)) {
            $useMinMax = false;
            if (isset($userid['min'])) {
                $this->addUsingAlias(LeaderboardTableMap::COL_USERID, $userid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userid['max'])) {
                $this->addUsingAlias(LeaderboardTableMap::COL_USERID, $userid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LeaderboardTableMap::COL_USERID, $userid, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildLeaderboard $leaderboard Object to remove from the list of results
     *
     * @return $this|ChildLeaderboardQuery The current query, for fluid interface
     */
    public function prune($leaderboard = null)
    {
        if ($leaderboard) {
            $this->addUsingAlias(LeaderboardTableMap::COL_ID, $leaderboard->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the leaderboard table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LeaderboardTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LeaderboardTableMap::clearInstancePool();
            LeaderboardTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LeaderboardTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LeaderboardTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            LeaderboardTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            LeaderboardTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LeaderboardQuery
