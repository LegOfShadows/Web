<form action="/forum/create" method="post" class="ctrlItemForm">
	<table class="ctrlItemFormTable">
		<tr>
			<td><label>Title</label></td>
			<td><input name="title" type="text" /></td>
		</tr>
		<tr>
			<td><label>Category</label></td>
			<td><select name="category">
			<?php
			foreach ( $categories as $cat ) {
				echo Html::CreateElement('option',$cat['name'],array('value'=>$cat['id']));
			}
			?>
			</select></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Create Thread" /></td>
	
	</table>
</form>