<div class="ui-widget">
    <div class="ui-state-highlight ui-corner-all content row" style="padding: 0 .7em;">
        <ul id="header-menu" class="header menu row">
	        <li><strong">Insert Author</strong></li>
            <li id="button" class="button"><a href="javascript:show_view('/main/authors')" id="abort"><img src="/assets/images/icons/cross.png" alt="Abort">Abort</a></li>
        </ul>        
        
        <div id="authors-form" class="inner-body row scroll-y">
			<?php 
			if ($edit) {
				//I'm editing an Author
				
			} else {
				//I'm adding new one
			 	echo form_open('authors/add',array('id'=>'add_form')); 
				echo form_fieldset('', array('class'=>'form'));
				echo '<div class="field">';
				echo form_label('Author name:', 'authorname');
				echo form_input(array('name' => 'authorname',
									'id' => 'authorname',
									'type' => 'text',
									'value' => ''));
				echo form_error('authorname');
				echo "</div>\n";
				echo '<div class="field">';
				echo form_label('Nationality:', 'nationality');
				echo form_input(array('name' => 'nationality',
									'id' => 'nationality',
									'type' => 'text',
									'value' => ''));
				echo form_error('nationality');
				echo "</div>\n";
				echo form_button(array('type'=>'submit',
									 'class'=>'positive',
									 'name'=>'Submit',
									 'content'=>'<img src="/assets/images/icons/tick.png" alt="Commit" style="margin: 2px 2px -3px 0px;">Add')); 
						
                echo form_fieldset_close();
                echo form_close();
				
			}
			?>
        </div>
    </div>
</div>