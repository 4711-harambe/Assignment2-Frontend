<h2>Production</h2>
<table class='table'>
	<thead>
		<tr>
			<th>Recipe Name</th>
			<th>Description</th>
			<th>Current Stock</th>
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
			<td>{stock}</td>
			<td>
				<ul>
					{ingredients}
				</ul>
			</td>
			<td>{produceButton}</td>
        </tr>
        {/recipes}
	</tbody>
</table>
