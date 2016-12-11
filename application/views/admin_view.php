<h1>Admin Panel</h1>
<hr>

<h1>Stock</h1>
<div class="table-responsive">
    <table class="table" action="">
        <thead>
        <th>Item</th>
        <th>Description</th>
        <th>Selling Price</th>
        <th>Quantity</th>
        <th>Edit</th>
        <th>Delete</th>
        </thead>
        <form>
            {stock}
            <tr>
                <td>
                    <strong>{code}</strong>
                </td>
                <td>{description}</td>
                <td>${sellingPrice}</td>
                <td>{quantityOnHand}</td>
                <td>{editButton}</td>
                <td>{deleteButton}</td>
            </tr>
            {/stock}
        </form>
    </table>
</div>

<hr>

<h1>Supplies</h1>
<div class="table-responsive">
    <table class="table" action="">
        <thead>
        <th>Item</th>
        <th>Description</th>
        <th>Price</th>
        <th>Receiving</th>
        <th>In Stock</th>
        <th>Edit</th>
        <th>Delete</th>
        </thead>
        <form>
            {supplies}
            <tr>
                <td>
                    <strong>{code}</strong>
                </td>
                <td>{description}</td>
                <td>${receivingCost}</td>
                <td>{stockingUnit}</td>
                <td>{quantityOnHand}</td>
                <td>{editButton}</td>
                <td>{deleteButton}</td>
            </tr>
            {/supplies}
        </form>
    </table>
</div>

<h1>Recipes</h1>
<div class="table-responsive">
    <table class="table" action="">
        <thead>
        <th>Item</th>
        <th>Description</th>
        <th>Ingredients</th>
        <th>Edit</th>
        <th>Delete</th>
        </thead>
        <form>
            {recipes}
            <tr>
                <td>
                    <strong>{code}</strong>
                </td>
                <td>{description}</td>
                <td><ul>{ingredients}</ul></td>
                <td><input class="btn btn-primary" type="submit" value="Edit"></td>
                <td>{deleteButton}</td>
            </tr>
            {/recipes}
        </form>
    </table>
</div>
