    <div id="wrappertop"></div>
    <div id="wrapper">
            <div id="content">
                <div id="darkbanner" class="banner320">
                    <h2>Login</h2>
    
                </div>
                <div id="darkbannerwrap">
                </div>
                <?php echo form_open('sessions/authenticate',array('name'=>'form1')); 
					  echo form_fieldset('', array('class'=>'form'));
					  echo "<p>";
					  echo form_label('Username:', 'user_name');
					  echo form_input(array('name' => 'user_name',
					   						'id' => 'user_name',
											'type' => 'text',
											'value' => ''));
					  echo "</p>\n";
					  echo "<p>";
					  echo form_label('Password:', 'user_password');
					  echo form_input(array('name' => 'user_password',
					   						'id' => 'user_password',
											'type' => 'password'));
					  echo "</p>\n";
					  echo form_button(array('type'=>'submit',
					  						 'class'=>'positive',
											 'name'=>'Submit',
											 'content'=>'<img src="/assets/images/icons/key.png" alt="Announcement"/>Login')); ?>
						
                      <ul id="forgottenpassword">
                        <li class="boldtext">|</li>
                        <li><a href="forgot">Forgotten it?</a></li>
                      </ul>

				<?
					  echo form_fieldset_close();
					  echo form_close();
				?>

            </div>
        </div>   

<div id="wrapperbottom_branding"><div id="wrapperbottom_branding_text">By <a href="http://midium.wordpress.com" style='text-decoration:none'>Midium Software</a>. <a href="http://midium.wordpress.com" style='text-decoration:none'>Software for common life</a></div></div>