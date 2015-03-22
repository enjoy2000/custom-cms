<?php
namespace Admin\Table;

use Symfony\Component\Console\Application;
use ZfTable\AbstractTable;

class Blog extends AbstractTable
{

    protected $config = array(
        //'name' => 'Doctrine',
        'showPagination' => true,
        'showQuickSearch' => true,
        'showItemPerPage' => true,
        //'showColumnFilters' => true,
    );

    //Definition of headers
    protected $headers = array(
        'id' =>             array('tableAlias' => 'b', 'title' => 'Id', 'width' => '50', 'filters' => 'text') ,
        'title' =>          array('tableAlias' => 'b', 'title' => 'Title' , 'filters' => 'text'),
        'gridCategory' =>           array('tableAlias' => 'b', 'title' => 'Category' , 'filters' => 'text','separatable' => true),
        'blogLanguage' =>         array('tableAlias' => 'b', 'title' => 'Language' , 'filters' => 'text' ,'separatable' => true),
        'published' =>         array('tableAlias' => 'b', 'title' => 'Status' , 'filters' => 'text'),
        'createTime' =>     array('tableAlias' => 'b', 'title' => 'Create' , 'filters' => 'date'),
        'actions' =>         array('tableAlias' => 'b', 'title' => 'Actions'),
    );

    public function init()
    {
        $this->getHeader('published')->getCell()->addDecorator('mapper', array(
            '0' => '<i class="fa fa-toggle-off"></i>',
            '1' => '<i class="fa fa-toggle-on"></i>'
        ));

        //\Application\Helper\Util::var_dump($context);
    }

    protected function initFilters($query)
    {
        if ($value = $this->getParamAdapter()->getQuickSearch()) {
            $query->andWhere('b.title like :value')
                ->setParameter(':value', '%' . $value . '%')
            ;
        }
    }
}