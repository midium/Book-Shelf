<div class="ui-widget">
    <div id="data-container" class="ui-state-highlight ui-corner-all content row" style="padding: 0 .7em;">
        <ul id="header-menu" class="header menu row">
	        <li><strong">Genres (<?php echo count($genres); echo ' inserted';?>)</strong></li>
           <li id="button" class="button"><img id="button-image" src="/assets/images/icons/genre-plus.png" alt="New genre">New genre</li>
        </ul>        
        
        <div id="genre-add-edit-form" class="menu row" style="display:none"><? 
    			echo form_open('genres/add_genre',array('id'=>'genre-add-form', 'style'=>'width:98%;')); 
				echo form_fieldset('', array('class'=>'form'));
				echo '<div class="genre-field">';
				echo form_label('Genre name:', 'genre');
				echo form_input(array('name' => 'genre',
									'id' => 'genre',
									'type' => 'text',
									'value' => ''));
				echo form_error('genre');
				echo "</div>\n";
				
				echo '<div class="postitive" name="Submit" id="submit"><img src="/assets/images/icons/tick.png" alt="Commit" style="margin: 2px 2px -3px 0px;">Confirm</div>';
				echo '<div class="negative" name="Submit-close" id="submit-close"><img src="/assets/images/icons/cross.png" alt="Abort" style="margin: 2px 2px -3px 0px;">Close</div>';
				echo '<span id="formProgress" class="formProgress"></span>';
						
                echo form_fieldset_close();
                echo form_close(); ?>
        </div>

        <div id="genres-list" class="inner-body row scroll-y">
        <table id="genres-rounded-corner">
            <!-- Table header -->  
                <thead>  
                    <tr>  
                        <th scope="col" class="rounded-left" id="name">Name</th>  
                        <th scope="col" class="rounded" id="edit-genre"></th>
                        <th scope="col" class="rounded" id="delete-genre"></th>
                        <th scope="col" class="rounded" id="books-genre"></th>
                    </tr>  
                </thead> 
                <tfoot>
                    <tr>
                        <td colspan="6" class="rounded-foot-left">&nbsp;</td>
                    </tr>
			    </tfoot> 
                <tbody>  
				<?php
                    if (count($genres)!=0) {
						foreach ($genres as $genre) {
							echo '<tr><td id="name">'.$genre->name.'</td>'."\n";
							echo '<td id="edit-genre" title="Edit Genre" value="'.$genre->_id.'"></td>'."\n";
							echo '<td id="delete-genre" title="Delete Genre" value="'.$genre->_id.'"></td>'."\n";
							echo '<td id="books-genre" title="Genre\'s Books" value="'.$genre->_id.'"></td>';
						}
                    } else {
                        echo '<tr><td colspan="6">No genres founded</td></tr>';
                    }
                ?>
                </tbody>
        </table>
        </div>
    </div>
</div>