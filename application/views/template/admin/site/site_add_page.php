
<div class="first_column ui-corner-all ui-widget ui-widget-content margin_right_10">
    <h3>Add new product page for: <?php echo $arrSite['site_name']; ?></h3>
    
    <?php 
    
    if(empty($this->input->post('site_page_url'))){
        $submited_page_url = '';
    }else{
    	$submited_page_url = $this->input->post('site_page_url');
    }
    
    echo form_open('admin/site/site_add_page/?add_site_page='.$arrSite['id']);
    ?>
    <table cellspacing="5">
        <tr>
            <td>Page url</td>
        </tr>
        <tr>
            <td>
                <input type="text" class="ui-state-default ui-corner-all field extra_large" autocomplete="off" name="site_page_url" value="<?php echo $submited_page_url; ?>" />
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">
                <button id="submit_add_new_page_button" type="submit" style="margin-right: 0;">Get page html</button>
            </td>
        </tr>
    </table>
    
    <?php
    echo form_close();
    ?>
    
</div>

<script type="text/javascript">
$("#submit_add_new_page_button").button();
</script>
<div class="clear"></div>
<br />
<hr />
<br />
<?php 
if(!empty($page_contents)){
    echo $page_contents;    
}
?>
