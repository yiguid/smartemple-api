<ol class="breadcrumb">
  <?php 
  	 foreach($crumb as $cmb):
  	 	if($cmb['active'] == 'active')
  	 		echo "<li class=\"".$cmb['active']."\">".$cmb['name']."</li>";
  	 	else
  	 		echo "<li><a href=\"".base_url().$cmb['url']."\">".$cmb['name']."</a></li>";
  	 endforeach;?>
</ol>
