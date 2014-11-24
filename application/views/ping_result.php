<?php
if(!empty($ping) && $ping['return_var'] == 0)
{
	?>
	<table class="table">
		<tr>
			<td>Response time (ms)</td>
			<td>Packet</td>
			<td>IP Address</td>
			<td>ms</td>
			<td>Lost</td>
		</tr>
		<?php
		$ping_output = $ping['output'];
		$total = 0;
		foreach ($ping_output as $key => $item)
		{
			if(in_array($key, array(1,2,3,4)))
			{
				$row = explode(" ", $item);
				$total += (float)substr($row[7], 5);
			}
		}
		$i=0;
		reset($ping_output);
		foreach ($ping_output as $key => $item) 
		{
			if(in_array($key, array(1,2,3,4)))
			{
				$i++;
				$row = explode(" ", $item);
				$percent = ((float)substr($row[7], 5))*100/$total;
				?>
				<tr>
					<td>
						<div class="progress">
						  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $percent?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percent?>%;">
						    <span class="sr-only"><?php echo $percent?>% </span>
						  </div>
						</div>			
					</td>
					<td><?php echo $i?></td>
					<td><?php echo $ip = str_replace(array('(',')',':'), "", $row[4])?></td>
					<td><?php echo substr($row[7], 5)?></td>
					<td>-</td>
				</tr>
			<?php
			}
		}
		$avg = $total/4;
		$percent = $avg * 100 / $total;
		?>
		<tr>
			<td>
				<div class="progress">
				  <div class="progress-bar" role="progressbar progress-bar-success" aria-valuenow="<?php echo $percent?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percent?>%;">
				    <span class="sr-only"><?php echo $percent?>% </span>
				  </div>
				</div>
			</td>
			<td>ALL</td>
			<td><?php echo $ip?></td>
			<td><?php echo ($total/4)?></td>
			<td>-</td>
		</tr>
	</table>
	<?php
}
else
{
	?>
	<div class="alert alert-danger" role="alert">Invalid Host Name</div>
	<?php
}
?>
<?php
exit;
?>