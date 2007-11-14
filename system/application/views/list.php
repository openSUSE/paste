<?php $this->load->view('header');?>

<div id="main">
	<div id="content">
		<h1 class="pagetitle">Recent Pastes</h1>
			<table id="table">
				<tbody>
					<tr><th>Title</th><th>Name</th><th>Submitted</th></tr>
		<?php 
		function checkNum($num){
            return ($num%2) ? TRUE : FALSE;
        }
		
		foreach($pastes as $paste) {
			if(checkNum($paste['id']) == TRUE) {
				echo "<tr id=\"even\">";
			} else {
				echo "<tr id=\"odd\">";
			}
			echo "<td id=\"title\" style=\"border:0\"><a href=\"".base_url().'view/'.$paste['pid']."\">".$paste['title']."</a></td>";
			echo "<td id=\"name\">".$paste['name']."</td>";
			echo "<td id=\"created\">".$paste['created']."</td>";
			echo "</tr>";
		}?>
			</tbody>
			</table>
	</div>
	
	<?php $this->load->view('sidebar');?>
</div>

<?php $this->load->view('footer');?>