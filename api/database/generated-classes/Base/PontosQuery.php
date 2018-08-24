<?php

namespace Base;

use \Pontos as ChildPontos;
use \PontosQuery as ChildPontosQuery;
use \Exception;
use \PDO;
use Map\PontosTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'pontos' table.
 *
 *
 *
 * @method     ChildPontosQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPontosQuery orderByNome($order = Criteria::ASC) Order by the nome column
 * @method     ChildPontosQuery orderByIp($order = Criteria::ASC) Order by the ip column
 * @method     ChildPontosQuery orderByCreatedat($order = Criteria::ASC) Order by the createdAt column
 * @method     ChildPontosQuery orderByUpdatedat($order = Criteria::ASC) Order by the updatedAt column
 *
 * @method     ChildPontosQuery groupById() Group by the id column
 * @method     ChildPontosQuery groupByNome() Group by the nome column
 * @method     ChildPontosQuery groupByIp() Group by the ip column
 * @method     ChildPontosQuery groupByCreatedat() Group by the createdAt column
 * @method     ChildPontosQuery groupByUpdatedat() Group by the updatedAt column
 *
 * @method     ChildPontosQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPontosQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPontosQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPontosQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPontosQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPontosQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPontosQuery leftJoinMarcacoes($relationAlias = null) Adds a LEFT JOIN clause to the query using the Marcacoes relation
 * @method     ChildPontosQuery rightJoinMarcacoes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Marcacoes relation
 * @method     ChildPontosQuery innerJoinMarcacoes($relationAlias = null) Adds a INNER JOIN clause to the query using the Marcacoes relation
 *
 * @method     ChildPontosQuery joinWithMarcacoes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Marcacoes relation
 *
 * @method     ChildPontosQuery leftJoinWithMarcacoes() Adds a LEFT JOIN clause and with to the query using the Marcacoes relation
 * @method     ChildPontosQuery rightJoinWithMarcacoes() Adds a RIGHT JOIN clause and with to the query using the Marcacoes relation
 * @method     ChildPontosQuery innerJoinWithMarcacoes() Adds a INNER JOIN clause and with to the query using the Marcacoes relation
 *
 * @method     \MarcacoesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPontos findOne(ConnectionInterface $con = null) Return the first ChildPontos matching the query
 * @method     ChildPontos findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPontos matching the query, or a new ChildPontos object populated from the query conditions when no match is found
 *
 * @method     ChildPontos findOneById(int $id) Return the first ChildPontos filtered by the id column
 * @method     ChildPontos findOneByNome(string $nome) Return the first ChildPontos filtered by the nome column
 * @method     ChildPontos findOneByIp(string $ip) Return the first ChildPontos filtered by the ip column
 * @method     ChildPontos findOneByCreatedat(string $createdAt) Return the first ChildPontos filtered by the createdAt column
 * @method     ChildPontos findOneByUpdatedat(string $updatedAt) Return the first ChildPontos filtered by the updatedAt column *

 * @method     ChildPontos requirePk($key, ConnectionInterface $con = null) Return the ChildPontos by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPontos requireOne(ConnectionInterface $con = null) Return the first ChildPontos matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPontos requireOneById(int $id) Return the first ChildPontos filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPontos requireOneByNome(string $nome) Return the first ChildPontos filtered by the nome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPontos requireOneByIp(string $ip) Return the first ChildPontos filtered by the ip column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPontos requireOneByCreatedat(string $createdAt) Return the first ChildPontos filtered by the createdAt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPontos requireOneByUpdatedat(string $updatedAt) Return the first ChildPontos filtered by the updatedAt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPontos[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPontos objects based on current ModelCriteria
 * @method     ChildPontos[]|ObjectCollection findById(int $id) Return ChildPontos objects filtered by the id column
 * @method     ChildPontos[]|ObjectCollection findByNome(string $nome) Return ChildPontos objects filtered by the nome column
 * @method     ChildPontos[]|ObjectCollection findByIp(string $ip) Return ChildPontos objects filtered by the ip column
 * @method     ChildPontos[]|ObjectCollection findByCreatedat(string $createdAt) Return ChildPontos objects filtered by the createdAt column
 * @method     ChildPontos[]|ObjectCollection findByUpdatedat(string $updatedAt) Return ChildPontos objects filtered by the updatedAt column
 * @method     ChildPontos[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PontosQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PontosQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ponto', $modelName = '\\Pontos', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPontosQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPontosQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPontosQuery) {
            return $criteria;
        }
        $query = new ChildPontosQuery();
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
     * @return ChildPontos|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PontosTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PontosTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPontos A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, nome, ip, createdAt, updatedAt FROM pontos WHERE id = :p0';
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
            /** @var ChildPontos $obj */
            $obj = new ChildPontos();
            $obj->hydrate($row);
            PontosTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPontos|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPontosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PontosTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPontosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PontosTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildPontosQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PontosTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PontosTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PontosTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the nome column
     *
     * Example usage:
     * <code>
     * $query->filterByNome('fooValue');   // WHERE nome = 'fooValue'
     * $query->filterByNome('%fooValue%', Criteria::LIKE); // WHERE nome LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nome The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPontosQuery The current query, for fluid interface
     */
    public function filterByNome($nome = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nome)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PontosTableMap::COL_NOME, $nome, $comparison);
    }

    /**
     * Filter the query on the ip column
     *
     * Example usage:
     * <code>
     * $query->filterByIp('fooValue');   // WHERE ip = 'fooValue'
     * $query->filterByIp('%fooValue%', Criteria::LIKE); // WHERE ip LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ip The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPontosQuery The current query, for fluid interface
     */
    public function filterByIp($ip = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ip)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PontosTableMap::COL_IP, $ip, $comparison);
    }

    /**
     * Filter the query on the createdAt column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedat('2011-03-14'); // WHERE createdAt = '2011-03-14'
     * $query->filterByCreatedat('now'); // WHERE createdAt = '2011-03-14'
     * $query->filterByCreatedat(array('max' => 'yesterday')); // WHERE createdAt > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdat The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPontosQuery The current query, for fluid interface
     */
    public function filterByCreatedat($createdat = null, $comparison = null)
    {
        if (is_array($createdat)) {
            $useMinMax = false;
            if (isset($createdat['min'])) {
                $this->addUsingAlias(PontosTableMap::COL_CREATEDAT, $createdat['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdat['max'])) {
                $this->addUsingAlias(PontosTableMap::COL_CREATEDAT, $createdat['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PontosTableMap::COL_CREATEDAT, $createdat, $comparison);
    }

    /**
     * Filter the query on the updatedAt column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedat('2011-03-14'); // WHERE updatedAt = '2011-03-14'
     * $query->filterByUpdatedat('now'); // WHERE updatedAt = '2011-03-14'
     * $query->filterByUpdatedat(array('max' => 'yesterday')); // WHERE updatedAt > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedat The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPontosQuery The current query, for fluid interface
     */
    public function filterByUpdatedat($updatedat = null, $comparison = null)
    {
        if (is_array($updatedat)) {
            $useMinMax = false;
            if (isset($updatedat['min'])) {
                $this->addUsingAlias(PontosTableMap::COL_UPDATEDAT, $updatedat['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedat['max'])) {
                $this->addUsingAlias(PontosTableMap::COL_UPDATEDAT, $updatedat['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PontosTableMap::COL_UPDATEDAT, $updatedat, $comparison);
    }

    /**
     * Filter the query by a related \Marcacoes object
     *
     * @param \Marcacoes|ObjectCollection $marcacoes the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPontosQuery The current query, for fluid interface
     */
    public function filterByMarcacoes($marcacoes, $comparison = null)
    {
        if ($marcacoes instanceof \Marcacoes) {
            return $this
                ->addUsingAlias(PontosTableMap::COL_ID, $marcacoes->getPonto(), $comparison);
        } elseif ($marcacoes instanceof ObjectCollection) {
            return $this
                ->useMarcacoesQuery()
                ->filterByPrimaryKeys($marcacoes->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMarcacoes() only accepts arguments of type \Marcacoes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Marcacoes relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPontosQuery The current query, for fluid interface
     */
    public function joinMarcacoes($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Marcacoes');

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
            $this->addJoinObject($join, 'Marcacoes');
        }

        return $this;
    }

    /**
     * Use the Marcacoes relation Marcacoes object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \MarcacoesQuery A secondary query class using the current class as primary query
     */
    public function useMarcacoesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMarcacoes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Marcacoes', '\MarcacoesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPontos $pontos Object to remove from the list of results
     *
     * @return $this|ChildPontosQuery The current query, for fluid interface
     */
    public function prune($pontos = null)
    {
        if ($pontos) {
            $this->addUsingAlias(PontosTableMap::COL_ID, $pontos->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the pontos table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PontosTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PontosTableMap::clearInstancePool();
            PontosTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PontosTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PontosTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PontosTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PontosTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PontosQuery
