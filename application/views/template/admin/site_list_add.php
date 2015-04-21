<div class="first_column ui-corner-all ui-widget ui-widget-content">
    <h3>Add new site</h3>
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
    
    echo form_open('admin/site/add_new');
    
    if(!empty($_SESSION['_submited'])){
        $submited_site_name = $_SESSION['_submited']['site_name'];
        $submited_site_url = $_SESSION['_submited']['site_url'];    	
        $submited_site_status = $_SESSION['_submited']['site_status'];
        
        unset($_SESSION['_submited']);
    }else{
    	$submited_site_name = '';
        $submited_site_url = '';
        $submited_site_status = '1';
    }
    
    ?>
        <table cellspacing="5" align="center">
            <tr>
                <td>Site name</td>
                <td><input type="text" class="ui-state-default ui-corner-all field large" autocomplete="off" name="site_name" value="<?php echo $submited_site_name; ?>"></td>
            </tr>
            <tr>
                <td>Site url</td>
                <td><input type="text" class="ui-state-default ui-corner-all field large" autocomplete="off" name="site_url" value="<?php echo $submited_site_url; ?>"></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <select class="ui-state-default ui-corner-all field" autocomplete="off" name="site_status">
                        <option value="1"<?php echo ($submited_site_status == '1') ? ' selected="selected"' : ''; ?>>Active</option>
                        <option value="0"<?php echo ($submited_site_status == '0') ? ' selected="selected"' : ''; ?>>Disabled</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="login_form_button">
                        <button id="submit_add_new_button" type="submit" style="margin-right: 0;">Add new site</button>
                    </div> 
                </td>
            </tr>
        </table>
    <?php
    echo form_close();
    ?>
    <div class="clear"></div>
</div>


<script type="text/javascript">
$("#submit_add_new_button").button();
</script>
