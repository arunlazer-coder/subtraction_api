<?php
namespace App\Component;

use Illuminate\Database\Migrations\Migration as Base;

class DatabaseMigration extends Base
{
	public function createForeignKeyDeleteCascade($table, $fieldKey, $tableName, $tableRefName)
	{
		$table->foreign($fieldKey.'_id', $this->getForeignKeyName($tableName, $fieldKey))->references('id')->on($tableRefName)->onDelete('CASCADE');
	}

	public function createForeignKeyDeleteNull($table, $fieldKey, $tableName, $tableRefName)
	{
		$table->foreign($fieldKey.'_id', $this->getForeignKeyName($tableName, $fieldKey))->references('id')->on($tableRefName)->onDelete('SET NULL');
	}

	public function getForeignKeyName($tbl, $field) {
		return 'fk_'.str_replace(DB_TBL_PREFIX, '', $tbl).'_'.$field;
	}
	
	public function getTriggerName($tbl, $time, $event) {
		return 'trigger_'.str_replace(DB_TBL_PREFIX, '', $tbl).'_'.$time.'_'.$event;
	}
	
	public function getLogFileDeleteType($tbl) {
		return str_replace(DB_TBL_PREFIX, '', $tbl);
	}
	
}
