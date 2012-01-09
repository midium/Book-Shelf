<?php
function ShowBook($book) {
	echo '<tr><td id="cover"><img id="cover" src="'.BookCover(''.$book->_id).'" /></td>'."\n";
	echo '<td id="book-info">'.ShowBookDetails($book).'</td>'."\n";
	echo '<td id="book-description">'.ShowBookDescription($book).'</td>'."\n";
	echo '<td id="book-functions"><div id="book-edit" title="Edit Book" value="'.$book->_id.'"></div><div id="book-delete" title="Delete Book" value="'.$book->_id.'"></div></td>'."\n";
}

function BookCover($book_id) {
	$CI =& get_instance();

	$url = './assets/covers/'.$book_id.'.cvr';

	if (file_exists($url)) {
		return '/assets/covers/'.$book_id.'.cvr';
	} else {
		return '/assets/covers/nocover.cvr';
	}
}

function ShowBookDetails($book){
	$CI =& get_instance();
	
	$html = '<table id="main-details">';
	
	$html .= '<tr><td id="label"><b>Title:</b></td><td id="value" class="book-title"><strong>'.$book->title.'</strong></td></tr>'."\n";
	$html .= '<tr><td id="label"><b>Author:</b></td><td id="value" class="book-author" auth_id="'.$book->author.'">'.$book->author.'</td></tr>'."\n";
	$html .= '<tr><td id="label"><b>Publisher:</b></td><td id="value" class="book-publisher" pub_id="'.$book->publisher.'">'.$book->publisher.'</td></tr>'."\n";
	$html .= '<tr><td id="label"><b>Genre:</b></td><td id="value" class="book-genres">'.$book->genres.'</td></tr>'."\n";
	$html .= '<tr><td id="label"><b>Pages:</b></td><td id="value" class="book-pages">'.$book->pages.'</td></tr>'."\n";
	$html .= '<tr><td id="label"><b>Vote:</b></td><td id="value" class="book-vote">'.$book->vote.'</td></tr>'."\n";
	
	$html .= '</table>';
	
	return $html;
}

function ShowBookDescription($book){
	$html = '<div id="right-label"><b>Description:</b></div><div id="right-value" class="book-description">'.$book->description.'</div>'."\n";
	
	return $html;
}
?>