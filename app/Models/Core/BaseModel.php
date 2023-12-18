<?php

namespace App\Models\Core;

use Config\Database;

class BaseModel
{
    protected $connect;

    private $fields, $aliases, $duplicate, $table, $joins;
    private $select, $fieldselect, $tablefrom;
    private $where, $wherealias, $limit, $offset;
    private $order, $orderalias;
    private $group, $groupalias;

    public function __construct()
    {
        $this->connect = Database::connect();
        $this->_refresh();
    }

    public function select(array $fields)
    {
        if ($this->table === null) return $this;
        if (!empty($fields)) $this->select = array_unique(array_merge($this->select, $fields));
        $queryselect = '*';
        if (!empty($this->fields[$this->table]))
            $queryselect = implode(', ', array_values($this->fields[$this->table]));
        $queryfrom = $this->table;
        if (!empty($this->select)) {
            $tablefields = $this->fields[$this->table];
            $requires = array();
            foreach ($this->joins as $table => $value) {
                $intersect = array();
                if (array_key_exists($table, $this->fields)) {
                    $intersect = array_intersect(array_keys($this->fields[$table]), $this->select);
                }
                if (!empty($intersect)) {
                    $tablefields = array_merge($tablefields, $this->fields[$table]);
                    if (!in_array($value['require'], $requires) && $value['require'] != $this->table) {
                        array_push($requires, $value['require']);
                    }
                    array_push($requires, $table);
                }
            }
            foreach ($requires as $req) {
                if ($queryfrom == $this->table) $queryfrom = '`' . $queryfrom . '`';
                $queryfrom = str_replace(':table:', $queryfrom, $this->joins[$req]['table']);
            }
            $selected = array();
            foreach ($tablefields as $key => $val) if (in_array($key, $this->select)) $selected[] = $val;
            if (!empty($selected)) $queryselect = implode(', ', $selected);
        }
        $this->_refresh(false, 'select');
        $this->fieldselect = $queryselect;
        $this->tablefrom = $queryfrom;
        return $this;
    }

    /**
     * Set Where
     * @param string|array $where
     */
    public function where($where)
    {
        if (is_string($where)) {
            $this->where[] = array(
                'tipe' => 'string',
                'value' => $where
            );
        }
        if (is_array($where)) {
            foreach ($where as $key => $val) {
                $field = array_key_exists($key, $this->wherealias) ? $this->wherealias[$key] : $key;
                $whereis = array('tipe' => null, 'field' => $field, 'value' => $val);
                if (is_array($val)) $whereis['tipe'] = 'in';
                if (is_integer($val)) $whereis['tipe'] = 'where';
                if (is_string($val)) {
                    $whereis['tipe'] = 'where';
                    if (substr($val, 0, 1) == '%' || substr($val, -1) == '%') {
                        $whereis['tipe'] = 'like';
                        $perbefore = substr($val, 0, 1) == '%';
                        $persafter = substr($val, -1) == '%';
                        if ($perbefore && $persafter) {
                            $whereis['side'] = 'both';
                        } elseif ($perbefore) {
                            $whereis['side'] = 'before';
                        } elseif ($persafter) {
                            $whereis['side'] = 'after';
                        } else {
                            $whereis['side'] = 'both';
                        }
                        $whereis['value'] = trim($val, '%');
                    }
                    if ($val == '!null') {
                        $whereis['tipe'] = null;
                        $this->where[] = array(
                            'tipe' => 'string',
                            'value' => $field . ' IS NOT NULL'
                        );
                    }
                }
                if ($whereis['tipe'] !== null) $this->where[] = $whereis;
                if ($val === null) {
                    $this->where[] = array(
                        'tipe' => 'string',
                        'value' => $field . ' IS NULL'
                    );
                }
            }
        }
        return $this;
    }

    /**
     * Set Order
     * @param string|array $order query order or alias
     */
    public function order($order)
    {
        if (is_string($order)) $this->_setorder($order);
        if (is_array($order)) foreach ($order as $od)
            if (is_string($od)) $this->_setorder($od);
        return $this;
    }

    private function _setorder(string $order)
    {
        $query = $order;
        if (array_key_exists($order, $this->orderalias))
            $query = $this->orderalias[$order];
        if (substr(strtolower($query), -4) == ' asc') {
            $this->order[] = array(
                'field' => trim(substr($query, 0, strlen($query) - 4)),
                'direct' => 'ASC'
            );
        }
        if (substr(strtolower($query), -5) == ' desc') {
            $this->order[] = array(
                'field' => trim(substr($query, 0, strlen($query) - 5)),
                'direct' => 'DESC'
            );
        }
    }

    /**
     * Set Group By
     * @param string|array $group query group by or alias
     */
    public function group($group)
    {
        if (is_string($group)) $this->_setgroup($group);
        if (is_array($group)) foreach ($group as $gr)
            if (is_string($gr)) $this->_setgroup($gr);
        return $this;
    }

