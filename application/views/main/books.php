<?php
$CI =& get_instance();
$CI->load->helper('books');

$books_of='';
if(isset($author_name)){
	 $books_of = '"'.$author_name.'" ';
	}
	
if(isset($publisher)){
	 $books_of = '"'.$publisher.'" ';
	}
	
if(isset($genre)){
	 $books_of = '"'.$genre.'" ';
	}

?>

<script src="/js/book-controls-init.js" type="text/javascript"></script>

<div class="ui-widget">
    <div id="data-container" class="ui-state-highlight ui-corner-all content row" style="padding: 0 .7em;">
        <ul id="header-menu" class="header menu row">
	       <li><strong"><?php echo $books_of; ?>Books (<?php echo count($books); if(isset($books_searched)){echo ' founded';}else{echo ' inserted';}?>)</strong></li>
           <li id="search-button" class="button"><img id="button-image" src="/assets/images/icons/magnifier.png" alt="Search books">Search</li>
           <li id="book-button" class="button"><img id="button-image" src="/assets/images/icons/book-plus.png" alt="New book">New book</li>
           <li id="all-button" class="button" <?php if(isset($books_searched)){echo '';}else{echo 'style="display:none"';} ?>><img id="button-image" src="/assets/images/icons/books.png" alt="Show all book">Show all book</li>
        </ul>
        
        <div id="book-search-form" class="menu row" style="display:none"><? 
    			echo form_open('books/search',array('id'=>'book-seek-form')); 

				echo '<table id="search-book" style="width:100%;">';
				echo '	<tr><td id="label-search" >'.form_label('Title:', 'title-search').'</td><td id="label-search" >'.form_label('Author:', 'author-search').'</td><td id="label-search" >'.form_label('Publisher:', 'publisher-search').'</td><td id="label-search" >'.form_label('Genre:', 'genre-search').'</td><td id="label-search" >'.form_label('Pages:', 'pages-search').'</td><td id="label-search">'.form_label('Vote:', 'vote-search').'</td></tr>';
				echo '<tr>
							<td id="value-search" >
								<span id="drop" style="float:left;">'.
									form_dropdown('title-where',array('eql'=>'Equal to',
													'like'=>'Like to'),'like','id="title-where" style="float:left;"').
								'</span>
								<span style="float:left; width:99%;" >'.
									form_input(array('name' => 'title-search',
												   'id' => 'title-search',
												   'type' => 'text',
												   'value' => '')).
								'</span>
							</td>
							<td id="value-search" >
								<span id="drop" style="float:left;">'.
									form_dropdown('author-where',array('eql'=>'Equal to',
												'like'=>'Like to',
													'not-eql'=>'Different from'),'like','id="author-where" style="float:left;"').
								'</span>
								<span style="float:left; width:99%;" >'.
									form_input(array('name' => 'author-search',
												   'id' => 'author-search',
												   'type' => 'text',
												   'value' => '')).
								'</span>
							</td>
							<td id="value-search" >
								<span id="drop" style="float:left;">'.
									form_dropdown('publisher-where',array('eql'=>'Equal to',
												'like'=>'Like to',
													'not-eql'=>'Different from'),'like','id="publisher-where" style="float:left;"').
								'</span>
								<span style="float:left; width:99%;" >'.
									form_input(array('name' => 'publisher-search',
												   'id' => 'publisher-search',
												   'type' => 'text',
												   'value' => '')).
								'</span>
							</td>
							<td id="value-search" >
								<span id="drop" style="float:left;">'.
									form_dropdown('genre-where',array('eql'=>'Equal to',
												'like'=>'Has tags'),'like','id="genre-where" style="float:left;"').
								'</span>
								<span style="float:left; width:99%;" >'.
									form_input(array('name' => 'genre-search',
												   'id' => 'genre-search',
												   'type' => 'text',
												   'value' => '')).
								'</span>
							</td>
							<td id="value-search">
								<span id="drop" style="float:left;">'.
									form_dropdown('pages-where',array('maj'=>'> (more then)',
													'min'=>'< (less then)',
													'eql'=>'= (equal to)',
													'maj-eql'=>'>= (more or equal to)',
													'min-eql'=>'<= (less or equal to)',
													'not-eql'=>'<> (not equal to)'),'','id="pages-where" style="float:left;"').
								'</span>
								<span style="float:left; width:99%;" >'.
									form_input(array('name' => 'pages-search',
												   'id' => 'pages-search',
												   'type' => 'text',
												   'value' => '')).
								'</span>
							</td>
							<td id="value-search">
								<span id="drop" style="float:left; margin-top:-9px;">'.
									form_dropdown('vote-where',array('maj'=>'> (more then)',
													'min'=>'< (less then)',
													'eql'=>'= (equal to)',
													'maj-eql'=>'>= (more or equal to)',
													'min-eql'=>'<= (less or equal to)',
													'not-eql'=>'<> (not equal to)'),'','id="vote-where" style="float:left; margin-bottom:5px;"').
								'</span>
								<span style="float:left; width:99%;" >
										<div id="value-search">
											<input name="star1" type="radio" class="star" id="1" value ="1" title="Rubbish"/>
											<input name="star1" type="radio" class="star" id="2" value ="2" title="Useless"/>
											<input name="star1" type="radio" class="star" id="3" value ="3" title="Gloomy"/>
											<input name="star1" type="radio" class="star" id="4" value ="4" title="Poor"/>
											<input name="star1" type="radio" class="star" id="5" value ="5" title="Insufficient"/>
											<input name="star1" type="radio" class="star" id="6" value ="6" title="Normal"/>
											<input name="star1" type="radio" class="star" id="7" value ="7" title="Quite Good"/>
											<input name="star1" type="radio" class="star" id="8" value ="8" title="Good"/>
											<input name="star1" type="radio" class="star" id="9" value ="9" title="Great"/>
											<input name="star1" type="radio" class="star" id="10" value ="10" title="Wonderful"/>
										</div>
								</span>
							</td>
						</tr>';
				echo '	<tr>';
				echo '		<td colspan="4">&nbsp;</td>';
				echo '		<td><span id="formProgress" class="formProgress"></span></td>';
				echo '		<td><div id="commit-search"><img src="/assets/images/icons/magnifier.png" alt="Search" style="margin: 2px 2px -3px 0px;">Find Books</div>';
				echo '		<div id="abort-search"><img src="/assets/images/icons/cross.png" alt="Abort" style="margin: 2px 2px -3px 0px;">Abort</div></td>';
				echo '	</tr>';
				echo '</table>';

                echo form_close(); ?>
        </div>
        
        <div id="book-add-edit-form" class="menu row" style="display:none"><? 
    			echo form_open('books/add',array('id'=>'book-add-form')); 

				echo '<table id="insert-book" style="width:50%;">';
				echo '	<tr>';
				echo '		<td id="label" >'.form_label('Title:', 'title').'</td>';
				echo '		<td id="value" colspan="3">'.form_input(array('name' => 'title',
															   'id' => 'title',
															   'type' => 'text',
															   'value' => '')).'</td>';
				echo '		<td id="tmp-cover" colspan="2" rowspan="6"><img alt="" style="height: 168px;" id="show-cover" src="/assets/covers/nocover.cvr" /></td>';
				echo '	</tr>';
				echo '	<tr>';
				echo '		<td id="label" >'.form_label('Original:', 'original-title').'</td>';
				echo '		<td id="value" colspan="3">'.form_input(array('name' => 'original-title',
															   'id' => 'original-title',
															   'type' => 'text',
															   'value' => '')).'</td>';
				echo '	</tr>';
				echo '	<tr>';
				echo '		<td id="label" >'.form_label('Author:', 'author').'</td>';
				echo '		<td id="value" colspan="3">'.form_input(array('name' => 'author',
															   'id' => 'author',
															   'type' => 'text',
															   'value' => '')).'</td>';
				echo '	</tr>';
				echo '	<tr>';
				echo '		<td id="label" >'.form_label('Publisher:', 'publisher').'</td>';
				echo '		<td id="value" colspan="3">'.form_input(array('name' => 'publisher',
															   'id' => 'publisher',
															   'type' => 'text',
															   'value' => '')).'</td>';
				echo '	</tr>';
				echo '	<tr>';
				echo '		<td id="label" >'.form_label('Genre:', 'genre').'</td>';
				echo '		<td id="value" colspan="3">'.form_input(array('name' => 'genre-tags',
															   'id' => 'genre-tags',
															   'type' => 'text',
															   'value' => '')).'</td>';

				echo '	</tr>';
				echo '	<tr>';
				echo '		<td id="pages-label" >'.form_label('Pages:', 'pages').'</td>';
				echo '		<td id="pages-value">'.form_input(array('name' => 'pages',
															   'id' => 'pages',
															   'type' => 'text',
															   'value' => '')).'</td>';
				echo '		<td id="vote-label">'.form_label('Vote:', 'vote').'</td>';
				echo '		<td id="vote-value">';
				echo '		    <input name="star1" type="radio" class="star" id="1" value ="1" title="Rubbish"/>';
				echo '		    <input name="star1" type="radio" class="star" id="2" value ="2" title="Useless"/>';
				echo '		    <input name="star1" type="radio" class="star" id="3" value ="3" title="Gloomy"/>';
				echo '		    <input name="star1" type="radio" class="star" id="4" value ="4" title="Poor"/>';
				echo '		    <input name="star1" type="radio" class="star" id="5" value ="5" title="Insufficient"/>';
				echo '		    <input name="star1" type="radio" class="star" id="6" value ="6" title="Normal"/>';
				echo '		    <input name="star1" type="radio" class="star" id="7" value ="7" title="Quite Good"/>';
				echo '		    <input name="star1" type="radio" class="star" id="8" value ="8" title="Good"/>';
				echo '		    <input name="star1" type="radio" class="star" id="9" value ="9" title="Great"/>';
				echo '		    <input name="star1" type="radio" class="star" id="10" value ="10" title="Wonderful"/>';
				echo '		</td>';
				echo '	</tr>';
				echo '	<tr>';
				echo '		<td id="label" >'.form_label('Year:', 'year').'</td>';
				echo '		<td id="year-value" >'.form_input(array('name' => 'year',
															   'id' => 'year',
															   'type' => 'text',
															   'value' => '')).'</td>';
				echo '		<td id="label" >'.form_label('Buyed:', 'buyed').'</td>';
				echo '		<td id="buyed-value" >'.form_input(array('name' => 'buyed',
															   'id' => 'buyed',
															   'type' => 'text',
															   'value' => '')).'</td>';
				echo '		<td id="choose-cover" title="Choose cover">&nbsp;</td>';
				echo '		<td id="delete-cover" title="Remove cover">&nbsp;</td>';
				echo '	</tr>';
				echo '	<tr>';
				echo '		<td colspan="6">'.form_label('Description:', 'description').'</td>';
				echo '	</tr>';
				echo '	<tr>';
				echo '		<td colspan="6"><textarea name="description" id="description" rows=3 cols=30 ></textarea></td>';
				echo '	</tr>';
				echo '	<tr>';
				echo '		<td colspan="3">&nbsp;</td>';
				echo '		<td><span id="formProgress" class="formProgress"></span></td>';
				echo '		<td id="commit"><img src="/assets/images/icons/tick.png" alt="Commit" style="margin: 2px 2px -3px 0px;">Confirm</td>';
				echo '		<td id="abort"><img src="/assets/images/icons/cross.png" alt="Abort" style="margin: 2px 2px -3px 0px;">Close</td>';
				echo '	</tr>';
				echo '</table>';

                echo form_close(); ?>
        </div>

        <div id="books-list" class="inner-body row scroll-y">
        <table id="books-rounded-corner">
            <!-- Table header -->  
                <thead>  
                    <tr>  
                        <th scope="col" class="rounded-left" id="cover"></th>
                        <th scope="col" class="rounded" id="book-info"></th>
                        <th scope="col" class="rounded" id="book-description"></th>
                        <th scope="col" class="rounded" id="book-funcitons"></th>
                    </tr>  
                </thead> 
                <tfoot>
                    <tr>
                        <td colspan ="4" class="rounded-foot-left">&nbsp;</td>
                    </tr>
			    </tfoot> 
                <tbody>  
				<?php
					if (isset($books)) {
						if (count($books)!=0) {
							foreach ($books as $book) {
								ShowBook($book);
							}
						} else {
							if(isset($books_searched)){
								echo '<tr><td colspan="4">No books founded with the given params!</td></tr>';
							} else {
								echo '<tr><td colspan="4">No books in the shelf</td></tr>';
							}
						}
						
					} else {
						if(isset($books_searched)){
							echo '<tr><td colspan="4">No books founded with the given params!</td></tr>';
						} else {
							echo '<tr><td colspan="4">No books in the shelf</td></tr>';
						}
					}
                ?>
                </tbody>
        </table>
        </div>
    </div>
</div>