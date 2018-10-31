<?php

namespace Base;

use \Funcionarios as ChildFuncionarios;
use \FuncionariosQuery as ChildFuncionariosQuery;
use \Exception;
use \PDO;
use Map\FuncionariosTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'funcionarios' table.
 *
 *
 *
 * @method     ChildFuncionariosQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildFuncionariosQuery orderByNome($order = Criteria::ASC) Order by the nome column
 * @method     ChildFuncionariosQuery orderByMatricula($order = Criteria::ASC) Order by the matricula column
 * @method     ChildFuncionariosQuery orderByPis($order = Criteria::ASC) Order by the pis column
 * @method     ChildFuncionariosQuery orderByCreatedat($order = Criteria::ASC) Order by the createdAt column
 * @method     ChildFuncionariosQuery orderByUpdatedat($order = Criteria::ASC) Order by the updatedAt column
 * @method     ChildFuncionariosQuery orderBysamaccountname($order = Criteria::ASC) Order by the samaccountname column
 * @method     ChildFuncionariosQuery orderByusername($order = Criteria::ASC) Order by the username column
 * @method     ChildFuncionariosQuery orderByuserprincipalname($order = Criteria::ASC) Order by the userprincipalname column
 * @method     ChildFuncionariosQuery orderBydn($order = Criteria::ASC) Order by the dn column
 *
 * @method     ChildFuncionariosQuery groupById() Group by the id column
 * @method     ChildFuncionariosQuery groupByNome() Group by the nome column
 * @method     ChildFuncionariosQuery groupByMatricula() Group by the matricula column
 * @method     ChildFuncionariosQuery groupByPis() Group by the pis column
 * @method     ChildFuncionariosQuery groupByCreatedat() Group by the createdAt column
 * @method     ChildFuncionariosQuery groupByUpdatedat() Group by the updatedAt column
 * @method     ChildFuncionariosQuery groupBysamaccountname() Group by the samaccountname column
 * @method     ChildFuncionariosQuery groupByusername() Group by the username column
 * @method     ChildFuncionariosQuery groupByuserprincipalname() Group by the userprincipalname column
 * @method     ChildFuncionariosQuery groupBydn() Group by the dn column
 *
 * @method     ChildFuncionariosQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFuncionariosQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFuncionariosQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFuncionariosQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFuncionariosQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFuncionariosQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFuncionariosQuery leftJoinMarcacoes($relationAlias = null) Adds a LEFT JOIN clause to the query using the Marcacoes relation
 * @method     ChildFuncionariosQuery rightJoinMarcacoes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Marcacoes relation
 * @method     ChildFuncionariosQuery innerJoinMarcacoes($relationAlias = null) Adds a INNER JOIN clause to the query using the Marcacoes relation
 *
 * @method     ChildFuncionariosQuery joinWithMarcacoes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Marcacoes relation
 *
 * @method     ChildFuncionariosQuery leftJoinWithMarcacoes() Adds a LEFT JOIN clause and with to the query using the Marcacoes relation
 * @method     ChildFuncionariosQuery rightJoinWithMarcacoes() Adds a RIGHT JOIN clause and with to the query using the Marcacoes relation
 * @method     ChildFuncionariosQuery innerJoinWithMarcacoes() Adds a INNER JOIN clause and with to the query using the Marcacoes relation
 *
 * @method     \MarcacoesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFuncionarios findOne(ConnectionInterface $con = null) Return the first ChildFuncionarios matching the query
 * @method     ChildFuncionarios findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFuncionarios matching the query, or a new ChildFuncionarios object populated from the query conditions when no match is found
 *
 * @method     ChildFuncionarios findOneById(int $id) Return the first ChildFuncionarios filtered by the id column
 * @method     ChildFuncionarios findOneByNome(string $nome) Return the first ChildFuncionarios filtered by the nome column
 * @method     ChildFuncionarios findOneByMatricula(string $matricula) Return the first ChildFuncionarios filtered by the matricula column
 * @method     ChildFuncionarios findOneByPis(string $pis) Return the first ChildFuncionarios filtered by the pis column
 * @method     ChildFuncionarios findOneByCreatedat(string $createdAt) Return the first ChildFuncionarios filtered by the createdAt column
 * @method     ChildFuncionarios findOneByUpdatedat(string $updatedAt) Return the first ChildFuncionarios filtered by the updatedAt column
 * @method     ChildFuncionarios findOneBysamaccountname(string $samaccountname) Return the first ChildFuncionarios filtered by the samaccountname column
 * @method     ChildFuncionarios findOneByusername(string $username) Return the first ChildFuncionarios filtered by the username column
 * @method     ChildFuncionarios findOneByuserprincipalname(string $userprincipalname) Return the first ChildFuncionarios filtered by the userprincipalname column
 * @method     ChildFuncionarios findOneBydn(string $dn) Return the first ChildFuncionarios filtered by the dn column *

 * @method     ChildFuncionarios requirePk($key, ConnectionInterface $con = null) Return the ChildFuncionarios by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFuncionarios requireOne(ConnectionInterface $con = null) Return the first ChildFuncionarios matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFuncionarios requireOneById(int $id) Return the first ChildFuncionarios filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFuncionarios requireOneByNome(string $nome) Return the first ChildFuncionarios filtered by the nome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFuncionarios requireOneByMatricula(string $matricula) Return the first ChildFuncionarios filtered by the matricula column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFuncionarios requireOneByPis(string $pis) Return the first ChildFuncionarios filtered by the pis column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFuncionarios requireOneByCreatedat(string $createdAt) Return the first ChildFuncionarios filtered by the createdAt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFuncionarios requireOneByUpdatedat(string $updatedAt) Return the first ChildFuncionarios filtered by the updatedAt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFuncionarios requireOneBysamaccountname(string $samaccountname) Return the first ChildFuncionarios filtered by the samaccountname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFuncionarios requireOneByusername(string $username) Return the first ChildFuncionarios filtered by the username column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFuncionarios requireOneByuserprincipalname(string $userprincipalname) Return the first ChildFuncionarios filtered by the userprincipalname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFuncionarios requireOneBydn(string $dn) Return the first ChildFuncionarios filtered by the dn column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFuncionarios[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFuncionarios objects based on current ModelCriteria
 * @method     ChildFuncionarios[]|ObjectCollection findById(int $id) Return ChildFuncionarios objects filtered by the id column
 * @method     ChildFuncionarios[]|ObjectCollection findByNome(string $nome) Return ChildFuncionarios objects filtered by the nome column
 * @method     ChildFuncionarios[]|ObjectCollection findByMatricula(string $matricula) Return ChildFuncionarios objects filtered by the matricula column
 * @method     ChildFuncionarios[]|ObjectCollection findByPis(string $pis) Return ChildFuncionarios objects filtered by the pis column
 * @method     ChildFuncionarios[]|ObjectCollection findByCreatedat(string $createdAt) Return ChildFuncionarios objects filtered by the createdAt column
 * @method     ChildFuncionarios[]|ObjectCollection findByUpdatedat(string $updatedAt) Return ChildFuncionarios objects filtered by the updatedAt column
 * @method     ChildFuncionarios[]|ObjectCollection findBysamaccountname(string $samaccountname) Return ChildFuncionarios objects filtered by the samaccountname column
 * @method     ChildFuncionarios[]|ObjectCollection findByusername(string $username) Return ChildFuncionarios objects filtered by the username column
 * @method     ChildFuncionarios[]|ObjectCollection findByuserprincipalname(string $userprincipalname) Return ChildFuncionarios objects filtered by the userprincipalname column
 * @method     ChildFuncionarios[]|ObjectCollection findBydn(string $dn) Return ChildFuncionarios objects filtered by the dn column
 * @method     ChildFuncionarios[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FuncionariosQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\FuncionariosQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ponto', $modelName = '\\Funcionarios', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFuncionariosQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFuncionariosQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFuncionariosQuery) {
            return $criteria;
        }
        $query = new ChildFuncionariosQuery();
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
     * @return ChildFuncionarios|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FuncionariosTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FuncionariosTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFuncionarios A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, nome, matricula, pis, createdAt, updatedAt, samaccountname, username, userprincipalname, dn FROM funcionarios WHERE id = :p0';
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
            /** @var ChildFuncionarios $obj */
            $obj = new ChildFuncionarios();
            $obj->hydrate($row);
            FuncionariosTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFuncionarios|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFuncionariosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FuncionariosTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFuncionariosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FuncionariosTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildFuncionariosQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(FuncionariosTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(FuncionariosTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FuncionariosTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildFuncionariosQuery The current query, for fluid interface
     */
    public function filterByNome($nome = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nome)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FuncionariosTableMap::COL_NOME, $nome, $comparison);
    }

    /**
     * Filter the query on the matricula column
     *
     * Example usage:
     * <code>
     * $query->filterByMatricula(1234); // WHERE matricula = 1234
     * $query->filterByMatricula(array(12, 34)); // WHERE matricula IN (12, 34)
     * $query->filterByMatricula(array('min' => 12)); // WHERE matricula > 12
     * </code>
     *
     * @param     mixed $matricula The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFuncionariosQuery The current query, for fluid interface
     */
    public function filterByMatricula($matricula = null, $comparison = null)
    {
        if (is_array($matricula)) {
            $useMinMax = false;
            if (isset($matricula['min'])) {
                $this->addUsingAlias(FuncionariosTableMap::COL_MATRICULA, $matricula['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($matricula['max'])) {
                $this->addUsingAlias(FuncionariosTableMap::COL_MATRICULA, $matricula['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FuncionariosTableMap::COL_MATRICULA, $matricula, $comparison);
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
     * @param     mixed $pis The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFuncionariosQuery The current query, for fluid interface
     */
    public function filterByPis($pis = null, $comparison = null)
    {
        if (is_array($pis)) {
            $useMinMax = false;
            if (isset($pis['min'])) {
                $this->addUsingAlias(FuncionariosTableMap::COL_PIS, $pis['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pis['max'])) {
                $this->addUsingAlias(FuncionariosTableMap::COL_PIS, $pis['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FuncionariosTableMap::COL_PIS, $pis, $comparison);
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
     * @return $this|ChildFuncionariosQuery The current query, for fluid interface
     */
    public function filterByCreatedat($createdat = null, $comparison = null)
    {
        if (is_array($createdat)) {
            $useMinMax = false;
            if (isset($createdat['min'])) {
                $this->addUsingAlias(FuncionariosTableMap::COL_CREATEDAT, $createdat['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdat['max'])) {
                $this->addUsingAlias(FuncionariosTableMap::COL_CREATEDAT, $createdat['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FuncionariosTableMap::COL_CREATEDAT, $createdat, $comparison);
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
     * @return $this|ChildFuncionariosQuery The current query, for fluid interface
     */
    public function filterByUpdatedat($updatedat = null, $comparison = null)
    {
        if (is_array($updatedat)) {
            $useMinMax = false;
            if (isset($updatedat['min'])) {
                $this->addUsingAlias(FuncionariosTableMap::COL_UPDATEDAT, $updatedat['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedat['max'])) {
                $this->addUsingAlias(FuncionariosTableMap::COL_UPDATEDAT, $updatedat['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FuncionariosTableMap::COL_UPDATEDAT, $updatedat, $comparison);
    }

    /**
     * Filter the query on the samaccountname column
     *
     * Example usage:
     * <code>
     * $query->filterBysamaccountname('fooValue');   // WHERE samaccountname = 'fooValue'
     * $query->filterBysamaccountname('%fooValue%', Criteria::LIKE); // WHERE samaccountname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $samaccountname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFuncionariosQuery The current query, for fluid interface
     */
    public function filterBysamaccountname($samaccountname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($samaccountname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FuncionariosTableMap::COL_SAMACCOUNTNAME, $samaccountname, $comparison);
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByusername('fooValue');   // WHERE username = 'fooValue'
     * $query->filterByusername('%fooValue%', Criteria::LIKE); // WHERE username LIKE '%fooValue%'
     * </code>
     *
     * @param     string $username The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFuncionariosQuery The current query, for fluid interface
     */
    public function filterByusername($username = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FuncionariosTableMap::COL_USERNAME, $username, $comparison);
    }

    /**
     * Filter the query on the userprincipalname column
     *
     * Example usage:
     * <code>
     * $query->filterByuserprincipalname('fooValue');   // WHERE userprincipalname = 'fooValue'
     * $query->filterByuserprincipalname('%fooValue%', Criteria::LIKE); // WHERE userprincipalname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userprincipalname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFuncionariosQuery The current query, for fluid interface
     */
    public function filterByuserprincipalname($userprincipalname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userprincipalname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FuncionariosTableMap::COL_USERPRINCIPALNAME, $userprincipalname, $comparison);
    }

    /**
     * Filter the query on the dn column
     *
     * Example usage:
     * <code>
     * $query->filterBydn('fooValue');   // WHERE dn = 'fooValue'
     * $query->filterBydn('%fooValue%', Criteria::LIKE); // WHERE dn LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dn The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFuncionariosQuery The current query, for fluid interface
     */
    public function filterBydn($dn = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dn)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FuncionariosTableMap::COL_DN, $dn, $comparison);
    }

    /**
     * Filter the query by a related \Marcacoes object
     *
     * @param \Marcacoes|ObjectCollection $marcacoes the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFuncionariosQuery The current query, for fluid interface
     */
    public function filterByMarcacoes($marcacoes, $comparison = null)
    {
        if ($marcacoes instanceof \Marcacoes) {
            return $this
                ->addUsingAlias(FuncionariosTableMap::COL_PIS, $marcacoes->getPis(), $comparison);
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
     * @return $this|ChildFuncionariosQuery The current query, for fluid interface
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
     * @param   ChildFuncionarios $funcionarios Object to remove from the list of results
     *
     * @return $this|ChildFuncionariosQuery The current query, for fluid interface
     */
    public function prune($funcionarios = null)
    {
        if ($funcionarios) {
            $this->addUsingAlias(FuncionariosTableMap::COL_ID, $funcionarios->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the funcionarios table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FuncionariosTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FuncionariosTableMap::clearInstancePool();
            FuncionariosTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FuncionariosTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FuncionariosTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FuncionariosTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FuncionariosTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FuncionariosQuery
