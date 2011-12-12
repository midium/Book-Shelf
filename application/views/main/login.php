    <div id="wrappertop"></div>
    <div id="wrapper">
            <div id="content">
                <div id="darkbanner" class="banner320">
                    <h2>Login</h2>
    
                </div>
                <div id="darkbannerwrap">
                </div>
                <?php echo validation_errors();
					  echo form_open('sessions/authenticate',array('id'=>'login_form')); 
					  echo form_fieldset('', array('class'=>'form'));
					  echo '<div class="field">';
					  echo form_label('Username:', 'username');
					  echo form_input(array('name' => 'username',
					   						'id' => 'username',
											'type' => 'text',
											'value' => ''));
					  echo form_error('username');
					  echo "</div>\n";
					  echo '<div class="field">';
					  echo form_label('Password:', 'password');
					  echo form_input(array('name' => 'password',
					   						'id' => 'password',
											'type' => 'password'));
					  echo form_error('password');
					  echo "</div>\n";
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