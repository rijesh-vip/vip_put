<style>
#headerInfoBtn {
    color: #ffffff;
    float: right;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 0.9em;
    font-weight: normal;
    padding: 2px 8px;
}
.ResponseGreen {
    background: -moz-linear-gradient(center top , #87c41d 0%, #73a61b) repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: 0 solid #000000;
    border-radius: 10px;
    text-shadow: 0 -1px 0 rgba(170, 170, 170, 1), 0 1px 0 rgba(255, 255, 255, 0.2);
}


</style>
<script>
function showFull(str)
{
	$("#"+str).toggle();
}
</script>
<div class="container">

      <div class="row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          
          <h1>Full page test - Website Speed Test	</h1>
          <div >
            <div class="col-xs-6 col-lg-11">
              
              <form id="urlform" method="post" class="form-signin" >
		         <h4>Enter a URL to test the load time of that page, analyze it and find bottlenecks</h4>

                <input type="text" placeholder="www.example.com" class="input-block-level" name="testurl" value="<?=@$_POST['testurl']?>" style="width:500px">
                
                <button type="submit" tabindex="2" class="btn btn-large btn-primary">Test Now</button>
                
            </form>
            
            
            
            

              
            </div><!--/.col-xs-6.col-lg-4-->
           
          </div><!--/row-->
        </div><!--/.col-xs-12.col-sm-9-->
		
        
        <div class="col-md-11">
        <?php  if(isset($request_urls)){?>
          <table class="table">
            <thead>
              <tr>
                <th>File/path</th>
                <th>Size</th>
                <th>Time</th>
              </tr>
            </thead>
            <tbody>
              <?php 
			 	$size	=	0;
			  foreach($request_urls as $url)	{
					$cutHeaders	=	get_headers($url) ;
					$diff	=	explode(":",$cutHeaders[6]);
					if($diff[0]=='Content-Length'){
						$key	=	6;
					}else{
						$diff	=	explode(":",$cutHeaders[5]);
						if($diff[0]=='Content-Length'){
							$key	=	5;
						}
					}
				  ?>
              <tr >
                <td><?=$url?></td>
                <td><?php
						$content	=	@$cutHeaders[$key];
						$content	=	str_replace("Content-Length:","",$content);
						$size		=	$size + $content;
						echo formatSizeUnits($content);
					?>
                </td>
                <td>
                <?php
				$thisid	=	rand();
				$time = microtime(true);
				file($url);
				echo $microseconds = round((microtime(true) - $time) * 100,2);
				?> ms
                </td>
                <td>
                	<button name="show" onClick="showFull('<?=$thisid?>')">Show</button>
                </td>
              </tr>
              <tr style="display:none" id="<?=$thisid?>">
              	<td colspan="4">
                	<div class="col-md-6">
                   		 <strong>Response Headers </strong>
                         <table width="100%" style="font-size:11px">
                         	<tr>
                            	<td colspan="3" align="right">
                                <div class="ResponseGreen" id="headerInfoBtn">
                                <?php
								if($cutHeaders[0]=='HTTP/1.1 200 OK'){echo "200";};
								unset ($cutHeaders[0]);
								?>
                                </div>
                                </td>
                            </tr>
                         	<?php
							
							foreach($cutHeaders as $headr){
								$row	=	explode(":",$headr)	;
							?>
                            	<tr style="border-bottom:1px solid #ccc">	
                                	<td width="45%">
                                    	<strong><?php
											echo $row[0];
										?>	</strong>
                                    </td>
                                    <td>
                                    	:
                                    </td>
                                    <td width="64%">
                                    	<?php
											echo $row[1];
										?>	
                                    </td>
                                </tr>
                            <?php
							}?>
                         </table>
                    </div>
                    <div class="col-md-6">
                   <strong> Request Headers</strong>
                    	<?php $headers = apache_request_headers();	
						?>
                        <table width="100%" style="font-size:11px">
                         	<?php
							
							foreach($headers as $key=>$headr){
								if(!in_array($key,array('Content-Type','Content-Length','Cookie'))){
							?>
                            	<tr style="border-bottom:1px solid #ccc">	
                                	<td width="45%">
                                    	<strong><?php
											echo $key;
										?>	</strong>
                                    </td>
                                    <td>
                                    	:
                                    </td>
                                    <td width="64%">
                                    	<?php
											echo $headr;
										?>	
                                    </td>
                                </tr>
                            <?php
							}}?>
                         </table>
                   		 
                    </div>
                </td>
              </tr>
             <?php }
			  ?>
              <tfoot>
                <tr style="background-color:#999">
                    <td class="numRequests"><?=count($request_urls)?> requests</td>
                    <td class="pageSize"><?php echo  formatSizeUnits($size);?></td>
                </tr>
            </tfoot>
            </tbody>
          </table>
          <?php }?>
        </div>
        
        
        
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          
        </div><!--/.sidebar-offcanvas-->
      </div><!--/row-->

      <hr>

     

    </div>