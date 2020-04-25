<?php

namespace console\classes\parsers;

use console\models\RawCols;
use PhpOffice\PhpSpreadsheet\Collection\Cells;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ParserXlsx
{
    private $spreadsheet;
    private $file_path;
    private $header_row = [];
    private $replace_headers;
    private $excel_headers;
    private $model_headers;
    private $model_name;

    private const LIMIT_EMPTY_ROW_IN_SEQUENCE = 50;

    /**
     * ParserXlsx constructor.
     * @param string $file_path
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function __construct(string $file_path)
    {
        $this->file_path = $file_path;
        $this->setParser();
    }

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    private function setParser(): void
    {
        $reader = new Xlsx();
        $reader->setReadDataOnly(true);
        $this->spreadsheet = $reader->load($this->file_path);
    }

    public function parse(): void
    {
        /** @var Spreadsheet */
        $cell_collection = $this->spreadsheet->getSheet(0)->getCellCollection();
        $count_empty_row_in_sequence = 0;
        $num_row = 0;
        $time = time();
        $rows = [];
        while (!$this->isEndSheet($count_empty_row_in_sequence)) {
            $num_row++;
            if (!$this->header_row) {
                $this->setHeaderRow($num_row, $cell_collection);
                $count_empty_row_in_sequence = $this->header_row ? 0 : $count_empty_row_in_sequence + 1;
                continue;
            }

            $row = [];
            foreach ($this->header_row as $letter => $header_title) {
                $cell = $cell_collection->get($letter . $num_row);
                if (!$cell) {
                    $count_empty_row_in_sequence++;
                    break;
                }
                $cell_value = (string)$cell->getValue();
                $row[$header_title] = $cell_value;
            }
            $this->setModelRow($row, $time);
            if (!$row[0] && !$row[1] && !$row[2]) {
                $count_empty_row_in_sequence++;
                continue;
            }
            $rows[] = $row;
            if (count($rows) === 1000) {
                $this->setModelName();
                $this->model_headers = $this->model_name::batchInsert($rows);
                $rows = [];
            }
        }

        if ($rows) {
            $this->setModelName();
            $this->model_headers = $this->model_name::batchInsert($rows);
            $rows = [];
        }
    }

    private function setModelRow(array &$row, int $time)
    {
        $this->setReplaceHeadersByFileName();
        if ($this->replace_headers) {
            foreach ($this->replace_headers as $original_header => $replace_header) {
                $value = $row[$original_header] ?? '';
                unset($row[$original_header]);
                $row[$replace_header] = $value;
            }
        }

        $this->setModelHeadersByFileName();
        $temp_row = $row;
        $row = [];
        foreach ($this->model_headers as $header) {
            $row[] = $temp_row[$header] ?? '';
        }
        $row[] = $time;
        $row[] = $time;
    }

    private function setModelName(): void
    {
        if (isset($this->model_name)) {
            return;
        }

        $parts_path = pathinfo($this->file_path);
        switch ($parts_path['filename']) {
            case '01.COLs':
                $this->model_name = RawCols::class;
                return;
            default:
                $this->model_headers = null;
                return;
        }
    }

    private function setExcelHeadersByFileName(): void
    {
        if (isset($this->excel_headers)) {
            return;
        }

        $this->setModelName();
        $this->excel_headers = $this->model_name::getExcelHeaders();
    }

    private function setModelHeadersByFileName(): void
    {
        if (isset($this->model_headers)) {
            return;
        }

        $this->setModelName();
        $this->model_headers = $this->model_name::getModelHeaders();
    }

    private function setReplaceHeadersByFileName(): void
    {
        if (isset($this->replace_headers)) {
            return;
        }

        $this->setModelName();
        $this->replace_headers = $this->model_name::getReplaceHeaders();
    }

    /**
     * @param int $count_empty_row_in_sequence
     * @return bool
     */
    private function isEndSheet(int $count_empty_row_in_sequence): bool
    {
        return $count_empty_row_in_sequence === self::LIMIT_EMPTY_ROW_IN_SEQUENCE;
    }

    private function setHeaderRow(int $num_row, Cells $cell_collection): void
    {
        $this->setExcelHeadersByFileName();
        $alphabet = $this->getAlphabet();
        foreach ($alphabet as $letter) {
            $cell = $cell_collection->get($letter . $num_row);
            if (!$cell) {
                break;
            }
            $cell_value = trim((string) $cell->getValue());
            if (in_array($cell_value, $this->excel_headers)) {
                $this->header_row[$letter] = $cell_value;
            }
        }

        if ($this->isNotFoundHeaderRow()) {
            $this->header_row = [];
        }
    }

    private function isNotFoundHeaderRow(): bool
    {
        return count($this->header_row) !== count($this->excel_headers);
    }

    /**
     * @return array
     */
    private function getAlphabet(): array
    {
        return range('A', 'Z');
    }
}