<?php $alt = false; $currentId = -1; ?>
<table id="orderList" class="table" style="margin-top: 30px;">
	<thead>
		<tr>
			<th>Complete</th>
			<th>Quantity</th>
			<th>Dish</th>
			<th>Modifications</th>
			<th>Table #</th>
		</tr>
	</thead>
	<tbody id="mealList">
		<?php foreach($results as $item) : ?>
			<?php if($item['id'] != $currentId){
					$currentId = $item['id'];
					$alt = !$alt;
				}  
			?>
			<?php if($alt) : ?>
				<tr class="warning orderRow<?php echo $item['id']; ?>">
			<?php else : ?>
				<tr class="orderRow<?php echo $item['id']; ?>">
			<?php endif; ?>
					<td>
	                        <div class="checkbox">
	                            <label><input class="<?php echo $item['id']; ?>" onclick="checkOrderRadios(this)" type="checkbox" value=""></label>
	                        </div>
	                    </td>
	                    <td><?php echo $item['quantity']; ?></td>
	                    <td><?php echo $item['title']; ?></td>
	                    <td><?php echo $item['notes']; ?></td>
	                    <td id="tableId" data="<?php echo $item['tableId']; ?>"><?php echo $item['username']; ?></td>
	                </tr>
		<?php endforeach; ?>
	</tbody>
</table>