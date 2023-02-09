<?php
class DB {

	protected $connect;

    public function __construct(array $config) 
	{
		$this->connect = new mysqli($config['host'], $config['username'], $config['password'], $config['name']);
		if ($this->connect == false) exit('Koneksi database gagal: '.$this->connect->connect_error);
	}

	public function list_fields(string $table): array|bool
	{
		$query = $this->connect->query("SHOW COLUMNS FROM $table");
		if ($this->connect->error) return false;
		else 
			if ($query->num_rows == 1) $rows = $query->fetch_assoc();
			else
				$rows = []; 
				while ($row = $query->fetch_assoc()):
					$rows[] = array_change_key_case($row, CASE_LOWER);
				endwhile;
			return $rows;
	}

	public function query(array $data): array|bool 
	{	
		$build_query = null; // set null
		if (isset($data['select'])) {
			$build_query .= 'SELECT ' . $data['select'];
		}
		if (isset($data['table'])) {
			$build_query .= ' FROM ' . $data['table'];
		}
		if (isset($data['join']) AND $data['join']) {
			$build_query .= ' ' . $data['join'];
		}
		if (isset($data['where']) AND !is_null($data['where'])) {
			$build_query .= ' WHERE ' . $data['where'];
		}
		if (isset($data['order_by'])) {
			$build_query .= ' ORDER BY ' . $data['order_by'];
		} else {
			$build_query .= ' ORDER BY ' . $data['table'] . '.id';
		}
		if (isset($data['limit'])) {
			$build_query .= ' LIMIT ' . $data['limit'];
		}
		if (isset($data['first']) AND $data['first'] == true) {
			$build_query .= ' LIMIT 1';
		}

		$query = $this->connect->query($build_query);

		if ($this->connect->error) return false;
		else 
			if ($query->num_rows == 1 AND (isset($data['first']) AND $data['first'] == true)) $rows = $query->fetch_assoc();
			else
				$rows = []; 
				while ($row = $query->fetch_assoc()):
					$rows[] = $row;
				endwhile;
			$result = [
				'rows' => $rows,
				'count' => $query->num_rows
			];
			return $result;
	}

	public function insert(string $table, array $data):array|bool
	{
		if (!is_array($data)) {
			return false;
		} else {
			$this->connect->query("INSERT INTO $table (".implode(', ', array_keys($data)).") VALUES ('".implode('\', \'', $data)."')");
			if ($this->connect->error) {
				return false;
			} else {
				return array_merge([
					'id' => $this->connect->insert_id
				], $data);
			}
		}
	}
	
	public function update(string $table, array $data, string $where):bool
	{
		if (!is_array($data)) {
			return false;
		} else {
			$update = "";
			$count = count($data);
			$i = 1;
			foreach ($data as $key => $value) {
				if ($i == $count) {
					$update .= $key." = '".$value."'";
				} else {
					$update .= $key." = '".$value."', ";
				}
				$i++;
			}
			$this->connect->query("UPDATE $table SET $update WHERE $where");
			return !$this->connect->error ? true : false;
		}
	}

	public function updateById(string $table, array $data, int $id):bool
	{
		if (!is_array($data)) {
			return false;
		} else {
			$update = "";
			$count = count($data);
			$i = 1;
			foreach ($data as $key => $value) {
				if ($i == $count) {
					$update .= $key." = '".$value."'";
				} else {
					$update .= $key." = '".$value."', ";
				}
				$i++;
			}
			$this->connect->query("UPDATE $table SET $update WHERE `id` = $id");
			return !$this->connect->error ? true : false;
		}
	}
	
	public function delete(string $table, $where): bool 
	{
		$query = $this->connect->query("DELETE FROM $table WHERE $where");
		return $query ? true : false;
	}

	public function deleteById(string $table, int $id): bool 
	{
		$query = $this->connect->query("DELETE FROM $table WHERE `id` = $id");
		return $query ? true : false;
	}

	public function escape(?string $i): mixed {
		return $this->connect->real_escape_string($i);
	}
}