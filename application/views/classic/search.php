<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">
			<?php if(!count($result)): ?>
				<div class="well">
					No Result Found For "<?=$query?>"
				</div>
			<?php else: ?>
				Search Result for "<?=$query?>"
			<?php endif; ?>

			<br><br>

 			<table class="table table-striped table-bordered">
				<thead>
				  <tr>
				    <th> Customer ID </th>
				    <th> Customer TC </th>
				    <th> Customer Name </th>
				    <th class="td-actions"> Actions </th>
				  </tr>
				</thead>
				<tbody>
				<?php if ($result): ?>
					<?php foreach ($result as $cust): ?>
					  <tr>
					    <td> <?=$cust->customer_id?> </td>
					    <td> <?=$cust->customer_TCno?> </td>
					    <td> <?=$cust->customer_firstname." ".$cust->customer_lastname?> </td>
					    <td class="td-actions">
					    	<a href="/customer/edit/<?=$cust->customer_id?>" class="btn btn-small btn-primary">
					    		<i class="btn-icon-only icon-edit"> </i>
					    	</a>

					    	<a href="/departments/delete/<?=$cust->customer_id?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-small">
					    		<i class="btn-icon-only icon-remove"> </i>
					    	</a>
					    </td>
					  </tr>
					<?php endforeach; ?>
				<?php endif; ?>
				</tbody>
			</table>
			<? } ?>
		</div>
	  </div>
	</div>
  </div>
</div>