    private function _setgroup($group)
    {
        if (array_key_exists($group, $this->groupalias)) {
            $this->group[] = $this->groupalias[$group];
        } else {
            $this->group[] = $group;
        }
    }

    public function limit(int $limit, int $offset = 0)
    {
        if ($limit > 0) {
            $this->limit = $limit;
            if ($offset >= 0) $this->offset = $offset;
        }
        return $this;
    }

    public function data(bool $alwayslist = true)
    {
        $build = $this->_build();
        $build->select($this->fieldselect);
        $result = $build->get()->getResultArray();
        if ($alwayslist) {
            return $result;
        } else {
            $size = sizeof($result);
            if ($size === 0) return null;
            if ($size === 1) return $result[0];
            return $result;
        }
    }

    public function count(): int
    {
        $build = $this->_build();
        if ($build === null) return 0;
        return intval($build->countAllResults());
    }

    /**
     * Set Fields
     * @param string $table table name
     * @param array $fields alias => colname
     * @return int check duplicate alias
     */
    protected function fields(string $table, array $fields)
    {
        if ($this->table === null) $this->table = $table;
        $datafields = array();
        $duplicate = 0;
        foreach ($fields as $alias => $name) {
            if (!in_array($alias, $this->aliases)) {
                array_push($this->aliases, $alias);
                $datafields[$alias] = $table . '.' . $name . ' AS ' . $alias;
            } else {
                $duplicate++;
                $this->duplicate++;
            }
        }
        $this->fields[$table] = $datafields;
        return $duplicate;
    }

    /**
     * Table Join
     * @param string $joiner table.colname=table.colname
     * @param string $key inner / left / right - or tablename
     * @return bool join created
     */
    protected function join(string $joiner, string $key = 'inner', bool $raw = false)
    {
        $jointipe = array(
            'inner' => 'INNER JOIN',
            'left' => 'LEFT OUTER JOIN',
            'right' => 'RIGHT OUTER JOIN'
        );
        $pattern = '/^[a-zA-Z_]+\.[a-zA-Z_]+=[a-zA-Z_]+\.[a-zA-Z_]+$/';
        if (!preg_match($pattern, $joiner) && !$raw) return false;
        if ($raw) {
            $this->joins[$key] = array(
                'require' => null,
                'table' => '(:table: ' . $joiner . ')'
            );
        } else {
            $joinkey = !array_key_exists(strtolower($key), $jointipe) ? 'inner' : strtolower($key);
            $joiners = explode('=', $joiner);
            $parts = array(explode('.', $joiners[0]), explode('.', $joiners[1]));
            $this->joins[$parts[1][0]] = array(
                'require' => $parts[0][0],
                'table' => '(:table: ' . $jointipe[$joinkey] . ' `' . $parts[1][0] . '` ON `' . implode('`.`', $parts[0]) . '` = `' . implode('`.`', $parts[1]) . '`)'
            );
        }
        return true;
    }

    /**
     * Set Aliases
     * @param string $for where / order / group
     * @param array $alias alias => fieldname
     */
    protected function alias(string $for, array $alias = [])
    {
        if ($for == 'where') {
            foreach ($alias as $kw => $vw) $this->wherealias[$kw] = $vw;
        }
        if ($for == 'order') {
            foreach ($alias as $ko => $vo) $this->orderalias[$ko] = $vo;
        }
        if ($for == 'group') {
            foreach ($alias as $kg => $vg) $this->groupalias[$kg] = $vg;
        }
    }

    protected function query(string $query)
    {
        return $this->connect->query($query);
    }

    private function _build()
    {
        if ($this->tablefrom === null) return null;
        $build = $this->connect->table($this->tablefrom)->limit($this->limit, $this->offset);
        foreach ($this->where as $where) {
            if ($where['tipe'] == 'where') $build->where($where['field'], $where['value']);
            if ($where['tipe'] == 'string') $build->where($where['value']);
            if ($where['tipe'] == 'like') $build->like($where['field'], $where['value'], $where['side']);
            if ($where['tipe'] == 'in') $build->whereIn($where['field'], $where['value']);
        }
        foreach ($this->order as $order) $build->orderBy($order['field'], $order['direct']);
        foreach ($this->group as $group) $build->groupBy($group);
        return $build;
    }

    private function _refresh(bool $all = true, ?string $bundle = null)
    {
        if ($all || $bundle == 'select') {
            $this->fields = array();
            $this->aliases = array();
            $this->joins = array();
            $this->table = null;
            $this->duplicate = 0;
        }
        if ($all || $bundle == 'query') {
            $this->select = array();
            $this->fieldselect = null;
            $this->tablefrom = null;
            $this->where = array();
            $this->order = array();
            $this->group = array();
            $this->limit = null;
            $this->offset = 0;
        }
        if ($all || $bundle == 'where') {
            $this->wherealias = array();
        }
        if ($all || $bundle == 'order') {
            $this->orderalias = array();
        }
        if ($all || $bundle == 'group') {
            $this->groupalias = array();
        }
    }
}
