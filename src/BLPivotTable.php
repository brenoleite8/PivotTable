<?php
namespace BrenoLeite8\pivottable;

use Adianti\Widget\Base\TElement;
use Adianti\Widget\Base\TScript;
use Adianti\Control\TPage;
use Adianti\Database\TRecord;
use Adianti\Database\TRepository;

class BLPivotTable extends TElement
{
    protected $id;
    
    private $objects;
    private $rows    = ''; 
    private $columns = '';
    private $height = '500px'; 
    private $width = '500px';
    private $return;

    public function __construct()
    {
        parent::__construct('div');
       
        // JS Libraries
        TPage::include_js('https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/pivot.min.js');
        TPage::include_js('https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/pivot.pt.min.js');
        // TPage::include_js('https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/tips_data.min.js');
        // TPage::include_js('https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/plotly_renderers.min.js');
        // TPage::include_js('https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/pivot_spec.min.js');
        // TPage::include_js('https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/gchart_renderers.min.js');
        // TPage::include_js('https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/export_renderers.min.js');
        // TPage::include_js('https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/d3_renderers.min.js);
        // TPage::include_js('https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/c3_renderers.min.js');
        
        // CSS Libraries
        TPage::include_css('https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/pivot.min.css');
        
        $this->id = 'bl_pivot_table_' . uniqid();
      
    }

    public function setObjects(TRecord $objects) 
    {       
        $this->objects = $objects->toArray();
    }

    public function setRows(array $rows) 
    {       
        $this->rows = $rows;
    }

    public function setColumns(array $columns) 
    {       
        $this->columns = $columns;
    }

    private function create()
    {
        TScript::create("$(function(){
                            $('#".$this->id."').pivotUI(
                                [
                                    {color: 'blue', shape: 'circle'},
                                    {color: 'red', shape: 'triangle'}
                                ],
                                {
                                    rows: ['color'],
                                    cols: ['shape']
                                }
                            );
                        });
                        ");
    }


    public function show()
    {
        $style = new TElement('style');
        $style->add('#'.$this->id.'{ height:'.$this->height.';  width: '.$this->width.'; }');
        
        $this->create();

        $content = new TElement('div');
        $content->id = $this->id;
                
        return  $style.$content;
    }

}