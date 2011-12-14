<div class="menu row">
	<ul id="menu-main">
		<li><a href="javascript:show_view('/main/books')" title="Books">Books</a></li>
		<li><a href="javascript:show_view('/main/authors')" title="Authors">Authors</a></li>
		<li><a href="javascript:show_view('/main/under_construction')" title="Publishers">Publishers</a></li>
		<li><a href="javascript:show_view('/main/under_construction')" title="Genres">Genres</a></li>
		<li><a href="javascript:show_view('/main/under_construction')" title="Loans">Loans</a></li>
		<li class="logout"><a title="Logout" href="sessions/logout" style='text-decoration:none'>Logout</a></li>
	</ul>
</div>

<div id="body-container" class="body row scroll-y">

<?php $this->load->view('main/books');?>

</div>
