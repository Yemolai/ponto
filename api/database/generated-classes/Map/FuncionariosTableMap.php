<?php

namespace Map;

use \Funcionarios;
use \FuncionariosQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'funcionarios' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class FuncionariosTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.FuncionariosTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'ponto';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'funcionarios';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Funcionarios';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Funcionarios';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id field
     */
    const COL_ID = 'funcionarios.id';

    /**
     * the column name for the nome field
     */
    const COL_NOME = 'funcionarios.nome';

    /**
     * the column name for the matricula field
     */
    const COL_MATRICULA = 'funcionarios.matricula';

    /**
     * the column name for the pis field
     */
    const COL_PIS = 'funcionarios.pis';

    /**
     * the column name for the createdAt field
     */
    const COL_CREATEDAT = 'funcionarios.createdAt';

    /**
     * the column name for the updatedAt field
     */
    const COL_UPDATEDAT = 'funcionarios.updatedAt';

    /**
     * the column name for the samaccountname field
     */
    const COL_SAMACCOUNTNAME = 'funcionarios.samaccountname';

    /**
     * the column name for the username field
     */
    const COL_USERNAME = 'funcionarios.username';

    /**
     * the column name for the userprincipalname field
     */
    const COL_USERPRINCIPALNAME = 'funcionarios.userprincipalname';

    /**
     * the column name for the dn field
     */
    const COL_DN = 'funcionarios.dn';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Nome', 'Matricula', 'Pis', 'Createdat', 'Updatedat', 'samaccountname', 'username', 'userprincipalname', 'dn', ),
        self::TYPE_CAMELNAME     => array('id', 'nome', 'matricula', 'pis', 'createdat', 'updatedat', 'samaccountname', 'username', 'userprincipalname', 'dn', ),
        self::TYPE_COLNAME       => array(FuncionariosTableMap::COL_ID, FuncionariosTableMap::COL_NOME, FuncionariosTableMap::COL_MATRICULA, FuncionariosTableMap::COL_PIS, FuncionariosTableMap::COL_CREATEDAT, FuncionariosTableMap::COL_UPDATEDAT, FuncionariosTableMap::COL_SAMACCOUNTNAME, FuncionariosTableMap::COL_USERNAME, FuncionariosTableMap::COL_USERPRINCIPALNAME, FuncionariosTableMap::COL_DN, ),
        self::TYPE_FIELDNAME     => array('id', 'nome', 'matricula', 'pis', 'createdAt', 'updatedAt', 'samaccountname', 'username', 'userprincipalname', 'dn', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Nome' => 1, 'Matricula' => 2, 'Pis' => 3, 'Createdat' => 4, 'Updatedat' => 5, 'samaccountname' => 6, 'username' => 7, 'userprincipalname' => 8, 'dn' => 9, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'nome' => 1, 'matricula' => 2, 'pis' => 3, 'createdat' => 4, 'updatedat' => 5, 'samaccountname' => 6, 'username' => 7, 'userprincipalname' => 8, 'dn' => 9, ),
        self::TYPE_COLNAME       => array(FuncionariosTableMap::COL_ID => 0, FuncionariosTableMap::COL_NOME => 1, FuncionariosTableMap::COL_MATRICULA => 2, FuncionariosTableMap::COL_PIS => 3, FuncionariosTableMap::COL_CREATEDAT => 4, FuncionariosTableMap::COL_UPDATEDAT => 5, FuncionariosTableMap::COL_SAMACCOUNTNAME => 6, FuncionariosTableMap::COL_USERNAME => 7, FuncionariosTableMap::COL_USERPRINCIPALNAME => 8, FuncionariosTableMap::COL_DN => 9, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'nome' => 1, 'matricula' => 2, 'pis' => 3, 'createdAt' => 4, 'updatedAt' => 5, 'samaccountname' => 6, 'username' => 7, 'userprincipalname' => 8, 'dn' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('funcionarios');
        $this->setPhpName('Funcionarios');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Funcionarios');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('nome', 'Nome', 'VARCHAR', false, 255, null);
        $this->addColumn('matricula', 'Matricula', 'DECIMAL', false, 11, null);
        $this->addColumn('pis', 'Pis', 'DECIMAL', true, 11, null);
        $this->addColumn('createdAt', 'Createdat', 'TIMESTAMP', true, null, null);
        $this->addColumn('updatedAt', 'Updatedat', 'TIMESTAMP', true, null, null);
        $this->addColumn('samaccountname', 'samaccountname', 'VARCHAR', false, 255, null);
        $this->addColumn('username', 'username', 'VARCHAR', false, 255, null);
        $this->addColumn('userprincipalname', 'userprincipalname', 'VARCHAR', false, 255, null);
        $this->addColumn('dn', 'dn', 'VARCHAR', false, 255, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Marcacoes', '\\Marcacoes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':pis',
    1 => ':pis',
  ),
), null, null, 'Marcacoess', false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? FuncionariosTableMap::CLASS_DEFAULT : FuncionariosTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Funcionarios object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = FuncionariosTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FuncionariosTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FuncionariosTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FuncionariosTableMap::OM_CLASS;
            /** @var Funcionarios $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FuncionariosTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = FuncionariosTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FuncionariosTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Funcionarios $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FuncionariosTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(FuncionariosTableMap::COL_ID);
            $criteria->addSelectColumn(FuncionariosTableMap::COL_NOME);
            $criteria->addSelectColumn(FuncionariosTableMap::COL_MATRICULA);
            $criteria->addSelectColumn(FuncionariosTableMap::COL_PIS);
            $criteria->addSelectColumn(FuncionariosTableMap::COL_CREATEDAT);
            $criteria->addSelectColumn(FuncionariosTableMap::COL_UPDATEDAT);
            $criteria->addSelectColumn(FuncionariosTableMap::COL_SAMACCOUNTNAME);
            $criteria->addSelectColumn(FuncionariosTableMap::COL_USERNAME);
            $criteria->addSelectColumn(FuncionariosTableMap::COL_USERPRINCIPALNAME);
            $criteria->addSelectColumn(FuncionariosTableMap::COL_DN);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.nome');
            $criteria->addSelectColumn($alias . '.matricula');
            $criteria->addSelectColumn($alias . '.pis');
            $criteria->addSelectColumn($alias . '.createdAt');
            $criteria->addSelectColumn($alias . '.updatedAt');
            $criteria->addSelectColumn($alias . '.samaccountname');
            $criteria->addSelectColumn($alias . '.username');
            $criteria->addSelectColumn($alias . '.userprincipalname');
            $criteria->addSelectColumn($alias . '.dn');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(FuncionariosTableMap::DATABASE_NAME)->getTable(FuncionariosTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(FuncionariosTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(FuncionariosTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new FuncionariosTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Funcionarios or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Funcionarios object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FuncionariosTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Funcionarios) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FuncionariosTableMap::DATABASE_NAME);
            $criteria->add(FuncionariosTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = FuncionariosQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FuncionariosTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FuncionariosTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the funcionarios table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return FuncionariosQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Funcionarios or Criteria object.
     *
     * @param mixed               $criteria Criteria or Funcionarios object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FuncionariosTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Funcionarios object
        }

        if ($criteria->containsKey(FuncionariosTableMap::COL_ID) && $criteria->keyContainsValue(FuncionariosTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FuncionariosTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = FuncionariosQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // FuncionariosTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
FuncionariosTableMap::buildTableMap();
