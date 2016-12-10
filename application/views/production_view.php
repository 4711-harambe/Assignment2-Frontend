<h2>Production</h2>
<table class='table'>
	<thead>
		<tr>
			<th>Recipe Name</th>
			<th>Description</th>
			<th>Ingredients ( In Stock / Required )</th>
			<th>Can Produce?</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
        {recipes}
        <tr>
			<th>{code}</th>
			<td>{description}</td>
			<td>{can_produce}</td>
			<td><a type='button' class='btn btn-primary' href={prod_link}>Create</a></td>
        </tr>
        {/recipes}
	</tbody>
</table>
