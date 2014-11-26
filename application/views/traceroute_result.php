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
    //"1  192.168.1.1 (192.168.1.1)  0.468 ms  0.705 ms  0.886 ms"
    echo "<pre>"; var_dump($traceroute_output); echo "</pre>";
    $total = 0;
    foreach ($traceroute_output as $key => $item)
    {
      if($key != '0')
      {
        $row = explode(" ", $item);
        if($row[3] == '*')
        {
          break; //completed
        }
        echo "<pre>"; print_r($row); echo "</pre>";
        $total += (float)$row[12];
      }
    }
    $i=0;
    reset($traceroute_output);
    foreach ($traceroute_output as $key => $item) 
    {
      if($key != '0')
      {
        $i++;
        $row = explode(" ", $item);
        if($row[3] == '*')
        {
          break; //completed
        }
        $percent = ((float)$row[12])*100/$total;
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
          <td><?php echo $ip = str_replace(array('(',')'), "", $row[4])?></td>
          <td><?php echo $row[3]?></td>
          <td><?php echo $row[12]?></td>
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