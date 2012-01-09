<div class="menu row">
	<ul id="menu-main">
		<li><a href="javascript:show_view('/main/books')" title="Books">Books</a></li>
		<li><a href="javascript:show_view('/main/authors')" title="Authors">Authors</a></li>
		<li><a href="javascript:show_view('/main/publishers')" title="Publishers">Publishers</a></li>
		<li><a href="javascript:show_view('/main/genres')" title="Genres">Genres</a></li>
		<li><a href="javascript:show_view('/main/under_construction')" title="Loans">Loans</a></li>
        <li><a href="javascript:show_view('/main/under_construction')" title="Statistics">Statistics</a></li>
		<li class="logout"><a title="Logout" href="sessions/logout" style='text-decoration:none'>Logout</a></li>
	</ul>
</div>

<div id="body-container" class="body row scroll-y">

<?php 
$CI =& get_instance();
$data['login_page']=false;
$data['books']=$CI->mongo_manage->getBooksList();
$this->load->view('main/books',$data);
?>

</div>
