<div class="ui-widget">
    <div class="ui-state-highlight ui-corner-all content row" style="padding: 0 .7em;">
        <ul id="header-menu" class="header menu row">
	        <li><strong">Publishers</strong></li>
           <li id="button" class="button"><img id="button-image" src="/assets/images/icons/publish-plus.png" alt="New publisher">New publisher</li>
        </ul>        
        
        <div id="add-edit-form" class="menu row" style="display:none"><? 
    			echo form_open('authors/add',array('id'=>'add-form', 'style'=>'width:80%;')); 
				echo form_fieldset('', array('class'=>'form'));
				echo '<div class="author-field">';
				echo form_label('Author name:', 'authorname');
				echo form_input(array('name' => 'authorname',
									'id' => 'authorname',
									'type' => 'text',
									'value' => ''));
				echo form_error('authorname');
				echo "</div>\n";
				echo '<div class="author-field">';
				echo form_label('Nationality:', 'nationality');
				echo form_input(array('name' => 'nationality',
									'id' => 'nationality',
									'type' => 'text',
									'value' => ''));
				echo form_error('nationality');
				echo "</div>\n";

				echo '<div class="postitive" name="Submit" id="submit"><img src="/assets/images/icons/tick.png" alt="Commit" style="margin: 2px 2px -3px 0px;">Confirm</div>';
				echo '<div class="negative" name="Submit-close" id="submit-close"><img src="/assets/images/icons/cross.png" alt="Abort" style="margin: 2px 2px -3px 0px;">Close</div>';
				echo '<span id="formProgress" class="formProgress"></span>';
						
                echo form_fieldset_close();
                echo form_close(); ?>
        </div>

        <div id="publishers-list" class="inner-body row scroll-y">
        <table id="publishers-rounded-corner">
            <!-- Table header -->  
                <thead>  
                    <tr>  
                        <th scope="col" class="rounded-left" id="name">Name</th>  
                        <th scope="col" class="rounded" id="email">Email</th>
                        <th scope="col" class="rounded" id="web">Website</th>
                        <th scope="col" class="rounded" id="edit"></th>
                        <th scope="col" class="rounded" id="delete"></th>
                        <th scope="col" class="rounded" id="books"></th>
                    </tr>  
                </thead> 
                <tfoot>
                    <tr>
                        <td colspan="6" class="rounded-foot-left">&nbsp;</td>
                    </tr>
			    </tfoot> 
                <tbody>  
				<?php
                    if (count($publishers)!=0) {
						foreach ($publishers as $publisher) {
							echo '<tr><td id="name">'.$publisher->name.'</td>'."\n";
							echo '<td id="email">'.$publisher->email.'</td>'."\n";
							echo '<td id="web">'.$publisher->website.'</td>'."\n";
							echo '<td id="edit" title="Edit Publisher" value="'.$publisher->_id.'"></td>'."\n";
							echo '<td id="delete" title="Delete Publisher" value="'.$publisher->_id.'"></td>'."\n";
							echo '<td id="books" title="Publisher\'s Books" value="'.$publisher->_id.'"></td>';
						}
                    } else {
                        echo '<tr><td colspan="6">No publishers founded</td></tr>';
                    }
                ?>
                </tbody>
        </table>
        </div>
    </div>
</div>