<h1>{code}</h1>

<div class="table-responsive">
    <table class="table" action="">
        <form action="">
            <tr>
                <th>Description</th>
                <td>{description}</td>
            </tr>
            <tr>
                <th>Ingredients (Amount needed)</th>
                <td>
                    <ul>
                        {ingredients}
                    </ul>
                </td>
            </tr>
            <tr>
                <th>Price</th>
                <td>${sellingPrice}</td>
            </tr>
            <tr>
                <th>Quantity In Stock</th>
                <td>{quantityOnHand}</td>
            </tr>
            <tr>
                <td></td>
                <td>{buyButton}</td>
                <td>
            </tr>
        </form>
    </table>
</div>
