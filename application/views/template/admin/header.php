
<?php 
    $user_data = $this->session->get_userdata();
?>

<div class="header_top ui-corner-all ui-widget ui-widget-content">
    <div class="header_hello">
        <a href="<?php echo base_url('admin'); ?>" title="Home page">Welcome</a>
    </div>
    <div class="header_menu">
        <a href="<?php echo base_url('admin/site/site_list'); ?>" class="link ui-state-default ui-corner-all"><span class="ui-icon ui-icon-clipboard"></span>View sites</a>
        <a href="<?php echo base_url('admin/crawler/crawler_list'); ?>" class="link ui-state-default ui-corner-all"><span class="ui-icon ui-icon-play"></span>Crawlers</a>
        <a href="<?php echo base_url('admin/user/user_list'); ?>" class="link ui-state-default ui-corner-all"><span class="ui-icon ui-icon-person"></span>Admin users</a>
    </div>
    <div class="header_logout">
        <a href="<?php echo base_url('admin/login/user_logout'); ?>" class="link ui-state-default ui-corner-all"><span class="ui-icon ui-icon-power"></span>Logout</a>
        <?php ?>
    </div>
    <div class="header_username">
        <?php echo $user_data['username']; ?>
    </div>
    <div class="clear"></div>
</div>


<div class="clear"></div>

<script type="text/javascript">
$( ".link" ).hover(
	function() {
		$( this ).addClass( "ui-state-hover" );
	},
	function() {
		$( this ).removeClass( "ui-state-hover" );
	}
);
</script>