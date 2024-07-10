<?php
include 'db_connect.php';
// Fetch orders with their items
$sql = "
SELECT 
    o.id AS order_id,
    o.name,
    o.address,
    o.state,
    o.city,
    o.pincode,
    o.mobile,
    o.email,
    o.product_price AS total_price,
    o.payment_method,
    o.status,
    o.payment_status,
    GROUP_CONCAT(oi.product_name SEPARATOR ', ') AS product_names,
    GROUP_CONCAT(oi.product_price SEPARATOR ', ') AS product_prices
FROM 
    orders o
LEFT JOIN 
    order_items oi ON o.id = oi.order_id
GROUP BY 
    o.id
";

$result = $conn->query($sql);

?>
<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Order ID</th>
							<th>Customer Name</th>
							<th>Address</th>
							<th>State</th>
							<th>City</th>
							<th>Pincode</th>
							<th>Mobile</th>
							<th>Email</th>
							<th>Products</th>
							<th>Total Price</th>
							<th>Payment Method</th>
							<th>Status</th>
							<th>Payment Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php while ($row = $result->fetch_assoc()): ?>
							<tr>
								<td><?php echo $row['order_id']; ?></td>
								<td><?php echo $row['name']; ?></td>
								<td><?php echo $row['address']; ?></td>
								<td><?php echo $row['state']; ?></td>
								<td><?php echo $row['city']; ?></td>
								<td><?php echo $row['pincode']; ?></td>
								<td><?php echo $row['mobile']; ?></td>
								<td><?php echo $row['email']; ?></td>
								<td><?php echo $row['product_names']; ?></td>
								<td>₹ <?php echo number_format($row['total_price'], 2); ?>/-</td>
								<td><?php echo $row['payment_method']; ?></td>
								<td><?php echo $row['status'] == '0' ? 'Delivered' : 'Pending'; ?></td>
								<td><?php echo $row['payment_status']; ?></td>
								<td>
									<form method="post" action="update_order.php">
										<input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
										<select name="status">
											<option value="0" <?php echo $row['status'] == '0' ? 'selected' : ''; ?>>Delivered
											</option>
											<option value="1" <?php echo $row['status'] == '1' ? 'selected' : ''; ?>>Pending
											</option>
										</select>
										<select name="payment_status">
											<option value="done" <?php echo $row['payment_status'] == 'done' ? 'selected' : ''; ?>>Done
											</option>
											<option value="pending" <?php echo $row['payment_status'] == 'pending' ? 'selected' : ''; ?>>
												Pending</option>
										</select>
										<button type="submit">Update</button>
									</form>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
<script>
	$('.view_order').click(function () {
		uni_modal('Order', 'view_order.php?id=' + $(this).attr('data-id'))
	})
	$('table').dataTable();
</script>