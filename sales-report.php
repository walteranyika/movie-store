//SELECT customers.names AS c_names, users.names AS u_names, products.title, sales.date_sold FROM customers
//JOIN sales ON customers.id = sales.customer_id
//JOIN users ON users.id = sales.user_id
//JOIN products ON products.id = sales.product_id