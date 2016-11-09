<?php

namespace ConsoleTVs\Apify\Controllers;

use App\Http\Controllers\Controller;
use Schema;
use DB;

class ApifyController extends Controller
{
    public function table($table, $accessor = null, $data = null)
    {
        if ( ! config('apify.enabled') ) {
            abort(404);
        }

        if ( $data ) {
            $data = explode(",", $data);
        }

        if ($error = $this->checkTable($table, $accessor, $data)) {
            return $error;
        }

        $columns = $this->getAvailableColumns($table);

        $data = $this->getData($table, $columns, $accessor, $data);

        return [$table => $data];
    }

    public function checkTable($table, $accessor, $data)
    {
        if ( ! Schema::hasTable($table) ) {
            return ['error' => "The table $table does not exist."];
        }

        if ( ! array_key_exists($table, config("apify.tables") ) ) {
            return ['error' => "The table $table is not set up in the configuration."];
        }

        if ( $accessor && count($data) == 0) {
            return ['error' => "If you provide an accessor you need to specify some data separated by comas"];
        }

        return false;
    }

    public function getAvailableColumns($table)
    {
        $columns = Schema::getColumnListing($table);

        $final_columns = [];
        foreach ( $columns as $column ) {
            if ( in_array($column, config("apify.tables.$table") ) ) {
                array_push($final_columns, $column);
            }
        }

        return $final_columns;
    }

    public function getData($table, $columns, $accessor = null, $data = null)
    {
        $rows = DB::table($table);

        if ($accessor && $data) {
            $rows = $rows->whereIn($accessor, $data);
            $rows = $rows->get();
        } else {
            $rows = $rows->get();
        }

        $data = [];

        foreach ($rows as $row) {
            $row_data = [];
            foreach ( $columns as $column ) {
                $row_data[$column] = $row->$column;
            }
            array_push($data, $row_data);
        }

        return $data;
    }
}
