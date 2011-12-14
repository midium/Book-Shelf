<div class="ui-widget">
    <div class="ui-state-highlight ui-corner-all content row" style="padding: 0 .7em;">
        <ul id="header-menu" class="header menu row">
	        <li><strong">Authors</strong></li>
            <li id="button" class="button"><a href="javascript:show_view('/main/add_edit_author')" id="new-author"><img src="/assets/images/icons/add-user.png" alt="New author">New author</a></li>
        </ul>        
        
        <div id="authors-list" class="inner-body row scroll-y">
        <table id="authors-rounded-corner">
            <!-- Table header -->  
                <thead>  
                    <tr>  
                        <th scope="col" class="rounded-left" id="name">Name</th>  
                        <th scope="col" class="rounded" id="nat">Nationality</th>
                        <th scope="col" class="rounded" id="edit"></th>
                        <th scope="col" class="rounded" id="delete"></th>
                        <th scope="col" class="rounded" id="books"></th>
                    </tr>  
                </thead> 
                <tfoot>
                    <tr>
                        <td colspan="5" class="rounded-foot-left">&nbsp;</td>
                    </tr>
			    </tfoot> 
                <tbody>  
				<?php
                    /*if (count($authors)!=0) {
                        echo "<tr><td>Data retrieved</td></tr>";
                    } else {
                        echo '<tr><td colspan="5">No authors founded</td></tr>';
                    }*/
                ?>
                        <td id="name">J.R.R. Tolkien</td>
                        <td id="nat">Great Britain</td>
                        <td id="edit" title="Edit author"></td>
                        <td id="delete" title="Delete author"></td>
                        <td id="books" title="Author's books"></td>
                </tbody>
        </table>
        </div>
    </div>
</div>