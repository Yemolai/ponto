<?php

namespace Base;

use \Marcacoes as ChildMarcacoes;
use \MarcacoesQuery as ChildMarcacoesQuery;
use \Exception;
use \PDO;
use Map\MarcacoesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'marcacoes' table.
 *
 *
 *
 * @method     ChildMarcacoesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildMarcacoesQuery orderByNsr($order = Criteria::ASC) Order by the nsr column
 * @method     ChildMarcacoesQuery orderByDatetime($order = Criteria::ASC) Order by the datetime column
 * @method     ChildMarcacoesQuery orderByCreatedat($order = Criteria::ASC) Order by the createdAt column
 * @method     ChildMarcacoesQuery orderByUpdatedat($order = Criteria::ASC) Order by the updatedAt column
 * @method     ChildMarcacoesQuery orderByPonto($order = Criteria::ASC) Order by the ponto column
 * @method     ChildMarcacoesQuery orderByPis($order = Criteria::ASC) Order by the pis column
 *
 * @method     ChildMarcacoesQuery groupById() Group by the id column
 * @method     ChildMarcacoesQuery groupByNsr() Group by the nsr column
 * @method     ChildMarcacoesQuery groupByDatetime() Group by the datetime column
 * @method     ChildMarcacoesQuery groupByCreatedat() Group by the createdAt column
 * @method     ChildMarcacoesQuery groupByUpdatedat() Group by the updatedAt column
 * @method     ChildMarcacoesQuery groupByPonto() Group by the ponto column
 * @method     ChildMarcacoesQuery groupByPis() Group by the pis column
 *
 * @method     ChildMarcacoesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMarcacoesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMarcacoesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMarcacoesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMarcacoesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMarcacoesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMarcacoesQuery leftJoinFuncionarios($relationAlias = null) Adds a LEFT JOIN clause to the query using the Funcionarios relation
 * @method     ChildMarcacoesQuery rightJoinFuncionarios($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Funcionarios relation
 * @method     ChildMarcacoesQuery innerJoinFuncionarios($relationAlias = null) Adds a INNER JOIN clause to the query using the Funcionarios relation
 *
 * @method     ChildMarcacoesQuery joinWithFuncionarios($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Funcionarios relation
 *
 * @method     ChildMarcacoesQuery leftJoinWithFuncionarios() Adds a LEFT JOIN clause and with to the query using the Funcionarios relation
 * @method     ChildMarcacoesQuery rightJoinWithFuncionarios() Adds a RIGHT JOIN clause and with to the query using the Funcionarios relation
 * @method     ChildMarcacoesQuery innerJoinWithFuncionarios() Adds a INNER JOIN clause and with to the query using the Funcionarios relation
 *
 * @method     ChildMarcacoesQuery leftJoinPontos($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pontos relation
 * @method     ChildMarcacoesQuery rightJoinPontos($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pontos relation
 * @method     ChildMarcacoesQuery innerJoinPontos($relationAlias = null) Adds a INNER JOIN clause to the query using the Pontos relation
 *
 * @method     ChildMarcacoesQuery joinWithPontos($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pontos relation
 *
 * @method     ChildMarcacoesQuery leftJoinWithPontos() Adds a LEFT JOIN clause and with to the query using the Pontos relation
 * @method     ChildMarcacoesQuery rightJoinWithPontos() Adds a RIGHT JOIN clause and with to the query using the Pontos relation
 * @method     ChildMarcacoesQuery innerJoinWithPontos() Adds a INNER JOIN clause and with to the query using the Pontos relation
 *
 * @method     \FuncionariosQuery|\PontosQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMarcacoes findOne(ConnectionInterface $con = null) Return the first ChildMarcacoes matching the query
 * @method     ChildMarcacoes findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMarcacoes matching the query, or a new ChildMarcacoes object populated from the query conditions when no match is found
 *
 * @method     ChildMarcacoes findOneById(int $id) Return the first ChildMarcacoes filtered by the id column
 * @method     ChildMarcacoes findOneByNsr(string $nsr) Return the first ChildMarcacoes filtered by the nsr column
 * @method     ChildMarcacoes findOneByDatetime(string $datetime) Return the first ChildMarcacoes filtered by the datetime column
 * @method     ChildMarcacoes findOneByCreatedat(string $createdAt) Return the first ChildMarcacoes filtered by the createdAt column
 * @method     ChildMarcacoes findOneByUpdatedat(string $updatedAt) Return the first ChildMarcacoes filtered by the updatedAt column
 * @method     ChildMarcacoes findOneByPonto(int $ponto) Return the first ChildMarcacoes filtered by the ponto column
 * @method     ChildMarcacoes findOneByPis(string $pis) Return the first ChildMarcacoes filtered by the pis column *

 * @method     ChildMarcacoes requirePk($key, ConnectionInterface $con = null) Return the ChildMarcacoes by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMarcacoes requireOne(ConnectionInterface $con = null) Return the first ChildMarcacoes matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMarcacoes requireOneById(int $id) Return the first ChildMarcacoes filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMarcacoes requireOneByNsr(string $nsr) Return the first ChildMarcacoes filtered by the nsr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMarcacoes requireOneByDatetime(string $datetime) Return the first ChildMarcacoes filtered by the datetime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMarcacoes requireOneByCreatedat(string $createdAt) Return the first ChildMarcacoes filtered by the createdAt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMarcacoes requireOneByUpdatedat(string $updatedAt) Return the first ChildMarcacoes filtered by the updatedAt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMarcacoes requireOneByPonto(int $ponto) Return the first ChildMarcacoes filtered by the ponto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMarcacoes requireOneByPis(string $pis) Return the first ChildMarcacoes filtered by the pis column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMarcacoes[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMarcacoes objects based on current ModelCriteria
 * @method     ChildMarcacoes[]|ObjectCollection findById(int $id) Return ChildMarcacoes objects filtered by the id column
 * @method     ChildMarcacoes[]|ObjectCollection findByNsr(string $nsr) Return ChildMarcacoes objects filtered by the nsr column
 * @method     ChildMarcacoes[]|ObjectCollection findByDatetime(string $datetime) Return ChildMarcacoes objects filtered by the datetime column
 * @method     ChildMarcacoes[]|ObjectCollection findByCreatedat(string $createdAt) Return ChildMarcacoes objects filtered by the createdAt column
 * @method     ChildMarcacoes[]|ObjectCollection findByUpdatedat(string $updatedAt) Return ChildMarcacoes objects filtered by the updatedAt column
 * @method     ChildMarcacoes[]|ObjectCollection findByPonto(int $ponto) Return ChildMarcacoes objects filtered by the ponto column
 * @method     ChildMarcacoes[]|ObjectCollection findByPis(string $pis) Return ChildMarcacoes objects filtered by the pis column
 * @method     ChildMarcacoes[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MarcacoesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\MarcacoesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ponto', $modelName = '\\Marcacoes', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMarcacoesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMarcacoesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMarcacoesQuery) {
            return $criteria;
        }
        $query = new ChildMarcacoesQuery();
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
     * @return ChildMarcacoes|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MarcacoesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MarcacoesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildMarcacoes A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, nsr, datetime, createdAt, updatedAt, ponto, pis FROM marcacoes WHERE id = :p0';
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
            /** @var ChildMarcacoes $obj */
            $obj = new ChildMarcacoes();
            $obj->hydrate($row);
            MarcacoesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildMarcacoes|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildMarcacoesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MarcacoesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMarcacoesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MarcacoesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildMarcacoesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(MarcacoesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(MarcacoesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MarcacoesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the nsr column
     *
     * Example usage:
     * <code>
     * $query->filterByNsr(1234); // WHERE nsr = 1234
     * $query->filterByNsr(array(12, 34)); // WHERE nsr IN (12, 34)
     * $query->filterByNsr(array('min' => 12)); // WHERE nsr > 12
     * </code>
     *
     * @param     mixed $nsr The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMarcacoesQuery The current query, for fluid interface
     */
    public function filterByNsr($nsr = null, $comparison = null)
    {
        if (is_array($nsr)) {
            $useMinMax = false;
            if (isset($nsr['min'])) {
                $this->addUsingAlias(MarcacoesTableMap::COL_NSR, $nsr['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nsr['max'])) {
                $this->addUsingAlias(MarcacoesTableMap::COL_NSR, $nsr['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MarcacoesTableMap::COL_NSR, $nsr, $comparison);
    }

    /**
     * Filter the query on the datetime column
     *
     * Example usage:
     * <code>
     * $query->filterByDatetime('2011-03-14'); // WHERE datetime = '2011-03-14'
     * $query->filterByDatetime('now'); // WHERE datetime = '2011-03-14'
     * $query->filterByDatetime(array('max' => 'yesterday')); // WHERE datetime > '2011-03-13'
     * </code>
     *
     * @param     mixed $datetime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMarcacoesQuery The current query, for fluid interface
     */
    public function filterByDatetime($datetime = null, $comparison = null)
    {
        if (is_array($datetime)) {
            $useMinMax = false;
            if (isset($datetime['min'])) {
                $this->addUsingAlias(MarcacoesTableMap::COL_DATETIME, $datetime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($datetime['max'])) {
                $this->addUsingAlias(MarcacoesTableMap::COL_DATETIME, $datetime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MarcacoesTableMap::COL_DATETIME, $datetime, $comparison);
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
     * @return $this|ChildMarcacoesQuery The current query, for fluid interface
     */
    public function filterByCreatedat($createdat = null, $comparison = null)
    {
        if (is_array($createdat)) {
            $useMinMax = false;
            if (isset($createdat['min'])) {
                $this->addUsingAlias(MarcacoesTableMap::COL_CREATEDAT, $createdat['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdat['max'])) {
                $this->addUsingAlias(MarcacoesTableMap::COL_CREATEDAT, $createdat['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MarcacoesTableMap::COL_CREATEDAT, $createdat, $comparison);
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
     * @return $this|ChildMarcacoesQuery The current query, for fluid interface
     */
    public function filterByUpdatedat($updatedat = null, $comparison = null)
    {
        if (is_array($updatedat)) {
            $useMinMax = false;
            if (isset($updatedat['min'])) {
                $this->addUsingAlias(MarcacoesTableMap::COL_UPDATEDAT, $updatedat['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedat['max'])) {
                $this->addUsingAlias(MarcacoesTableMap::COL_UPDATEDAT, $updatedat['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MarcacoesTableMap::COL_UPDATEDAT, $updatedat, $comparison);
    }

    /**
     * Filter the query on the ponto column
     *
     * Example usage:
     * <code>
     * $query->filterByPonto(1234); // WHERE ponto = 1234
     * $query->filterByPonto(array(12, 34)); // WHERE ponto IN (12, 34)
     * $query->filterByPonto(array('min' => 12)); // WHERE ponto > 12
     * </code>
     *
     * @see       filterByPontos()
     *
     * @param     mixed $ponto The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMarcacoesQuery The current query, for fluid interface
     */
    public function filterByPonto($ponto = null, $comparison = null)
    {
        if (is_array($ponto)) {
            $useMinMax = false;
            if (isset($ponto['min'])) {
                $this->addUsingAlias(MarcacoesTableMap::COL_PONTO, $ponto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ponto['max'])) {
                $this->addUsingAlias(MarcacoesTableMap::COL_PONTO, $ponto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MarcacoesTableMap::COL_PONTO, $ponto, $comparison);
    }

    /**
     * Filter the query on the pis column
     *
     * Example usage:
     * <code>
     * $query->filterByPis(1234); // WHERE pis = 1234
     * $query->filterByPis(array(12, 34)); // WHERE pis IN (12, 34)
     * $query->filterByPis(array('min' => 12)); // WHERE pis > 12
     * </code>
     *
     * @see       filterByFuncionarios()
     *
     * @param     mixed $pis The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMarcacoesQuery The current query, for fluid interface
     */
    public function filterByPis($pis = null, $comparison = null)
    {
        if (is_array($pis)) {
            $useMinMax = false;
            if (isset($pis['min'])) {
                $this->addUsingAlias(MarcacoesTableMap::COL_PIS, $pis['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pis['max'])) {
                $this->addUsingAlias(MarcacoesTableMap::COL_PIS, $pis['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MarcacoesTableMap::COL_PIS, $pis, $comparison);
    }

    /**
     * Filter the query by a related \Funcionarios object
     *
     * @param \Funcionarios|ObjectCollection $funcionarios The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMarcacoesQuery The current query, for fluid interface
     */
    public function filterByFuncionarios($funcionarios, $comparison = null)
    {
        if ($funcionarios instanceof \Funcionarios) {
            return $this
                ->addUsingAlias(MarcacoesTableMap::COL_PIS, $funcionarios->getPis(), $comparison);
        } elseif ($funcionarios instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MarcacoesTableMap::COL_PIS, $funcionarios->toKeyValue('PrimaryKey', 'Pis'), $comparison);
        } else {
            throw new PropelException('filterByFuncionarios() only accepts arguments of type \Funcionarios or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Funcionarios relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMarcacoesQuery The current query, for fluid interface
     */
    public function joinFuncionarios($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Funcionarios');

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
            $this->addJoinObject($join, 'Funcionarios');
        }

        return $this;
    }

    /**
     * Use the Funcionarios relation Funcionarios object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \FuncionariosQuery A secondary query class using the current class as primary query
     */
    public function useFuncionariosQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFuncionarios($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Funcionarios', '\FuncionariosQuery');
    }

    /**
     * Filter the query by a related \Pontos object
     *
     * @param \Pontos|ObjectCollection $pontos The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMarcacoesQuery The current query, for fluid interface
     */
    public function filterByPontos($pontos, $comparison = null)
    {
        if ($pontos instanceof \Pontos) {
            return $this
                ->addUsingAlias(MarcacoesTableMap::COL_PONTO, $pontos->getId(), $comparison);
        } elseif ($pontos instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MarcacoesTableMap::COL_PONTO, $pontos->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPontos() only accepts arguments of type \Pontos or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Pontos relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMarcacoesQuery The current query, for fluid interface
     */
    public function joinPontos($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Pontos');

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
            $this->addJoinObject($join, 'Pontos');
        }

        return $this;
    }

    /**
     * Use the Pontos relation Pontos object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PontosQuery A secondary query class using the current class as primary query
     */
    public function usePontosQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPontos($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Pontos', '\PontosQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildMarcacoes $marcacoes Object to remove from the list of results
     *
     * @return $this|ChildMarcacoesQuery The current query, for fluid interface
     */
    public function prune($marcacoes = null)
    {
        if ($marcacoes) {
            $this->addUsingAlias(MarcacoesTableMap::COL_ID, $marcacoes->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the marcacoes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MarcacoesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MarcacoesTableMap::clearInstancePool();
            MarcacoesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MarcacoesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MarcacoesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MarcacoesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MarcacoesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // MarcacoesQuery
