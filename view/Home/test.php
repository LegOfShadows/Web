<div class="wrpItem">
	<h3>Work Invoice</h3>
	<form class="ctrlItemForm" action="/home/test" method="GET">
	<fieldset class="ctrlItemFormGroup">
		<legend>Invoice Data</legend>
		<table class="ctrlItemFormTable">
		<tr>
			<td><label>Invoice Number</label></td><td><input type="text" name="num" /></td>
		</tr>
		<tr>
			<td><label>Date DDMMYYYY</label></td><td><input type="text" name="date" /></td>
		</tr>
		<tr>
			<td><label>Hours Worked</label></td><td><input type="text" name="qty" /></td>
		</tr>
		<tr>
			<td><label>Hourly Wage</label></td><td><input type="text" name="cost" /></td>
		</tr>
		<tr>
			<td><label>Total Pay</label></td><td><input type="text" name="total" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Generate" /></td>
		</tr>
		</table>
	</fieldset>
	</form>
</div>