<?php

namespace Base;

use \Funcionarios as ChildFuncionarios;
use \FuncionariosQuery as ChildFuncionariosQuery;
use \Marcacoes as ChildMarcacoes;
use \MarcacoesQuery as ChildMarcacoesQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\FuncionariosTableMap;
use Map\MarcacoesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'funcionarios' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Funcionarios implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\FuncionariosTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the nome field.
     *
     * @var        string
     */
    protected $nome;

    /**
     * The value for the matricula field.
     *
     * @var        string
     */
    protected $matricula;

    /**
     * The value for the pis field.
     *
     * @var        string
     */
    protected $pis;

    /**
     * The value for the createdat field.
     *
     * @var        DateTime
     */
    protected $createdat;

    /**
     * The value for the updatedat field.
     *
     * @var        DateTime
     */
    protected $updatedat;

    /**
     * The value for the samaccountname field.
     *
     * @var        string
     */
    protected $samaccountname;

    /**
     * The value for the username field.
     *
     * @var        string
     */
    protected $username;

    /**
     * The value for the userprincipalname field.
     *
     * @var        string
     */
    protected $userprincipalname;

    /**
     * The value for the dn field.
     *
     * @var        string
     */
    protected $dn;

    /**
     * @var        ObjectCollection|ChildMarcacoes[] Collection to store aggregation of ChildMarcacoes objects.
     */
    protected $collMarcacoess;
    protected $collMarcacoessPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildMarcacoes[]
     */
    protected $marcacoessScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Funcionarios object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Funcionarios</code> instance.  If
     * <code>obj</code> is an instance of <code>Funcionarios</code>, delegates to
     * <code>equals(Funcionarios)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Funcionarios The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [nome] column value.
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Get the [matricula] column value.
     *
     * @return string
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Get the [pis] column value.
     *
     * @return string
     */
    public function getPis()
    {
        return $this->pis;
    }

    /**
     * Get the [optionally formatted] temporal [createdat] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedat($format = NULL)
    {
        if ($format === null) {
            return $this->createdat;
        } else {
            return $this->createdat instanceof \DateTimeInterface ? $this->createdat->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updatedat] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedat($format = NULL)
    {
        if ($format === null) {
            return $this->updatedat;
        } else {
            return $this->updatedat instanceof \DateTimeInterface ? $this->updatedat->format($format) : null;
        }
    }

    /**
     * Get the [samaccountname] column value.
     *
     * @return string
     */
    public function getsamaccountname()
    {
        return $this->samaccountname;
    }

    /**
     * Get the [username] column value.
     *
     * @return string
     */
    public function getusername()
    {
        return $this->username;
    }

    /**
     * Get the [userprincipalname] column value.
     *
     * @return string
     */
    public function getuserprincipalname()
    {
        return $this->userprincipalname;
    }

    /**
     * Get the [dn] column value.
     *
     * @return string
     */
    public function getdn()
    {
        return $this->dn;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Funcionarios The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[FuncionariosTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [nome] column.
     *
     * @param string $v new value
     * @return $this|\Funcionarios The current object (for fluent API support)
     */
    public function setNome($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nome !== $v) {
            $this->nome = $v;
            $this->modifiedColumns[FuncionariosTableMap::COL_NOME] = true;
        }

        return $this;
    } // setNome()

    /**
     * Set the value of [matricula] column.
     *
     * @param string $v new value
     * @return $this|\Funcionarios The current object (for fluent API support)
     */
    public function setMatricula($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->matricula !== $v) {
            $this->matricula = $v;
            $this->modifiedColumns[FuncionariosTableMap::COL_MATRICULA] = true;
        }

        return $this;
    } // setMatricula()

    /**
     * Set the value of [pis] column.
     *
     * @param string $v new value
     * @return $this|\Funcionarios The current object (for fluent API support)
     */
    public function setPis($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pis !== $v) {
            $this->pis = $v;
            $this->modifiedColumns[FuncionariosTableMap::COL_PIS] = true;
        }

        return $this;
    } // setPis()

    /**
     * Sets the value of [createdat] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Funcionarios The current object (for fluent API support)
     */
    public function setCreatedat($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->createdat !== null || $dt !== null) {
            if ($this->createdat === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->createdat->format("Y-m-d H:i:s.u")) {
                $this->createdat = $dt === null ? null : clone $dt;
                $this->modifiedColumns[FuncionariosTableMap::COL_CREATEDAT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedat()

    /**
     * Sets the value of [updatedat] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Funcionarios The current object (for fluent API support)
     */
    public function setUpdatedat($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updatedat !== null || $dt !== null) {
            if ($this->updatedat === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updatedat->format("Y-m-d H:i:s.u")) {
                $this->updatedat = $dt === null ? null : clone $dt;
                $this->modifiedColumns[FuncionariosTableMap::COL_UPDATEDAT] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdatedat()

    /**
     * Set the value of [samaccountname] column.
     *
     * @param string $v new value
     * @return $this|\Funcionarios The current object (for fluent API support)
     */
    public function setsamaccountname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->samaccountname !== $v) {
            $this->samaccountname = $v;
            $this->modifiedColumns[FuncionariosTableMap::COL_SAMACCOUNTNAME] = true;
        }

        return $this;
    } // setsamaccountname()

    /**
     * Set the value of [username] column.
     *
     * @param string $v new value
     * @return $this|\Funcionarios The current object (for fluent API support)
     */
    public function setusername($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->username !== $v) {
            $this->username = $v;
            $this->modifiedColumns[FuncionariosTableMap::COL_USERNAME] = true;
        }

        return $this;
    } // setusername()

    /**
     * Set the value of [userprincipalname] column.
     *
     * @param string $v new value
     * @return $this|\Funcionarios The current object (for fluent API support)
     */
    public function setuserprincipalname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->userprincipalname !== $v) {
            $this->userprincipalname = $v;
            $this->modifiedColumns[FuncionariosTableMap::COL_USERPRINCIPALNAME] = true;
        }

        return $this;
    } // setuserprincipalname()

    /**
     * Set the value of [dn] column.
     *
     * @param string $v new value
     * @return $this|\Funcionarios The current object (for fluent API support)
     */
    public function setdn($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dn !== $v) {
            $this->dn = $v;
            $this->modifiedColumns[FuncionariosTableMap::COL_DN] = true;
        }

        return $this;
    } // setdn()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : FuncionariosTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : FuncionariosTableMap::translateFieldName('Nome', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nome = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : FuncionariosTableMap::translateFieldName('Matricula', TableMap::TYPE_PHPNAME, $indexType)];
            $this->matricula = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : FuncionariosTableMap::translateFieldName('Pis', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pis = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : FuncionariosTableMap::translateFieldName('Createdat', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->createdat = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : FuncionariosTableMap::translateFieldName('Updatedat', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updatedat = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : FuncionariosTableMap::translateFieldName('samaccountname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->samaccountname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : FuncionariosTableMap::translateFieldName('username', TableMap::TYPE_PHPNAME, $indexType)];
            $this->username = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : FuncionariosTableMap::translateFieldName('userprincipalname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->userprincipalname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : FuncionariosTableMap::translateFieldName('dn', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dn = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = FuncionariosTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Funcionarios'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FuncionariosTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildFuncionariosQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collMarcacoess = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Funcionarios::setDeleted()
     * @see Funcionarios::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(FuncionariosTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildFuncionariosQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(FuncionariosTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                FuncionariosTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->marcacoessScheduledForDeletion !== null) {
                if (!$this->marcacoessScheduledForDeletion->isEmpty()) {
                    foreach ($this->marcacoessScheduledForDeletion as $marcacoes) {
                        // need to save related object because we set the relation to null
                        $marcacoes->save($con);
                    }
                    $this->marcacoessScheduledForDeletion = null;
                }
            }

            if ($this->collMarcacoess !== null) {
                foreach ($this->collMarcacoess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[FuncionariosTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . FuncionariosTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(FuncionariosTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(FuncionariosTableMap::COL_NOME)) {
            $modifiedColumns[':p' . $index++]  = 'nome';
        }
        if ($this->isColumnModified(FuncionariosTableMap::COL_MATRICULA)) {
            $modifiedColumns[':p' . $index++]  = 'matricula';
        }
        if ($this->isColumnModified(FuncionariosTableMap::COL_PIS)) {
            $modifiedColumns[':p' . $index++]  = 'pis';
        }
        if ($this->isColumnModified(FuncionariosTableMap::COL_CREATEDAT)) {
            $modifiedColumns[':p' . $index++]  = 'createdAt';
        }
        if ($this->isColumnModified(FuncionariosTableMap::COL_UPDATEDAT)) {
            $modifiedColumns[':p' . $index++]  = 'updatedAt';
        }
        if ($this->isColumnModified(FuncionariosTableMap::COL_SAMACCOUNTNAME)) {
            $modifiedColumns[':p' . $index++]  = 'samaccountname';
        }
        if ($this->isColumnModified(FuncionariosTableMap::COL_USERNAME)) {
            $modifiedColumns[':p' . $index++]  = 'username';
        }
        if ($this->isColumnModified(FuncionariosTableMap::COL_USERPRINCIPALNAME)) {
            $modifiedColumns[':p' . $index++]  = 'userprincipalname';
        }
        if ($this->isColumnModified(FuncionariosTableMap::COL_DN)) {
            $modifiedColumns[':p' . $index++]  = 'dn';
        }

        $sql = sprintf(
            'INSERT INTO funcionarios (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'nome':
                        $stmt->bindValue($identifier, $this->nome, PDO::PARAM_STR);
                        break;
                    case 'matricula':
                        $stmt->bindValue($identifier, $this->matricula, PDO::PARAM_STR);
                        break;
                    case 'pis':
                        $stmt->bindValue($identifier, $this->pis, PDO::PARAM_STR);
                        break;
                    case 'createdAt':
                        $stmt->bindValue($identifier, $this->createdat ? $this->createdat->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'updatedAt':
                        $stmt->bindValue($identifier, $this->updatedat ? $this->updatedat->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'samaccountname':
                        $stmt->bindValue($identifier, $this->samaccountname, PDO::PARAM_STR);
                        break;
                    case 'username':
                        $stmt->bindValue($identifier, $this->username, PDO::PARAM_STR);
                        break;
                    case 'userprincipalname':
                        $stmt->bindValue($identifier, $this->userprincipalname, PDO::PARAM_STR);
                        break;
                    case 'dn':
                        $stmt->bindValue($identifier, $this->dn, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = FuncionariosTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getNome();
                break;
            case 2:
                return $this->getMatricula();
                break;
            case 3:
                return $this->getPis();
                break;
            case 4:
                return $this->getCreatedat();
                break;
            case 5:
                return $this->getUpdatedat();
                break;
            case 6:
                return $this->getsamaccountname();
                break;
            case 7:
                return $this->getusername();
                break;
            case 8:
                return $this->getuserprincipalname();
                break;
            case 9:
                return $this->getdn();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Funcionarios'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Funcionarios'][$this->hashCode()] = true;
        $keys = FuncionariosTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getNome(),
            $keys[2] => $this->getMatricula(),
            $keys[3] => $this->getPis(),
            $keys[4] => $this->getCreatedat(),
            $keys[5] => $this->getUpdatedat(),
            $keys[6] => $this->getsamaccountname(),
            $keys[7] => $this->getusername(),
            $keys[8] => $this->getuserprincipalname(),
            $keys[9] => $this->getdn(),
        );
        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('c');
        }

        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collMarcacoess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'marcacoess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'marcacoess';
                        break;
                    default:
                        $key = 'Marcacoess';
                }

                $result[$key] = $this->collMarcacoess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Funcionarios
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = FuncionariosTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Funcionarios
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setNome($value);
                break;
            case 2:
                $this->setMatricula($value);
                break;
            case 3:
                $this->setPis($value);
                break;
            case 4:
                $this->setCreatedat($value);
                break;
            case 5:
                $this->setUpdatedat($value);
                break;
            case 6:
                $this->setsamaccountname($value);
                break;
            case 7:
                $this->setusername($value);
                break;
            case 8:
                $this->setuserprincipalname($value);
                break;
            case 9:
                $this->setdn($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = FuncionariosTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setNome($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setMatricula($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPis($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCreatedat($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setUpdatedat($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setsamaccountname($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setusername($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setuserprincipalname($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setdn($arr[$keys[9]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Funcionarios The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(FuncionariosTableMap::DATABASE_NAME);

        if ($this->isColumnModified(FuncionariosTableMap::COL_ID)) {
            $criteria->add(FuncionariosTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(FuncionariosTableMap::COL_NOME)) {
            $criteria->add(FuncionariosTableMap::COL_NOME, $this->nome);
        }
        if ($this->isColumnModified(FuncionariosTableMap::COL_MATRICULA)) {
            $criteria->add(FuncionariosTableMap::COL_MATRICULA, $this->matricula);
        }
        if ($this->isColumnModified(FuncionariosTableMap::COL_PIS)) {
            $criteria->add(FuncionariosTableMap::COL_PIS, $this->pis);
        }
        if ($this->isColumnModified(FuncionariosTableMap::COL_CREATEDAT)) {
            $criteria->add(FuncionariosTableMap::COL_CREATEDAT, $this->createdat);
        }
        if ($this->isColumnModified(FuncionariosTableMap::COL_UPDATEDAT)) {
            $criteria->add(FuncionariosTableMap::COL_UPDATEDAT, $this->updatedat);
        }
        if ($this->isColumnModified(FuncionariosTableMap::COL_SAMACCOUNTNAME)) {
            $criteria->add(FuncionariosTableMap::COL_SAMACCOUNTNAME, $this->samaccountname);
        }
        if ($this->isColumnModified(FuncionariosTableMap::COL_USERNAME)) {
            $criteria->add(FuncionariosTableMap::COL_USERNAME, $this->username);
        }
        if ($this->isColumnModified(FuncionariosTableMap::COL_USERPRINCIPALNAME)) {
            $criteria->add(FuncionariosTableMap::COL_USERPRINCIPALNAME, $this->userprincipalname);
        }
        if ($this->isColumnModified(FuncionariosTableMap::COL_DN)) {
            $criteria->add(FuncionariosTableMap::COL_DN, $this->dn);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildFuncionariosQuery::create();
        $criteria->add(FuncionariosTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Funcionarios (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNome($this->getNome());
        $copyObj->setMatricula($this->getMatricula());
        $copyObj->setPis($this->getPis());
        $copyObj->setCreatedat($this->getCreatedat());
        $copyObj->setUpdatedat($this->getUpdatedat());
        $copyObj->setsamaccountname($this->getsamaccountname());
        $copyObj->setusername($this->getusername());
        $copyObj->setuserprincipalname($this->getuserprincipalname());
        $copyObj->setdn($this->getdn());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getMarcacoess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMarcacoes($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Funcionarios Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Marcacoes' == $relationName) {
            $this->initMarcacoess();
            return;
        }
    }

    /**
     * Clears out the collMarcacoess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addMarcacoess()
     */
    public function clearMarcacoess()
    {
        $this->collMarcacoess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collMarcacoess collection loaded partially.
     */
    public function resetPartialMarcacoess($v = true)
    {
        $this->collMarcacoessPartial = $v;
    }

    /**
     * Initializes the collMarcacoess collection.
     *
     * By default this just sets the collMarcacoess collection to an empty array (like clearcollMarcacoess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMarcacoess($overrideExisting = true)
    {
        if (null !== $this->collMarcacoess && !$overrideExisting) {
            return;
        }

        $collectionClassName = MarcacoesTableMap::getTableMap()->getCollectionClassName();

        $this->collMarcacoess = new $collectionClassName;
        $this->collMarcacoess->setModel('\Marcacoes');
    }

    /**
     * Gets an array of ChildMarcacoes objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildFuncionarios is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildMarcacoes[] List of ChildMarcacoes objects
     * @throws PropelException
     */
    public function getMarcacoess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collMarcacoessPartial && !$this->isNew();
        if (null === $this->collMarcacoess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collMarcacoess) {
                // return empty collection
                $this->initMarcacoess();
            } else {
                $collMarcacoess = ChildMarcacoesQuery::create(null, $criteria)
                    ->filterByFuncionarios($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMarcacoessPartial && count($collMarcacoess)) {
                        $this->initMarcacoess(false);

                        foreach ($collMarcacoess as $obj) {
                            if (false == $this->collMarcacoess->contains($obj)) {
                                $this->collMarcacoess->append($obj);
                            }
                        }

                        $this->collMarcacoessPartial = true;
                    }

                    return $collMarcacoess;
                }

                if ($partial && $this->collMarcacoess) {
                    foreach ($this->collMarcacoess as $obj) {
                        if ($obj->isNew()) {
                            $collMarcacoess[] = $obj;
                        }
                    }
                }

                $this->collMarcacoess = $collMarcacoess;
                $this->collMarcacoessPartial = false;
            }
        }

        return $this->collMarcacoess;
    }

    /**
     * Sets a collection of ChildMarcacoes objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $marcacoess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildFuncionarios The current object (for fluent API support)
     */
    public function setMarcacoess(Collection $marcacoess, ConnectionInterface $con = null)
    {
        /** @var ChildMarcacoes[] $marcacoessToDelete */
        $marcacoessToDelete = $this->getMarcacoess(new Criteria(), $con)->diff($marcacoess);


        $this->marcacoessScheduledForDeletion = $marcacoessToDelete;

        foreach ($marcacoessToDelete as $marcacoesRemoved) {
            $marcacoesRemoved->setFuncionarios(null);
        }

        $this->collMarcacoess = null;
        foreach ($marcacoess as $marcacoes) {
            $this->addMarcacoes($marcacoes);
        }

        $this->collMarcacoess = $marcacoess;
        $this->collMarcacoessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Marcacoes objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Marcacoes objects.
     * @throws PropelException
     */
    public function countMarcacoess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collMarcacoessPartial && !$this->isNew();
        if (null === $this->collMarcacoess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMarcacoess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMarcacoess());
            }

            $query = ChildMarcacoesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByFuncionarios($this)
                ->count($con);
        }

        return count($this->collMarcacoess);
    }

    /**
     * Method called to associate a ChildMarcacoes object to this object
     * through the ChildMarcacoes foreign key attribute.
     *
     * @param  ChildMarcacoes $l ChildMarcacoes
     * @return $this|\Funcionarios The current object (for fluent API support)
     */
    public function addMarcacoes(ChildMarcacoes $l)
    {
        if ($this->collMarcacoess === null) {
            $this->initMarcacoess();
            $this->collMarcacoessPartial = true;
        }

        if (!$this->collMarcacoess->contains($l)) {
            $this->doAddMarcacoes($l);

            if ($this->marcacoessScheduledForDeletion and $this->marcacoessScheduledForDeletion->contains($l)) {
                $this->marcacoessScheduledForDeletion->remove($this->marcacoessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildMarcacoes $marcacoes The ChildMarcacoes object to add.
     */
    protected function doAddMarcacoes(ChildMarcacoes $marcacoes)
    {
        $this->collMarcacoess[]= $marcacoes;
        $marcacoes->setFuncionarios($this);
    }

    /**
     * @param  ChildMarcacoes $marcacoes The ChildMarcacoes object to remove.
     * @return $this|ChildFuncionarios The current object (for fluent API support)
     */
    public function removeMarcacoes(ChildMarcacoes $marcacoes)
    {
        if ($this->getMarcacoess()->contains($marcacoes)) {
            $pos = $this->collMarcacoess->search($marcacoes);
            $this->collMarcacoess->remove($pos);
            if (null === $this->marcacoessScheduledForDeletion) {
                $this->marcacoessScheduledForDeletion = clone $this->collMarcacoess;
                $this->marcacoessScheduledForDeletion->clear();
            }
            $this->marcacoessScheduledForDeletion[]= $marcacoes;
            $marcacoes->setFuncionarios(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Funcionarios is new, it will return
     * an empty collection; or if this Funcionarios has previously
     * been saved, it will retrieve related Marcacoess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Funcionarios.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildMarcacoes[] List of ChildMarcacoes objects
     */
    public function getMarcacoessJoinPontos(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildMarcacoesQuery::create(null, $criteria);
        $query->joinWith('Pontos', $joinBehavior);

        return $this->getMarcacoess($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->nome = null;
        $this->matricula = null;
        $this->pis = null;
        $this->createdat = null;
        $this->updatedat = null;
        $this->samaccountname = null;
        $this->username = null;
        $this->userprincipalname = null;
        $this->dn = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collMarcacoess) {
                foreach ($this->collMarcacoess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collMarcacoess = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(FuncionariosTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
