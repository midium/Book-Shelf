<div class="ui-widget">
    <div id="data-container" class="ui-state-highlight ui-corner-all content row" style="padding: 0 .7em;">
        <ul id="header-menu" class="header menu row">
	        <li><strong">Publishers (<?php echo count($publishers); echo ' inserted';?>)</strong></li>
           <li id="button" class="button"><img id="button-image" src="/assets/images/icons/publish-plus.png" alt="New publisher">New publisher</li>
        </ul>        
        
        <div id="publish-add-edit-form" class="menu row" style="display:none"><? 
    			echo form_open('publishers/add',array('id'=>'publisher-add-form', 'style'=>'width:98%;')); 
				echo form_fieldset('', array('class'=>'form'));
				echo '<div class="publisher-field">';
				echo form_label('Publisher name:', 'publisher');
				echo form_input(array('name' => 'publisher',
									'id' => 'publisher',
									'type' => 'text',
									'value' => ''));
				echo form_error('publisher');
				echo "</div>\n";
				echo '<div class="publisher-field">';
				echo form_label('Email:', 'pub-email');
				echo form_input(array('name' => 'pub-email',
									'id' => 'pub-email',
									'type' => 'text',
									'value' => ''));
				echo form_error('pub-email');
				echo "</div>\n";
				echo '<div class="publisher-field">';
				echo form_label('Website:', 'pub-web');
				echo form_input(array('name' => 'pub-web',
									'id' => 'pub-web',
									'type' => 'text',
									'value' => ''));
				echo form_error('pub-web');
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
                        <th scope="col" class="rounded" id="edit-pub"></th>
                        <th scope="col" class="rounded" id="delete-pub"></th>
                        <th scope="col" class="rounded" id="books-pub"></th>
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
							if ($publisher->email!='') {
								echo '<td id="email"><a href="mailto:'.$publisher->email.'">'.$publisher->email.'</a></td>'."\n";
							} else {
								echo '<td id="email"></td>'."\n";
							}
							if ($publisher->website!='') {
								echo '<td id="web"><a href="'.$publisher->website.'">'.$publisher->website.'</a></td>'."\n";
							} else {
								echo '<td id="web"></td>'."\n";
							}
							echo '<td id="edit-pub" title="Edit Publisher" value="'.$publisher->_id.'"></td>'."\n";
							echo '<td id="delete-pub" title="Delete Publisher" value="'.$publisher->_id.'"></td>'."\n";
							echo '<td id="books-pub" title="Publisher\'s Books" value="'.$publisher->_id.'"></td>';
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