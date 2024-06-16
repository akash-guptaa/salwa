CREATE TABLE items_Details (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   `bill_id` INT NOT NULL
  `po_date` DATE,
  `po_id` INT,
  `delivery_date` DATE,
  `delivery_time` TIME,
  `site_name` VARCHAR(255),
  `supplier_name` VARCHAR(255),
  `item_code` INT,
  `hsn_code` INT,
  `item_name` VARCHAR(255),
  `qty` INT,
  `uom` VARCHAR(255),
  `rate` DECIMAL(10,2),
  `gst_rate` VARCHAR(255), -- Change to DECIMAL(5,2) if storing actual GST rate
  `gst_amount` DECIMAL(10,2),
  `cess_amount` DECIMAL(10,2),
  `delivery_charges` DECIMAL(10,2),
  `gst_delivery_charge` DECIMAL(10,2),
  `others_amount` DECIMAL(10,2),
  `gst_on_other_amount` DECIMAL(10,2),
  `category_name` VARCHAR(255),
  `item_type` VARCHAR(255),
  `item_ops` VARCHAR(255),
  `po_status` VARCHAR(255),
  `status` VARCHAR(255),
  `username` VARCHAR(255),
  `timestamp` DATETIME,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  CONSTRAINT `fk_items_Details_bill_id` FOREIGN KEY (bill_id) REFERENCES bills(id)
);

CREATE TABLE bills (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `comp_id` VARCHAR(255),
  `bill_number` VARCHAR(255) UNIQUE, 
  `bill_type` VARCHAR(255), -- Ensures unique bill numbers
  `customer_id` INT, -- Foreign key referencing product_Details
  `bill_date` DATE,
  `due_date` VARCHAR(255),
  `total_amount` DECIMAL(10,2),
  `payment_status` VARCHAR(255), -- (e.g., Paid, Unpaid, Partially Paid)
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
