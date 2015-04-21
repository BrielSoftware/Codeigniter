
<div class="first_column ui-corner-all ui-widget ui-widget-content margin_right_10">
    <h3>Sites list</h3>
    <?php
    if(!empty($arrSites) && is_array($arrSites)){
    	
        ?>
        <div class="another_list_wrapper site_list_wrapper">
            <ul class="site_list_ul">
                <?php 
                foreach ($arrSites as $site){
                    if($site['status'] == '1'){
                    	$status_label = 'Active';
                    	$status_class = 'status_active';
                    }else{
                    	$status_label = 'Disabled';
                        $status_class = 'status_inactive';
                    }
                	?>
                	<li class="ui-corner-all ui-widget ui-widget-content">
                	   <a class="site_list_link" href="<?php echo $site['site_url']; ?>" title="<?php echo $site['site_name']; ?>" target="_blank"><?php echo $site['site_name']; ?></a>
                	   
                	   <a class="ui-state-default ui-corner-all icons" title="Edit" href="<?php echo base_url('admin/site/site_list/?edit='.$site['id']); ?>"><span class="ui-icon ui-icon-pencil"></span></a>
                	   <a class="ui-state-default ui-corner-all icons" title="Delete" onclick="return confirm('Are you sure you want to delete this site ?');" href="<?php echo base_url('admin/site/site_delete/?delete='.$site['id']); ?>"><span class="ui-icon ui-icon-trash"></span></a>
                	   
                	   <span class="site_list_status <?php echo $status_class; ?>"><?php echo $status_label; ?></span>
                	   <div class="clear"></div>
                	</li>
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

<?php 
    if(empty($_GET['edit'])){

        $this->load->view('template/admin/site_list_add');
        
    }else{
    	
        $this->load->view('template/admin/site_list_edit');

    }
?>
