<div class="login_form ui-widget ui-widget-content ui-corner-all">
    <?php
    if(!empty($_SESSION['error_message'])){
    	?>
    	<div class="ui-widget">
        	<div class="ui-state-error ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
        		<p>
                    <span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                    <strong><?php echo $_SESSION['error_message']; ?></strong>
        		</p>
        	</div>
        </div>
    	<?php
    	unset($_SESSION['error_message']);
    }
    
    echo form_open('admin/login/user_login');
    ?>
        <div class="login_form_input">
            <table cellspacing="3" align="center">
                <tr>
                    <td>User Name:</td>
                    <td>Password:</td>
                </tr>
                <tr>
                    <td>
                        <input type="text" class="ui-state-default ui-corner-all field" autocomplete="off" name="username" />
                    </td>
                    <td>
                        <input type="password" class="ui-state-default ui-corner-all field" autocomplete="off" name="pass" placeholder="password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="login_form_button">
                            <button id="submit_button" type="submit" style="margin-right: 0;">Login</button>
                        </div> 
                    </td>
                </tr>
            </table>
        </div>
     <?php 
     echo form_close();
     ?>
</div>
<script type="text/javascript">
$("#submit_button").button();
</script>