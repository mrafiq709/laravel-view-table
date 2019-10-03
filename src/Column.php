<?php

namespace Scuti\LaravelTable;


use Illuminate\Support\Fluent;

class Column extends Fluent
{
    /**
     * Column constructor.
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        $attributes = array_merge([
            //Default attributes
            'cell' => 'text',
            'title' => '',
            'data' => '',
            'options' => [],
            'orderable' => true
        ], $attributes);
        parent::__construct($attributes);
    }

    /**
     * @param string $title
     * @return Column
     */
    public function title(string $title) : self
    {
        $this->attributes['title'] = $title;
        return $this;
    }

    /**
     * @param string $cell
     * @return Column
     */
    public function cell(string $cell) : self
    {
        $this->attributes['cell'] = $cell;
        return $this;
    }

    /**
     * @param bool $orderable
     * @return Column
     */
    public function orderable(bool $orderable) : self
    {
        $this->attributes['orderable'] = $orderable;
        return $this;
    }

    /**
     * @param $data
     * @return Column
     */
    public function data($data) : self
    {
        $this->attributes['data'] = $data;
        return $this;
    }

    /**
     * @param array $options
     * @return Column
     */
    public function options($options) : self
    {
        $this->attributes['options'] = array_merge_recursive($this->attributes['options'], $options);
        return $this;
    }

    /**
     * Make a new column instance.
     *
     * @param mixed $data
     * @param string $title
     * @return Column
     */
    public static function make($data, string $title = '') : self
    {
        $attr = [
            'data' => $data,
            'title' => $title ?: ucfirst($data),
        ];

        return new static($attr);
    }

    /**
     * Make a checkbox column
     *
     * @param $data
     * @param string $title
     * @return Column
     */
    public static function checkbox($data, string $title = '') : self
    {
        return static::make($data, $title)
            ->cell('checkbox')
            ->orderable(false);
    }

    /**
     * Make a custom column
     *
     * @param string $cell
     * @param $data
     * @param string $title
     * @param array $options
     * @return Column
     */
    public static function custom(string $cell, $data, string $title = '', array $options = []) : self
    {
        return static::make($data, $title)
            ->cell($cell)
            ->options($options)
            ->orderable(false);
    }

    public static function action() : self
    {
        $attr = [
            'cell' => 'action',
            'orderable' => false,
            'title' => trans('Actions')
        ];

        return new static($attr);
    }

}
