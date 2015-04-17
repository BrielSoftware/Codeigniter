
<div class="first_column ui-corner-all ui-widget ui-widget-content">
    <div class="sub_page_menu">
        <a href="<?php echo base_url('admin/site/site_add_new'); ?>" class="link ui-state-default ui-corner-all"><span class="ui-icon ui-icon-clipboard"></span>Add new</a>
    </div>
    <?php
    if(!empty($arrSites) && is_array($arrSites)){
    	
        ?>
        <div class="another_list_wrapper">
            <ul>
                <?php 
                foreach ($arrSites as $site){
                	?>
                	<li><?php echo $site['site_name']; ?></li>
                	<?php
                }
                ?>
            </ul>
        </div>
        <?php
    }else{
    	?>
    	<div class="ui-widget">
        	<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
        		<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
        		<strong>No site added yet!!!</strong> Use the form on the right to add new sites</p>
        	</div>
        </div>
    	<?php
    }
    
    if(!empty($pagination)){
    	echo $pagination;
    }
    
    ?>
    <div class="clear"></div>
</div>



