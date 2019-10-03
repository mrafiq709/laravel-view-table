<?php

namespace Scuti\LaravelTable;


use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use phpDocumentor\Reflection\Types\Array_;

class TableBuilder implements Htmlable
{
    const ACTION_VIEW = 'view';
    const ACTION_EDIT = 'edit';
    const ACTION_DELETE = 'delete';
    const ORDER_FIELD_KEY = 'order_by';
    const ORDER_DIR_KEY = 'order_dir';

    /**
     * @var array $data
     */
    protected $data;

    /**
     * columns configuration
     * @var array $columns
     */
    protected $columns;

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @var array actions
     */
    protected $actions = [];

    /**
     * @var string
     */
    private $view = "scuti::table";

    /**
     * @var
     */
    protected $pagination;

    /**
     * @param array|LengthAwarePaginator $dataSource
     */
    public function setDataSource($dataSource): void
    {
        if (is_array($dataSource)) {
            $this->data = $dataSource;
        } elseif ($dataSource instanceof LengthAwarePaginator) {
            $this->data = $dataSource->toArray()['data'];
            $this->setPagination($dataSource->appends(request()->all())->links());
        }
    }

    /**
     * @param mixed $pagination
     */
    public function setPagination($pagination): void
    {
        $this->pagination = $pagination;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    /**
     * @return array
     */
    private function buildData() : array
    {
        return [
            'data' => $this->data,
            'pagination' => $this->pagination,
            'columns' => $this->getColumns(),
            'actions' => $this->actions,
            'ordering' => [
                'field' => request(self::ORDER_FIELD_KEY),
                'dir' => request(self::ORDER_DIR_KEY)
            ],
            'orderConfig' => [
                'field' => self::ORDER_FIELD_KEY,
                'dir' => self::ORDER_DIR_KEY
            ],
            'attributes' => $this->attributes
        ];
    }

    /**
     * @return array
     */
    private function getColumns() : array
    {
        //Add actions column
        if ($this->actions) {
            array_push($this->columns, Column::action());
        }
        return array_map(function($column) {
            return ($column instanceof Column) ? $column->toArray() : $column;
        }, $this->columns);
    }

    /**
     * @return View
     */
    public function render()
    {
        return view()->make($this->view, $this->buildData());
    }

    /**
     * Get content as a string of HTML.
     *
     * @return string
     * @throws \Throwable
     */
    public function toHtml()
    {
        return $this->render()->render();
    }
}
