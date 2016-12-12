<h1>Sales</h1>
<div class="table-responsive">
    <table class="table" action="">
        <thead>
        <th>Item</th>
        <th>Description</th>
        <th>Price</th>
        <th>In Stock</th>
        <th>Buy</th>
        </thead>
        <form>
            {stock}
            <tr>
                <td>{detailsLink}</td>
                <td>{description}</td>
                <td>${sellingPrice}</td>
                <td>{quantityOnHand}</td>
                <td>{buyButton}</td>
            </tr>
            {/stock}
        </form>
    </table>
</div>
