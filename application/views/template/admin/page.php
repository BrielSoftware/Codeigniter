<!DOCTYPE html>
<html>
<head>
<?php 
if(empty($page_title)){
	$page_title = 'Codeigniter';
}
$this->load->view('template/admin/head', array('page_title' => $page_title));
?>
</head>
<body>

<?php

$user_data = $this->session->get_userdata();
if(!empty($user_data) && !empty($user_data['admin_logged']) && $user_data['admin_logged'] == 'logged'){
    
    //we are logged in, will show the template we want
    $this->load->view('template/admin/header');
    
    ?>
        <div class="content_wrapper">
            <?php 
            $this->load->view($main_content);
            ?>
        </div>
        <?php 
        
        $this->load->view('template/admin/footer');
}else{
    
    //not logged in, will show the login template
    $this->load->view('template/admin/login_form');

}
?>

</body>
</html>

