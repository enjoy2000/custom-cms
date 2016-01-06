<?php

namespace Admin\Table;

use ZfTable\AbstractTable;

class Blog extends AbstractTable
{
    protected $config = [
        //'name' => 'Doctrine',
        'showPagination'  => true,
        'showQuickSearch' => true,
        'showItemPerPage' => true,
        //'showColumnFilters' => true,
    ];

    //Definition of headers
    protected $headers = [
        'id'           => ['tableAlias' => 'b', 'title' => 'Id', 'width' => '50', 'filters' => 'text'],
        'title'        => ['tableAlias' => 'b', 'title' => 'Title', 'filters' => 'text'],
        'gridCategory' => ['tableAlias' => 'b', 'title' => 'Category', 'filters' => 'text', 'separatable' => true],
        'blogLanguage' => ['tableAlias' => 'b', 'title' => 'Language', 'filters' => 'text', 'separatable' => true],
        'published'    => ['tableAlias' => 'b', 'title' => 'Status', 'filters' => 'text'],
        'createTime'   => ['tableAlias' => 'b', 'title' => 'Create', 'filters' => 'date'],
        'actions'      => ['tableAlias' => 'b', 'title' => 'Actions'],
    ];

    public function init()
    {
        $this->getHeader('published')->getCell()->addDecorator('mapper', [
            '0' => '<i class="fa fa-toggle-off"></i>',
            '1' => '<i class="fa fa-toggle-on"></i>',
        ]);

        //\Application\Helper\Util::var_dump($context);
    }

    protected function initFilters($query)
    {
        if ($value = $this->getParamAdapter()->getQuickSearch()) {
            $query->andWhere('b.title like :value')
                ->setParameter(':value', '%'.$value.'%');
        }
    }
}
