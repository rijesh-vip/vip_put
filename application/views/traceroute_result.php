<?php
if(!empty($traceroute) && $traceroute['return_var'] == 0)
{
  ?>
  <table class="table">
    <tr>
      <td>Response time (ms)</td>
      <td>Hop</td>
      <td>IP Address</td>
      <td>Host name</td>
      <td>ms</td>
      <td>Lost (%)</td>
    </tr>
    <?php
    $traceroute_output = $traceroute['output'];
    $total = 0;
    foreach ($traceroute_output as $key => $item)
    {
      if($key != '0')
      {
        $item = ltrim($item);
        //$item = preg_replace('!\s+!', ' ', $item);
        $row = explode(" ", $item);
        //echo "<pre>"; print_r($row); echo "</pre>";
        if($row[2] == '*')
        {
          continue; //continue
        }
        $total += (float)$row[11];
      }
    }
    $i=0;
    //exit;
    reset($traceroute_output);
    foreach ($traceroute_output as $key => $item) 
    {
      if($key != '0')
      {
        $i++;
        $item = ltrim($item);
        //$item = preg_replace('!\s+!', ' ', $item);
        $row = explode(" ", $item);
        if($row[2] == '*')
        {
          continue; //continue
        }
        $percent = ((float)$row[11])*100/$total;
        ?>
        <tr>
          <td>
            <div class="progress">
              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $percent?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percent?>%;">
                <span class="sr-only"><?php echo $percent?>% </span>
              </div>
            </div>      
          </td>
          <td><?php echo $key?></td>
          <td><?php echo $ip = str_replace(array('(',')'), "", $row[3])?></td>
          <td><?php echo $row[2]?></td>
          <td><?php echo $row[11]?></td>
          <td>0</td>
        </tr>
      <?php
      }
    }
    ?>
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