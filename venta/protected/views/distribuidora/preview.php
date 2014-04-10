<?php 
$this->widget('ext.mPrint.mPrint', array(
		'title' => 'Vista Previa',          //the title of the document. Defaults to the HTML title
		'tooltip' => 'Imprimir',        //tooltip message of the print icon. Defaults to 'print'
		//'text' => 'Print Results',   //text which will appear beside the print icon. Defaults to NULL
		'element' => '#preview',        //the element to be printed.
		/*'exceptions' => array(       //the element/s which will be ignored
				'.summary',
				'.search-form'
		),*/
		'publishCss' => true,       //publish the CSS for the whole page?
		'visible' => true,  //should this be visible to the current user?
		'alt' => 'Imprimir',       //text which will appear if image can't be loaded
		//'debug' => true,            //enable the debugger to see what you will get
		'id' => 'print-div'         //id of the print link
));
?>
<div id="preview" style="width:718px; heigth:529px;">
<?php
	//http://www.lawebera.es/accesibilidad-y-usabilidad/optimizar-paginas-web-para-imprimir.php
	
?>
<table class="table">
<thead class="tabular-header">
<tr>
<td><?php echo "detalle";?></td>
</tr>
</thead>
<tbody>
<tr>
<td><?php echo "preview";?></td>
</tr>
</tbody>
</table>
</div>
